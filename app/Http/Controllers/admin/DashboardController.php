<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Megjeleníti az admin dashboardot
     */
    public function index()
    {
        $admin = Auth::guard('admin')->user();

        $users = User::with(['children.meals','children.medications','children.diapers','children.sleeps'])->get();

        return view('admin.admin', compact('admin', 'users'));
    }
}