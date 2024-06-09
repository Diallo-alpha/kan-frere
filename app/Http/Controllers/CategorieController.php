<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    public function accueilCategories()
    {
        $categories = Categorie::all();
        $produits = Produit::with('categorie')->get();
        return view('visiteurs.accueil', compact('categories', 'produits'));
    }
    public function listCategorie()
    {
        $categories = Categorie::all();
        return view('categories.listCategories', compact('categories'));
    }

    public function formulaireCategorie()
    {
        return view('categories.ajoutCategorie');
    }

    public function ajouterCategorie(Request $request)
    {
        $request->validate([
            'libelle' => 'required|string|max:255|unique:categories',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/categories'), $imageName);
        }

        Categorie::create([
            'libelle' => $request->libelle,
            'image' => $imageName,
        ]);

        return redirect()->route('liste.categories')->with('success', 'Catégorie ajoutée avec succès !');
    }

    public function afficherFormModifier($id)
    {
        $categorie = Categorie::findOrFail($id);
        return view('categories.modifierCategorie', compact('categorie'));
    }

    public function miseAjour(Request $request, $id)
    {
        $request->validate([
            'libelle' => 'required|string|max:255|unique:categories,libelle,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10048',
        ]);

        $categorie = Categorie::findOrFail($id);

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images/categories'), $imageName);
            $categorie->image = $imageName;
        }

        $categorie->update([
            'libelle' => $request->libelle,
            'image' => $categorie->image,
        ]);

        return redirect()->route('liste.categories')->with('success', 'Catégorie ajoutée avec succès !');
    }

    public function supprimmerCategorie($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();
        return redirect()->route('liste.categories')->with('success', 'Catégorie ajoutée avec succès !');
    }
}
