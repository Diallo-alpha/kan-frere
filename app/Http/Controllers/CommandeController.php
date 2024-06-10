<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    public function ajouterCommande()
    {
        // Vérifier si l'utilisateur est connecté
        if (Auth::check()) {
            return view('commandes.ajouterCommande');
        } else {
            // L'utilisateur n'est pas connecté, rediriger vers la page d'inscription
            return redirect()->route('form.inscription')->with('error', 'Vous devez être connecté pour ajouter une commande.');
        }
    }

    public function creerCommande(Request $request)
    {
        // Vérifiez si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('afficherFormConnexion')->with('error', 'Vous devez être connecté pour passer une commande.');
        }

        // Validation des données de la commande
        $request->validate([
            'total' => 'required|numeric',
            'produits' => 'required|array',
            'quantites' => 'required|array',
            'prix' => 'required|array',
        ]);

        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Créer une nouvelle commande
        $commande = new Commande();
        $commande->user_id = $user->id;
        $commande->reference = "REF_" . uniqid();
        $commande->total = $request->input('total');
        $commande->etat_commande = 'en_cours';
        $commande->date_commande = now();
        $commande->save();

        // Enregistrer chaque produit de la commande avec la jointure
        foreach ($request->produits as $index => $produit) {
            $commande->produits()->attach($produit_id, [
                'quantite' => $request->quantites[$index],
                'prix' => $request->prix[$index],
            ]);
        }

        return redirect()->route('commande.ajouter')->with('success', 'Commande créée avec succès. Total: ' . $commande->total . ' Frans');
    }

    public function annulerCommande($id)
    {
        $commande = Commande::find($id);
        if ($commande) {
            $commande->etat_commande = 'annulé';
            $commande->save();

            return redirect('/')->with('success', 'Commande annulée avec succès.');
        } else {
            return redirect('/')->with('error', 'Commande non trouvée.');
        }
    }

    public function confirmerCommande($id)
    {
        $commande = Commande::find($id);
        if ($commande) {
            $commande->etat_commande = 'valider';
            $commande->save();

            return redirect('/')->with('success', 'Commande confirmée avec succès.');
        } else {
            return redirect('/')->with('error', 'Commande non trouvée.');
        }
    }
}
