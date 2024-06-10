<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function accueilProduits()
    {
        $produits = Produit::with('categorie')->get();
        return view('utilisateurs.admins.listeProduit', compact('produits'));
    }
    public function accueilCategories()
    {
        $categories = Categorie::all();
        $produits = Produit::with('categorie')->get();
        return view('visiteurs.accueil', compact('categories', 'produits'));
    }
    public function voirPlus()
    {
        $produits = Produit::all();
        return view('utilisateurs.admins.listeProduit', compact('produits'));
    }

    public function ajouterProduit()
    {
        $categories = Categorie::all();
        return view('utilisateurs.admins.ajouterProduit', compact('categories'));
    }

    public function ajoutTraitement(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'reference' => 'required|string|max:255|unique:produits',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:12048',
            'etat' => 'required|in:rupture,stock',
            'prix' => 'required|integer',
            'categorie_id' => 'nullable|exists:categories,id',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }

        Produit::create([
            'nom' => $request->nom,
            'reference' => $request->reference,
            'description' => $request->description,
            'image' => $imageName,
            'etat' => $request->etat,
            'prix' => $request->prix,
            'categorie_id' => $request->categorie_id,
        ]);

        return redirect()->route('produits.list')->with('success', 'Produit ajouté avec succès !');
    }

    public function detaillesProduit($id)
    {
        $produit = Produit::findOrFail($id);
        return view('utilisateurs.admins.detaillesProduit', compact('produit'));
    }

    public function modifier($id)
    {
        $produit = Produit::findOrFail($id);
        $categories = Categorie::all();
        return view('utilisateurs.admins.ModifierProduit', compact('produit', 'categories'));
    }


    public function modifierProduit(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'reference' => 'required|string|max:255|unique:produits,reference,' . $id,
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'etat' => 'required|in:rupture,stock',
            'prix' => 'required|integer',
            'categorie_id' => 'nullable|exists:categories,id',
        ]);

        $produit = Produit::findOrFail($id);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $produit->image = $imageName;
        }

        $produit->update([
            'nom' => $request->nom,
            'reference' => $request->reference,
            'description' => $request->description,
            'etat' => $request->etat,
            'prix' => $request->prix,
            'categorie_id' => $request->categorie_id,
        ]);

        return redirect()->route('produits.list')->with('success', 'Produit mis à jour avec succès !');
    }

    public function supprimerProduit($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();

        return redirect()->route('produits.list')->with('success', 'Produit supprimé avec succès !');
    }
}
