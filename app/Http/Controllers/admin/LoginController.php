<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class LoginController extends Controller
{
    // visszaadja a login htmlt
	public function showLoginForm()
	{
		return view('admin.login');
	}
    
    // login ellenorzes
	public function login(Request $request)
	{
        // request osztály jó cucc, validálja itt az adatokat input alapján
		$data = $request->validate([
			'email' => 'required|email',
			'password' => 'required|string',
		]);
        // lekéri az admin adatot email alapján
		$admin = Admin::where('email', $data['email'])->first();

        // hash-elt jelszót ellenőriz
		if (! $admin || ! Hash::check($data['password'], $admin->password)) {
			return back()->withErrors(['email' => 'Helytelen felhasználónév vagy jelszó.'])->withInput();
		}
        // kezeljünk active/inactive fiókokat is, ez csak plusz.
		if (! (int) $admin->active) {
			return back()->withErrors(['email' => 'A fiók nincs aktiválva.'])->withInput();
		}

		session()->put('admin_id', $admin->id);

		return redirect()->intended('/admin');
	}

    // logout gombhoz ezt kell meghívni
	public function logout(Request $request)
	{
		$request->session()->forget('admin_id');
		return redirect('/admin/login');
	}
}

