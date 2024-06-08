<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CategorieController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/inscription', [UserController::class, 'formulaireInscription']);
Route::post('/enregistrer', [UserController::class, 'enregistrer'])->name('inscription');
Route::get('/connexionForm', [UserController::class, 'afficherFormConnexion']);
Route::post('/connexion', [UserController::class, 'connexion'])->name('connexion');

// Routes pour les produits
Route::get('/produits', [ProduitController::class, 'voirPlus'])->name('produits.list');
Route::get('/admin/ajouter', [ProduitController::class, 'ajouterProduit'])->name('ajouterProduit');
Route::post('/produits', [ProduitController::class, 'ajoutTraitement'])->name('ajoutTraitement');
Route::get('/produits/{id}/edit', [ProduitController::class, 'modifier'])->name('produits.modifier');
Route::put('/produits/{id}', [ProduitController::class, 'modifierProduit'])->name('produits.modifier');
Route::delete('/produits/{id}', [ProduitController::class, 'supprimerProduit'])->name('produits.supprimer');
Route::get('/produits/{id}/details', [ProduitController::class, 'detaillesProduit'])->name('produits.detaillesProduit');
//categories
Route::get('/categorie', [CategorieController::class, 'listCategorie'])->name('liste.categories');
Route::get('/ajouter/categorie', [CategorieController::class, 'formulaireCategorie'])->name('afficher.formulaire');
Route::post('/categorieTraitement', [CategorieController::class, 'ajouterCategorie'])->name('ajouter.categorie');
Route::get('/categories/{id}/editer', [CategorieController::class, 'afficherFormModifier'])->name('formulaire.categorie.editer');
Route::put('/categories/{id}', [CategorieController::class, 'miseAjour'])->name('modier.categorie');
Route::delete('/categories/{id}', [CategorieController::class, 'supprimmerCategorie'])->name('categories.supprimer');
