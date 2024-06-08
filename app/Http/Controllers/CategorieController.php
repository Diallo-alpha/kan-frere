<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
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
        ]);

        Categorie::create($request->all());

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
        ]);

        $categorie = Categorie::findOrFail($id);
        $categorie->update($request->all());

        return redirect()->route('liste.categories')->with('success', 'Catégorie mise à jour avec succès !');
    }

    public function supprimmerCategorie($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();

        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès !');
    }
}
