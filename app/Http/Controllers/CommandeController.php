<?php
namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
class CommandeController extends Controller
{
    public function listeCommande()
    {
        $commandes = Commande::all();
        return view('utilisateurs.admins.listeCommande', compact('commandes'));
    }

    public function ajouterCommande(Request $request, $id)
    {
        if (Auth::check()) {
            $produit = Produit::find($id);
            $quantite = $request->input('quantite', 1);

            $panier = Session::get('panier', []);
            if (isset($panier[$id])) {
                $panier[$id]['quantite'] += $quantite;
            } else {
                $panier[$id] = [
                    'produit' => $produit,
                    'quantite' => $quantite,
                    'prix' => $produit->prix,
                ];
            }

            Session::put('panier', $panier);

            return redirect()->back()->with('success', 'Produit ajouté au panier.');
        } else {
            return redirect()->route('afficherFormConnexion')->with('error', 'Vous devez être connecté pour ajouter un produit au panier.');
        }
    }

    public function afficherPanier()
    {
        $panier = Session::get('panier', []);
        return view('commandes.panier', compact('panier'));
    }

    public function creerCommande(Request $request)
    {
        if (Auth::check()) {
            $panier = Session::get('panier', []);
            if (empty($panier)) {
                return redirect()->back()->with('error', 'Votre panier est vide.');
            }

            $total = 0;
            foreach ($panier as $item) {
                $total += $item['prix'] * $item['quantite'];
            }

            $commande = new Commande();
            $commande->user_id = Auth::id();
            $commande->total = $total;
            $commande->reference = 'REF' . time();
            $commande->save();

            foreach ($panier as $id => $item) {
                $commande->produits()->attach($id, [
                    'quantite' => $item['quantite'],
                    'prix' => $item['prix'],
                ]);
            }

            Session::forget('panier');

            return redirect('/')->with('success', 'Commande créée avec succès. Total: ' . $commande->total . ' Frans');
        } else {
            return redirect()->route('afficherFormConnexion')->with('error', 'Vous devez être connecté pour créer une commande.');
        }
    }

    public function supprimerDuPanier($id)
    {
        $panier = Session::get('panier', []);
        if (isset($panier[$id])) {
            unset($panier[$id]);
            Session::put('panier', $panier);
        }
        return redirect()->back()->with('success', 'Produit supprimé du panier.');
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
        return redirect()->route('commandes.liste')->with('success', 'Commande supprimée avec succès.');
    }
}
