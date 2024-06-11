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
Route::post('/produits', [ProduitController::class, 'ajoutTraitement'])->name('traiterAjoutProduit');

// Route pour afficher le formulaire de modification d'un produit existant
Route::get('/produits/{id}/edit', [ProduitController::class, 'modifier'])->name('modifierProduitForm');

// Route pour traiter la soumission du formulaire de modification d'un produit existant
Route::put('/produits/{id}', [ProduitController::class, 'modifierProduit'])->name('traiterModificationProduit');

// Route pour gérer la demande de suppression d'un produit
Route::delete('/produits/{id}', [ProduitController::class, 'supprimerProduit'])->name('supprimerProduit');

// Route pour afficher les détails d'un produit
Route::get('/produits/{id}/details', [ProduitController::class, 'detaillesProduit'])->name('afficherDetailsProduit');

// Routes pour les catégories
Route::get('/categories', [CategorieController::class, 'listCategorie'])->name('listeCategories');
Route::get('/ajouter/categorie', [CategorieController::class, 'afficherFormAjoutCategorie'])->name('afficherFormAjoutCategorie');
Route::post('/categorie', [CategorieController::class, 'ajouterCategorie'])->name('ajouterCategorie');
Route::get('/categories/{id}/edit', [CategorieController::class, 'afficherFormModifierCategorie'])->name('afficherFormModifierCategorie');
Route::put('/categories/{id}', [CategorieController::class, 'miseAjour'])->name('modifierCategorie');
Route::delete('/categories/{id}', [CategorieController::class, 'supprimmerCategorie'])->name('supprimerCategorie');
// Route pour afficher la page d'accueil des catégories
Route::get('/', [ProduitController::class,'accueilCategories'])->name('accueilCategories');
// Routes pour les commandes

Route::get('/commandes', [CommandeController::class, 'listeCommande'])->name('commandes.liste');
Route::get('/produits/{id}', [CommandeController::class, 'ajouterCommande'])->name('commandes.ajouter');
Route::post('/commandes/creer', [CommandeController::class, 'creerCommande'])->name('commandes.creer');
Route::get('/commandes/{id}/modifier', [CommandeController::class, 'modifier'])->name('commandes.modifier');
Route::post('/commandes/{id}/modifier', [CommandeController::class, 'modiferTraitement'])->name('commandes.modiferTraitement');
Route::delete('/commandes/{id}', [CommandeController::class, 'supprimerCommande'])->name('commandes.supprimer');
Route::post('/commandes/{id}/annuler', [CommandeController::class, 'annulerCommande'])->name('commandes.annuler');
Route::post('/commandes/{id}/confirmer', [CommandeController::class, 'confirmerCommande'])->name('commandes.confirmer');

//test code
// Route::get('/', function()
//     {
//         return view('test.testAccueil');
//     }
// );
