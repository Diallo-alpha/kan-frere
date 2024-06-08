<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function formulaireInscription()
    {
        return view('utilisateurs.inscription');
    }

    public function enregister(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:1|confirmed',
            'role' => 'required|string|in:client,admin',
        ]);

        $role = $request->input('role', 'client');

        User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        return redirect('/')->with('success', 'Inscription réussie ! Vous pouvez maintenant vous connecter.');
    }
    public function afficherFormConnexion()
    {
        return view('utilisateurs.connexion');
    }

    public function connexion(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('/inscription');
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification ne correspondent pas.',
        ])->withInput($request->only('email'));
    }
}
