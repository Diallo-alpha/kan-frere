<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommandeController extends Controller
{
    public function listeCommande()
    {
        $commandes = Commande::with('produits')->get();
        return view('utilisateurs.admins.listeCommande', compact('commandes'));
    }
    public function ajouterCommande($id)
    {
        $produits = Produit::all();
        return view('commandes.ajouterCommande', compact('produits'));
    }

    public function creerCommande(Request $request)
    {
        if (Auth::check()) {
            $produits = $request->input('produits');
            $quantites = $request->input('quantites');
            $prix = $request->input('prix');

            $total = 0;

            // Calculer le total de la commande
            foreach ($prix as $index => $p) {
                $total += $p * $quantites[$index];
            }

            $commande = new Commande();
            $commande->user_id = Auth::id();
            $commande->total = $total;

            // Générer une référence unique pour la commande
            $refrences = 'REF' . time(); // Exemple d'une référence unique basée sur le timestamp
            $commande->reference = $refrences;
            $commande->save();

            // Enregistrer chaque produit de la commande avec la jointure
            foreach ($produits as $index => $produitId) {
                $commande->produits()->attach($produitId, [
                    'quantite' => $quantites[$index],
                    'prix' => $prix[$index],
                ]);
            }

            return redirect('/')->with('success', 'Commande créée avec succès. Total: ' . $commande->total . ' Frans');
        } else {
            // L'utilisateur n'est pas connecté, rediriger vers la page de connexion
            return redirect()->route('afficherFormConnexion')->with('error', 'Vous devez être connecté pour ajouter une commande.');
        }
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
    public function modifier($id)
    {
        $commande = Commande::findOrFail($id);
        $produits = Produit::all();
        return view('utilisateurs.admins.modifierCommande', compact('commande', 'produits'));
    }
    public function modiferTraitement(Request $request, $id)
    {
        $commande = Commande::findOrFail($id);
        $commande->produits()->detach();

        foreach ($request->produits as $index => $produitId) {
            $commande->produits()->attach($produitId, [
                'quantite' => $request->quantites[$index],
                'prix' => $request->prix[$index],
            ]);
        }

        $total = array_reduce($request->prix, function ($carry, $item) {
            return $carry + $item;
        });

        $commande->total = $total;
        $commande->save();

        return view('utilisateurs.admins.listeCommande')->with('success', 'Commande modifiée avec succès.');
    }

    public function supprimerCommande($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->delete();
        return redirect()->route('commandes.index')->with('success', 'Commande supprimée avec succès.');
    }
}
