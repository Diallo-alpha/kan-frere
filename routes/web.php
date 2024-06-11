<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CategorieController;

// Routes publiques

// Afficher le formulaire d'inscription
Route::get('/inscription', [UserController::class, 'formulaireInscription'])->name('form.inscription');
Route::post('/enregistrer', [UserController::class, 'enregistrer'])->name('inscription');
Route::get('/connexionForm', [UserController::class, 'afficherFormConnexion'])->name('afficherFormConnexion');
Route::post('/connexion', [UserController::class, 'connexion'])->name('connexion');
Route::get('/deconnexion', [UserController::class, 'deconnexion'])->name('deconnexion');

// Route pour afficher la page d'accueil des catégories
Route::get('/', [ProduitController::class, 'accueilCategories'])->name('accueilCategories');

// Route pour lister tous les produits
// Route::get('/produits', [ProduitController::class, 'accueilProduits'])->name('produits.list');

// Routes pour afficher les détails d'un produit
// Route::get('/produits/{id}/details', [ProduitController::class, 'detaillesProduit'])->name('afficherDetailsProduit');

// Routes pour les commandes (accès public)
Route::post('/produits/{id}/ajouter', [CommandeController::class, 'ajouterCommande'])->name('commandes.ajouter');
Route::post('/commandes/creer', [CommandeController::class, 'creerCommande'])->name('commandes.creer');
Route::post('/commandes/{id}/annuler', [CommandeController::class, 'annulerCommande'])->name('commandes.annuler');
Route::post('/commandes/{id}/confirmer', [CommandeController::class, 'confirmerCommande'])->name('commandes.confirmer');
Route::get('/panier', [CommandeController::class, 'afficherPanier'])->name('commandes.afficherPanier');
Route::post('/panier/supprimer/{id}', [CommandeController::class, 'supprimerDuPanier'])->name('commandes.supprimerDuPanier');

// Middleware pour vérifier l'authentification et le rôle d'administrateur
Route::middleware(['auth', 'admin'])->group(function () {
    // Routes des produits
    Route::get('/admins/ajouter', [ProduitController::class, 'ajouterProduit'])->name('ajouterProduit');
    Route::post('/produits', [ProduitController::class, 'ajoutTraitement'])->name('traiterAjoutProduit');
    Route::get('/produits/{id}/edit', [ProduitController::class, 'modifier'])->name('modifierProduitForm');
    Route::put('/produits/{id}', [ProduitController::class, 'modifierProduit'])->name('traiterModificationProduit');
    Route::delete('/produits/{id}', [ProduitController::class, 'supprimerProduit'])->name('supprimerProduit');

    // Routes des catégories
    Route::get('/categories', [CategorieController::class, 'listCategorie'])->name('listeCategories');
    Route::get('/ajouter/categorie', [CategorieController::class, 'afficherFormAjoutCategorie'])->name('afficherFormAjoutCategorie');
    Route::post('/categorie', [CategorieController::class, 'ajouterCategorie'])->name('ajouterCategorie');
    Route::get('/categories/{id}/edit', [CategorieController::class, 'afficherFormModifierCategorie'])->name('afficherFormModifierCategorie');
    Route::put('/categories/{id}', [CategorieController::class, 'miseAjour'])->name('modifierCategorie');
    Route::delete('/categories/{id}', [CategorieController::class, 'supprimmerCategorie'])->name('supprimerCategorie');

    // Routes des commandes (accès administrateurs)
    Route::get('/commandes', [CommandeController::class, 'listeCommande'])->name('commandes.liste');
    Route::get('/commandes/{id}/modifier', [CommandeController::class, 'modifier'])->name('commandes.modifier');
    Route::post('/commandes/{id}/modifier', [CommandeController::class, 'modiferTraitement'])->name('commandes.modiferTraitement');
    Route::delete('/commandes/{id}', [CommandeController::class, 'supprimerCommande'])->name('commandes.supprimer');
});
