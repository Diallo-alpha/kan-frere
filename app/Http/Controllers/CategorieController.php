<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategorieController extends Controller
{
    public function listCategorie()
    {
        try {
            $categories = Categorie::all();
            return view('categories.listCategories', compact('categories'));
        } catch (\Exception $e) {
            Log::error('Erreur lors de la récupération des catégories: ' . $e->getMessage());
            return redirect()->back()->withErrors('Une erreur est survenue lors de la récupération des catégories.');
        }
    }

    public function afficherFormAjoutCategorie()
    {
        return view('categories.ajoutCategorie');
    }

    public function ajouterCategorie(Request $request)
    {
        try {
            $request->validate([
                'libelle' => 'required|string|max:255|unique:categories',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:42048',
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

            return redirect()->route('listeCategories')->with('success', 'Catégorie ajoutée avec succès !');
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'ajout de la catégorie: ' . $e->getMessage());
            return redirect()->back()->withErrors('Une erreur est survenue lors de l\'ajout de la catégorie.');
        }
    }

    public function afficherFormModifierCategorie($id)
    {
        try {
            $categorie = Categorie::findOrFail($id);
            return view('categories.modifierCategorie', compact('categorie'));
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'affichage du formulaire de modification de la catégorie: ' . $e->getMessage());
            return redirect()->back()->withErrors('Une erreur est survenue lors de l\'affichage du formulaire de modification.');
        }
    }

    public function miseAjour(Request $request, $id)
    {
        try {
            $request->validate([
                'libelle' => 'required|string|max:255|unique:categories,libelle,' . $id,
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:42048',
            ]);

            $categorie = Categorie::findOrFail($id);

            if ($request->hasFile('image')) {
                if (!$request->file('image')->isValid()) {
                    throw new \Exception('Le fichier du champ image n\'a pu être téléversé.');
                }
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images/categories'), $imageName);
                $categorie->image = $imageName;
            }

            $categorie->update([
                'libelle' => $request->libelle,
                'image' => $categorie->image,
            ]);

            return redirect()->route('listeCategories')->with('success', 'Catégorie modifiée avec succès !');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la mise à jour de la catégorie: ' . $e->getMessage());
            return redirect()->back()->withErrors('Une erreur est survenue lors de la mise à jour de la catégorie.');
        }
    }


    public function supprimmerCategorie($id)
    {
        try {
            $categorie = Categorie::findOrFail($id);
            $categorie->delete();
            return redirect()->route('listeCategories')->with('success', 'Catégorie supprimée avec succès !');
        } catch (\Exception $e) {
            Log::error('Erreur lors de la suppression de la catégorie: ' . $e->getMessage());
            return redirect()->back()->withErrors('Une erreur est survenue lors de la suppression de la catégorie.');
        }
    }
}
