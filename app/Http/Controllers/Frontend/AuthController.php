<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\ChangePasswordRequest;
use App\Http\Requests\Frontend\EditAccountRequest;
use App\Http\Requests\Frontend\LoginRequest;
use App\Http\Requests\Frontend\RegisterRequest;
use App\Http\Services\Frontend\AuthService;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    protected $auth;
    public function __construct(AuthService $service)
    {
        $this->auth = $service;
    }
    public function form_register()
    {
        $title = 'Register';
        return view('frontend.auth.register', compact('title'));
    }

    public function register(RegisterRequest $request)
    {
        $result = $this->auth->register($request);
        if ($result) {
            return redirect()->route('customer.login_page');
        }
        return redirect()->back();
    }

    public function form_login()
    {
        $title = 'Login';
        return view('frontend.auth.login', compact('title'));
    }

    public function login(LoginRequest $request)
    {
        $result = $this->auth->login($request);
        if ($result) return redirect()->route('customer.dashboard');
        return redirect()->back();
    }

    public function profile()
    {
        $title = 'Profile';
        return view('frontend.auth.profile', compact('title'));
    }

    public function logout()
    {
        Auth::guard('customers')->logout();
        Session::flash('success', 'Đăng xuất thành công');
        return redirect()->route('customer.dashboard');
    }

    public function overview()
    {
        $title = 'Tổng quan';
        return view('frontend.auth.overview', compact('title'));
    }

    public function change_avatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::guard('customers')->user();
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = time() . '_' . Str::slug($originalName) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/avatars'), $filename);

            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }
            $user->avatar = '/uploads/avatars/' . $filename;
            $user->save();

            return response()->json(['success' => true, 'avatar_url' => $user->avatar]);
        }

        return response()->json(['success' => false], 500);
    }

    public function page_edit_account()
    {
        $title = 'Thay đổi hồ sơ';
        $customer = Auth::guard('customers')->user();
        return view('frontend.auth.edit-account', compact('title', 'customer'));
    }

    public function edit_account(EditAccountRequest $request)
    {
        try {
            $customer = Auth::guard('customers')->user();
            $customer->update([
                'name' => $request->name,
                'phone' => $request->phone
            ]);
            Session::flash('success', 'Thay đổi hồ sơ thành công');
        } catch (\Exception $e) {
            Session::flash('error', 'Thay đổi hồ sơ thất bại');
        }
        return redirect()->back();
    }

    public function page_change_password()
    {
        $title = 'Đổi mật khẩu';
        $customer = Auth::guard('customers')->user();
        return view('frontend.auth.change-password', compact('title', 'customer'));
    }

    public function change_password(ChangePasswordRequest $request)
    {
        try {
            $customer = Auth::guard('customers')->user();
            if (!Hash::check($request->input('now-pass'), $customer->password)) {
                return redirect()->back()->withErrors(['now-pass' => 'Mật khẩu hiện tại không đúng']);
            }
            $customer->update([
                'password' => Hash::make($request->password)
            ]);
            Session::flash('success', 'Thay đổi mật khẩu thành công');
        } catch (\Exception $e) {
            Session::flash('error', 'Thay đổi mật khẩu thất bại');
        }
        return redirect()->back();
    }
}
