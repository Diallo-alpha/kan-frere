<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function voirPlus()
    {
        $produits = Produit::all();
        return view('utilisateurs.admins.listeProduits', compact('produits'));
    }
    public function ajouterProduit()
    {
        return view('utilisateurs.admins.ajouterProduit');
    }

    public function ajoutTraitement(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'reference' => 'required|string|max:255|unique:produits',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'etat' => 'required|in:rupture,stock',
            'prix' => 'required|integer',
            'categorie_id' => 'nullable|exists:categories,id',
        ]);

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

        return redirect()->route('inscription')->with('success', 'Produit ajouté avec succès !');
    }
    public function detailles($id)
{
    $produit = Produit::findOrFail($id);
    return view('utilisateurs.admins.detailProduit', compact('produit'));
}


    public function modifier($id)
    {
        $produit = Produit::findOrFail($id);
        return view('utilisateurs.admins.editProduit', compact('produit'));
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

        return redirect()->route('inscription')->with('success', 'Produit mis à jour avec succès !');
    }

    public function supprimmerProduit($id)
    {
        $produit = Produit::findOrFail($id);
        $produit->delete();

        return redirect()->route('inscription')->with('success', 'Produit supprimé avec succès !');
    }
}
