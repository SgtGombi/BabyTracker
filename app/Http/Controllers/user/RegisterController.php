<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Megjeleníti a regisztrációs formot
     */
    public function showRegistrationForm()
    {
        // Ha már be van jelentkezve, átirányítjuk a dashboardra
        if (Auth::guard('web')->check()) {
            return redirect()->route('user.dashboard');
        }

        return view('user.register');
    }

    /**
     * Regisztráció kezelése
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:user,email',
            'password' => ['required', 'confirmed', Password::min(6)],
            'phone' => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'active' => 1,
        ]);

        // Automatikus bejelentkezés regisztráció után
        Auth::guard('web')->login($user);

        return redirect('/')->with('status', 'Sikeres regisztráció!');
    }
}
