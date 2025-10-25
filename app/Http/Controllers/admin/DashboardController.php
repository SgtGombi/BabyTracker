<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Megjeleníti az admin dashboardot
     */
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        
        return view('admin.admin', compact('admin'));
    }
}