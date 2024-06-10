<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function formulaireInscription()
    {
        return view('utilisateurs.inscription');
    }

    public function enregistrer(Request $request)
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

        return redirect()->route('afficherFormConnexion')->with('success', 'Inscription réussie ! Vous pouvez maintenant vous connecter.');
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
            $user = Auth::user();

            // Vérifiez si l'utilisateur a le rôle 'admin'
            if ($user->role === 'admin') {
                // Rediriger les utilisateurs admin vers la liste des produits
                return redirect()->route('produits.list');
            }

            // Vérifiez si l'utilisateur a le rôle 'client'
            if ($user->role === 'client') {
                // Rediriger les utilisateurs client vers la page d'accueil
                return redirect('/');
            }

            // Rediriger les autres utilisateurs vers une autre page ou afficher une erreur
            Auth::logout();
            return redirect()->route('afficherFormConnexion')->withErrors([
                'email' => 'Vous n\'avez pas les droits d\'accès nécessaires.',
            ]);
        }

        return back()->withErrors([
            'email' => 'Les informations d\'identification ne correspondent pas.',
        ])->withInput($request->only('email'));
    }
    public function deconnexion(Request $request)
    {
        Auth::logout(); // Déconnexion de l'utilisateur
        $request->session()->invalidate(); // Invalidaion de la session
        $request->session()->regenerateToken(); // Régénération du token CSRF

        return redirect()->route('accueilCategories')->with('success', 'Vous avez été déconnecté avec succès.');
    }
}
