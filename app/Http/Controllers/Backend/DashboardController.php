<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SupportRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.dashboard.dashboard');
    }
}
