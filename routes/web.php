<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProduitController;

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
Route::get('/produits/{id}/edit', [ProduitController::class, 'modifier'])->name('produits.edit');
Route::put('/produits/{id}', [ProduitController::class, 'modifierProduit'])->name('produits.modifier');
Route::delete('/produits/{id}', [ProduitController::class, 'supprimmerProduit'])->name('produits.supprimer');
Route::get('/produits/{id}', [ProduitController::class, 'detailles'])->name('produits.detailles');
