<?php

namespace App\Http\Controllers\user;

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
        if (Auth::guard('web')->check()) {
            return redirect()->route('user.dashboard');
        }

        return view('user.login');
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

        // Ellenőrizzük, hogy létezik-e a user és aktív-e
        $user = \App\Models\User::where('email', $credentials['email'])->first();
        
        if ($user && $user->active == 0) {
            throw ValidationException::withMessages([
                'email' => 'Ez a fiók inaktív.',
            ]);
        }

        $remember = $request->filled('remember');

        if (Auth::guard('web')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            
            return redirect()->intended('/');
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
        Auth::guard('web')->logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('user.login')->with('status', 'Sikeresen kijelentkeztél!');
    }
}
