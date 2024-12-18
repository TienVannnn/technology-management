<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Department;

class ReusableController extends Controller
{
    public function changeStatus($id, $slug)
    {
        switch ($slug) {
            case 'department': {
                    $module = Department::find($id);
                    break;
                }
            case 'customer': {
                    $module = Customer::find($id);
                    break;
                }
        }
        if (!$module) {
            abort(404);
        }
        $module->update(['status' => !$module->status]);
        return response()->json([
            'status' => 200,
            'message' => 'Thay đổi trạng thái thành công'
        ]);
    }
}
