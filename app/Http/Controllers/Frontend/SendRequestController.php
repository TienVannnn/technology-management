<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\SendRequest;
use App\Jobs\MailAccountJob;
use App\Models\Customer;
use App\Models\SupportRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SendRequestController extends Controller
{
    public function send_request(SendRequest $request)
    {
        $customer = Customer::where('email', $request->email)->first();
        if (!$customer) {
            $pass = rand(100000, 999999);
            $customer = Customer::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($pass),
                'status' => 1
            ]);
            MailAccountJob::dispatch($customer, $pass)->delay(now()->addSecond(10));
        }
        $sr = SupportRequest::create([
            'customer_id' => $customer->id,
            'phone' => $request->phone,
            'department_id' => $request->department_id,
            'title' => $request->title,
            'is_new' => true,
            'status' => 0,
            'reception_time' => $request->reception_time,
            'support_request' => $request->support_request,
        ]);

        if ($sr) {
            return response()->json(['success' => true, 'message' => 'Yêu cầu đã được gửi']);
        }

        return response()->json(['success' => false, 'message' => 'Có lỗi khi gửi yêu cầu!']);
    }
}
