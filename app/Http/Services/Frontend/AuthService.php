<?php

namespace App\Http\Services\Frontend;

use App\Jobs\MailAccountJob;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthService
{
    public function register($request)
    {
        try {
            DB::beginTransaction();
            $pass = $request->password;
            $account = Customer::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($pass)
            ]);
            DB::commit();
            Session::flash('success', 'Đăng ký tài khoản thành công');
            MailAccountJob::dispatch($account, $pass)->delay(now()->addSecond(10));
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Đăng ký tài khoản thất bại');
            return false;
        }
    }

    public function login($request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('customers')->attempt($credentials)) {
            Session::flash('success', 'Đăng nhập thành công');
            return true;
        }
        Session::flash('error', 'Mật khẩu không hợp lệ');
        return false;
    }
}
