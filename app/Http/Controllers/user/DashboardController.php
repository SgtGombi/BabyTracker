<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Megjeleníti a user dashboardot
     */
    public function index()
    {
        $user = Auth::guard('web')->user();
        
        return view('user.dashboard', compact('user'));
    }
}
