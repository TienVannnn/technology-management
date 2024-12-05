<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login_form()
    {
        return view('backend.auth.login_form');
    }

    public function login(LoginRequest $request)
    {
        $cre = $request->only('email', 'password');
        if (Auth::attempt($cre, $request->has('remember'))) {
            Session::flash('success', 'Đăng nhập admin thành công');
            return redirect()->route('dashboard');
        }
        Session::flash('error', 'Email hoặc mật khẩu không đúng');
        return redirect()->back();
    }
}
