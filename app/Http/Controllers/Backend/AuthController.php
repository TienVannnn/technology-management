<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\EditUserRequest;
use App\Http\Requests\Backend\LoginRequest;
use App\Http\Requests\Backend\RecoveryInfoRequest;
use App\Http\Requests\Backend\RecoveryPasswordRequest;
use App\Jobs\RecoveryPasswordJob;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\matches;

class AuthController extends Controller
{
    public function login_form()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('backend.auth.login_form');
    }

    public function login(LoginRequest $request)
    {
        $cre = $request->only('email', 'password');
        if (Auth::attempt($cre, $request->has('remember'))) {
            Session::flash('success', 'Đăng nhập admin thành công');
            return redirect()->route('admin.dashboard');
        }
        Session::flash('error', 'Email hoặc mật khẩu không đúng');
        return redirect()->back();
    }

    public function profile()
    {
        $user = Auth::user();
        $title = 'Profile - ' . $user->name;
        return view('backend.auth.profile', compact('user', 'title'));
    }

    public function changeInfo(EditUserRequest $request)
    {
        $user = Auth::user();
        $user->fill([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        if ($request->hasFile('avatar')) {
            $old_image = $user->avatar;
            $path = 'uploads/avatars/';
            $img = $request->file('avatar');
            $avatar = time() . '_' . $img->getClientOriginalName();
            $img->move(public_path($path), $avatar);
            if ($old_image && file_exists(public_path($path . $old_image))) {
                unlink(public_path($path . $old_image));
            }
            $user->avatar = $avatar;
        }

        if ($request->filled('password')) {
            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->password);
            } else {
                Session::flash('error', 'Old password incorrect');
                return redirect()->back();
            }
        }

        $user->save();

        Session::flash('success', 'Change information successfully');
        return redirect()->back();
    }


    public function logout()
    {
        Auth::logout();
        Session::flash('success', 'Logout successfully');
        return redirect()->route('login');
    }

    public function forgot_password()
    {
        $title = 'Forgot password | Technical_VT';
        return view('backend.auth.forgot_password', compact('title'));
    }

    public function handle_forgot_password(RecoveryPasswordRequest $request)
    {
        $token = Str::random(10);
        $expiration = Carbon::now()->addMinutes(15);
        $user = User::where('email', $request->email)->first();
        $user->update([
            'token_reset_password' => $token,
            'token_duration' => $expiration,
        ]);
        RecoveryPasswordJob::dispatch($request->email, $token)->delay(now()->addSecond(5));
        Session::flash('success', 'Mã xác nhận đã được gửi đến bạn. Vui lòng kiểm tra email');
        return redirect()->route('admin.form_recovery')->with([
            'email' => $request->email
        ]);
    }

    public function recovery_password()
    {
        $email = session('email');
        $title = 'Khôi phục mật khẩu';
        return view('backend.auth.recovery_password', compact('title', 'email'));
    }

    public function hanle_recovery_password(RecoveryInfoRequest $request)
    {
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();
        if ($user->token_reset_password === $request->token_reset_password) {
            if (Carbon::now()->greaterThan($user->token_duration)) {
                Session::flash('error', 'Mã xác nhận đã hết hạn, vui lòng yêu cầu mã xác nhận mới');
                return redirect()->back();
            }
            $user->update([
                'password' => Hash::make($password),
                'token_reset_password' => null,
                'token_duration' => null
            ]);
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                Session::flash('success', 'Đổi mật khẩu thành công');
                return redirect()->route('admin.dashboard');
            }
        }
        Session::flash('error', 'Token không hợp lệ!');
        return redirect()->back();
    }
}
