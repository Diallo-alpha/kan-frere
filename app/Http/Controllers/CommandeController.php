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
        $commandes = Commande::all();
        return view('utilisateurs.admins.listeCommande', compact('commandes'));
    }

    public function ajouterCommande($id)
    {
        if (Auth::check()) {
            $produits = Produit::all();
            return view('commandes.ajouterCommande', compact('produits'));
        } else {
            return redirect()->route('afficherFormConnexion')->with('error', 'Vous devez être connecté pour ajouter une commande.');
        }
    }

    public function creerCommande(Request $request)
    {
        if (Auth::check()) {
            $produits = $request->input('produits');
            $quantites = $request->input('quantites');
            $prix = $request->input('prix');
            $total = 0;

            foreach ($prix as $index => $p) {
                $total += $p * $quantites[$index];
            }

            $commande = new Commande();
            $commande->user_id = Auth::id();
            $commande->total = $total;

            $reference = 'REF' . time();
            $commande->reference = $reference;
            $commande->save();

            foreach ($produits as $index => $produitId) {
                $commande->produits()->attach($produitId, [
                    'quantite' => $quantites[$index],
                    'prix' => $prix[$index],
                ]);
            }

            return redirect('/')->with('success', 'Commande créée avec succès. Total: ' . $commande->total . ' Frans');
        } else {
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

        $total = 0;
        foreach ($request->produits as $index => $produitId) {
            $total += $request->quantites[$index] * $request->prix[$index];
        }

        $commande->total = $total;
        $commande->save();

        $commandes = Commande::all();
        return view('utilisateurs.admins.listeCommande', compact('commandes'));
    }

    public function supprimerCommande($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->delete();
        return redirect()->route('commandes.index')->with('success', 'Commande supprimée avec succès.');
    }
}
