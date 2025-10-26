<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::guard('web')->user();
        
        $children = $user->children()->with(['meals','medications','diapers','sleeps'])->get();

        return view('user.dashboard', compact('user', 'children'));
    }
}
