<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MembreAuthController extends Controller
{
    public function showRegister()
    {
        return view('forum.register');
    }

    public function register(Request $request)
    {
        $donnees = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $donnees['name'],
            'email' => $donnees['email'],
            'password' => Hash::make($donnees['password']),
            'role' => 'membre',
        ]);

        Auth::login($user);

        return redirect('/forum')->with('succes', 'Bienvenue sur le forum GES !');
    }

    public function showLogin()
    {
        return view('forum.login');
    }

  public function login(Request $request)
{
    $identifiants = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($identifiants)) {
        if (auth()->user()->suspendu) {
            Auth::logout();
            return back()->withErrors(['email' => 'Ce compte a été suspendu.']);
        }
        $request->session()->regenerate();
        return redirect('/forum');
    }

    return back()->withErrors(['email' => 'Identifiants incorrects.']);
}

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/forum');
    }
}
