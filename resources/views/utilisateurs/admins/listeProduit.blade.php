@extends('layouts.app')

@section('title', 'Voir les commandes')

@section('content')
        <div class="content flex-grow-1">
            <div class="header">
                <h2>Liste des Produits</h2>
                <div class="search-bar">
                    <input type="text" class="form-control" placeholder="Rechercher un produit...">
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Référence</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>État</th>
                        <th>Prix</th>
                        <th>Catégorie</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produits as $produit)
                        <tr>
                            <td>{{ $produit->id }}</td>
                            <td>{{ $produit->nom }}</td>
                            <td>{{ $produit->reference }}</td>
                            <td>{{ $produit->description }}</td>
                            <td><img src="{{ asset('images/' . $produit->image) }}" alt="Image du produit" width="50"></td>
                            <td>{{ $produit->etat }}</td>
                            <td>{{ $produit->prix }} Frans CFA</td>
                            <td>{{ $produit->categorie ? $produit->categorie->libelle : 'null' }}</td>
                            <td class="action-buttons">
                                <a href="{{ route('modifierProduitForm', $produit->id) }}" class="btn btn-edit">Modifier</a>
                                <form action="{{ route('supprimerProduit', $produit->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-delete">Supprimer</button>
                                </form>
                                <a href="{{ route('afficherDetailsProduit', $produit->id) }}" class="btn btn-view">Voir Détails</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination-bar">
                <span>Afficher 1 à {{ count($produits) }} sur {{ count($produits) }}</span>
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">Précédent</a></li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">Suivant</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
