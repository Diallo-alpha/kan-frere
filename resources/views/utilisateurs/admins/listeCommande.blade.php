@extends('layouts.app')

@section('title', 'Voir les commandes')

@section('content')
<div class="d-flex">
    <div class="sidebar">
        <div class="text-center mb-4">
            <h1>KAN&FRERE</h1>
        </div>
        <nav class="nav flex-column">
            <div class="nav-item">
                <a href="{{route('accueilCategories')}}"><i class="fas fa-home"></i> Accueil</a>
            </div>
            <div class="nav-item">
                <a href="{{ route('ajouterProduit') }}"><i class="fas fa-box"></i> Ajouter un produit</a>
            </div>
            <div class="nav-item active">
                <a href="{{ route('commandes.liste') }}"><i class="fas fa-list"></i> Voir les commandes</a>
            </div>
            <div class="nav-item">
                <a href="{{ route('listeCategories') }}"><i class="fas fa-list"></i> Voir les catégories</a>
            </div>
            <div class="nav-item">
                <a href="#"><i class="fas fa-chart-bar"></i> Vue d'ensemble</a>
            </div>
            <div class="nav-item">
                <a href="#"><i class="fas fa-warehouse"></i> Stock</a>
            </div>
            <div class="nav-item">
                <a href="#"><i class="fas fa-file-alt"></i> Rapports</a>
            </div>
            <div class="nav-item">
                <a href="#"><i class="fas fa-exchange-alt"></i> Transfert de données</a>
            </div>
            <div class="nav-item">
                <a href="#"><i class="fas fa-question-circle"></i> Aide</a>
            </div>
            <div class="mt-4">
                <h6>Paramètres et Compte</h6>
                <div class="nav-item">
                    <a href="#"><i class="fas fa-cog"></i> Paramètres du compte</a>
                </div>
                <div class="nav-item">
                    <a href="#"><i class="fas fa-history"></i> Activité</a>
                </div>
                <div class="nav-item">
                    <a href="#"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                </div>
            </div>
        </nav>
    </div>
    <div class="content flex-grow-1">
        <div class="header">
            <h2>Liste des Commandes</h2>
            <div class="search-bar">
                <input type="text" class="form-control" placeholder="Rechercher une commande...">
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Référence</th>
                    <th>Total</th>
                    <th>Date de Commande</th>
                    <th>Produits</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commandes as $commande)
                    <tr>
                        <td>{{ $commande->id }}</td>
                        <td>{{ $commande->reference }}</td>
                        <td>{{ $commande->total }}</td>
                        <td>{{ $commande->created_at }}</td>
                        <td>
                            <ul>
                                @foreach($commande->produits as $produit)
                                    <li>{{ $produit->nom }} ({{ $produit->pivot->quantite }} x {{ $produit->pivot->prix }} Frans)</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <a href="{{ route('commandes.modifier', $commande->id) }}" class="btn btn-edit">Modifier</a>
                            <form action="{{ route('commandes.supprimer', $commande->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-delete">Supprimer</button>
                            </form>
                            <form action="{{ route('commandes.annuler', $commande->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-secondary">Annuler</button>
                            </form>
                            <form action="{{ route('commandes.confirmer', $commande->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">Confirmer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- <div class="pagination-bar">
            <span>Afficher 1 à {{ count($commandes) }} sur {{ $commandes->total() }}</span>
            {{ $commandes->links() }}
        </div> --}}
    </div>
</div>
@endsection
