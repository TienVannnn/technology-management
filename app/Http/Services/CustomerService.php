<?php

namespace App\Http\Services;

use App\Jobs\MailAccountJob;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CustomerService
{
    public function getCustomers()
    {
        $customer = Auth::customer();
        if ($customer->id === 1) {
            return Customer::orderByDesc('id')->paginate(15);
        }
        return Customer::orderByDesc('id')->whereNot('id', 1)->paginate(15);
    }
    public function createCustomer($request)
    {
        try {
            DB::beginTransaction();
            $pass = Str::random(6);
            $customer = Customer::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'status' => $request->status,
                'password' => Hash::make($pass)
            ]);
            DB::commit();
            Session::flash('success', 'Customer created successfully');
            MailAccountJob::dispatch($customer, $pass)->delay(now()->addSecond(10));
        } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Customer create failed: ' . $e->getMessage());
        }
        return;
    }

    public function updateCustomer($request, $customer)
    {
        try {
            DB::beginTransaction();
            $customer->fill([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'status' => $request->status
            ]);
            if ($request->password) {
                $customer->password = Hash::make($request->password);
                MailAccountJob::dispatch($customer, $request->password)->delay(now()->addSecond(10));
            }
            $customer->save();
            DB::commit();
            Session::flash('success', 'Customer updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Customer update failed: ' . $e->getMessage());
        }
    }
}
