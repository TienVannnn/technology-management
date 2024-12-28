<?php

namespace App\Http\Services;

use App\Jobs\MailAccountJob;
use App\Jobs\SupportRequestJob;
use App\Models\SupportRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class SupportRequestService
{
    public function getSupportRequests()
    {
        return SupportRequest::orderByDesc('id')->with('department', 'customer')->paginate(15);
    }
    public function createSupportRequest($request)
    {
        try {
            DB::beginTransaction();
            $sr = SupportRequest::create([
                'support_request' => $request->support_request,
                'customer_id' => $request->customer_id,
                'department_id' => $request->department_id,
                'status' => $request->status,
                'reception_time' => $request->reception_time
            ]);
            DB::commit();
            Session::flash('success', 'Support request created successfully');
            SupportRequestJob::dispatch($sr)->delay(now()->addSecond(10));
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Support request create failed: ' . $e->getMessage());
        }
        return;
    }

    public function updateSupportRequest($request, $sr)
    {
        try {
            DB::beginTransaction();
            $sr->fill([
                'support_request' => $request->support_request,
                'department_id' => $request->department_id,
                'customer_id' => $request->customer_id,
                'status' => $request->status,
                'reception_time' => $request->reception_time
            ]);
            $sr->save();
            DB::commit();
            Session::flash('success', 'Support request updated successfully');
            SupportRequestJob::dispatch($sr)->delay(now()->addSecond(10));
        } catch (\Exception $e) {
            DB::rollBack();
            Session::flash('error', 'Support request update failed: ' . $e->getMessage());
        }
        return;
    }

    // public function deleteRequestSupport($request)
    // {
    //     $request->delete();
    //     return;
    // }
}
