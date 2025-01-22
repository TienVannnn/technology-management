<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $departments = Department::where('status', 1)->orderByDesc('id')->get();
        $title = 'Trang chủ';
        return view('welcome', compact('title', 'departments'));
    }
}
