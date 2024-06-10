<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CategorieController;

// Afficher le formulaire d'inscription
Route::get('/inscription', [UserController::class, 'formulaireInscription'])->name('form.inscription');
Route::post('/enregistrer', [UserController::class, 'enregistrer'])->name('inscription');
Route::get('/connexionForm', [UserController::class, 'afficherFormConnexion'])->name('afficherFormConnexion');
Route::post('/connexion', [UserController::class, 'connexion'])->name('connexion');
Route::get('/deconnexion', [UserController::class, 'deconnexion'])->name('deconnexion');

// Route pour lister tous les produits
Route::get('/produits', [ProduitController::class, 'accueilProduits'])->name('produits.list');

// Route pour afficher le formulaire d'ajout d'un nouveau produit
Route::get('/admins/ajouter', [ProduitController::class, 'ajouterProduit'])->name('ajouterProduit');

// Route pour traiter la soumission du formulaire d'ajout d'un nouveau produit
Route::post('/produits', [ProduitController::class, 'traiterAjoutProduit'])->name('traiterAjoutProduit');

// Route pour afficher le formulaire de modification d'un produit existant
Route::get('/produits/{id}/edit', [ProduitController::class, 'modifierProduitForm'])->name('modifierProduitForm');

// Route pour traiter la soumission du formulaire de modification d'un produit existant
Route::put('/produits/{id}', [ProduitController::class, 'traiterModificationProduit'])->name('traiterModificationProduit');

// Route pour gérer la demande de suppression d'un produit
Route::delete('/produits/{id}', [ProduitController::class, 'supprimerProduit'])->name('supprimerProduit');

// Route pour afficher les détails d'un produit
Route::get('/produits/{id}/details', [ProduitController::class, 'afficherDetailsProduit'])->name('afficherDetailsProduit');

// Routes pour les catégories
Route::get('/categories', [CategorieController::class, 'listeCategories'])->name('listeCategories');
Route::get('/ajouter/categorie', [CategorieController::class, 'afficherFormAjoutCategorie'])->name('afficherFormAjoutCategorie');
Route::post('/categorie', [CategorieController::class, 'ajouterCategorie'])->name('ajouterCategorie');
Route::get('/categories/{id}/edit', [CategorieController::class, 'afficherFormModifierCategorie'])->name('afficherFormModifierCategorie');
Route::put('/categories/{id}', [CategorieController::class, 'modifierCategorie'])->name('modifierCategorie');
Route::delete('/categories/{id}', [CategorieController::class, 'supprimerCategorie'])->name('supprimerCategorie');

// Route pour afficher la page d'accueil des produits
// Route::get('/admins', [ProduitController::class, 'accueilProduits'])->name('accueilProduits');
// Route pour afficher la page d'accueil des catégories
Route::get('/', [ProduitController::class,'accueilCategories'])->name('accueilCategories');
// Routes pour les commandes
Route::post('/commandes/creer', [CommandeController::class, 'creerCommande'])->name('creerCommande');
Route::get('/commandes/ajouter', [CommandeController::class, 'ajouterCommande'])->name('ajouterCommande');
Route::get('/commandes/{id}/modifier', [CommandeController::class, 'modifierCommande'])->name('modifierCommande');
Route::post('/commandes/{id}/update', [CommandeController::class, 'updateCommande'])->name('updateCommande');
Route::post('/commandes/{id}/annuler', [CommandeController::class, 'annulerCommande'])->name('annulerCommande');
Route::post('/commandes/{id}/confirmer', [CommandeController::class, 'confirmerCommande'])->name('confirmerCommande');
