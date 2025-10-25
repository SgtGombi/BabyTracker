<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Megjeleníti a login formot
     */
    public function showLoginForm()
    {
        // Ha már be van jelentkezve, átirányítjuk a dashboardra
        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    /**
     * Bejelentkezési kísérlet kezelése
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Ellenőrizzük, hogy létezik-e az admin és aktív-e
        $admin = \App\Models\Admin::where('email', $credentials['email'])->first();
        
        if ($admin && $admin->active == 0) {
            throw ValidationException::withMessages([
                'email' => 'Ez az admin fiók inaktív.',
            ]);
        }

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            
            return redirect()->intended(route('admin.dashboard'));
        }

        throw ValidationException::withMessages([
            'email' => 'A megadott adatok nem egyeznek.',
        ]);
    }

    /**
     * Kijelentkezés kezelése
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login')->with('status', 'Sikeresen kijelentkeztél!');
    }
}
