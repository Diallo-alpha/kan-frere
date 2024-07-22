<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" crossorigin="anonymous" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/produits.css') }}">
</head>
<body>
    <div class="d-flex">
        <div class="sidebar">
            <div class="text-center mb-4">
                <h1>KAN&FRERE</h1>
            </div>
            <nav class="nav flex-column">
                <div class="nav-item active">
                    <a href="{{route('accueilCategories')}}"><i class="fas fa-home"></i> Accueil</a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('ajouterProduit') }}"><i class="fas fa-box"></i> Ajouter un produit</a>
                </div>
                <div class="nav-item">
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>
</html>
