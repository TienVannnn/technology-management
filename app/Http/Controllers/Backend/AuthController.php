<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\EditUserRequest;
use App\Http\Requests\Backend\LoginRequest;
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
}
