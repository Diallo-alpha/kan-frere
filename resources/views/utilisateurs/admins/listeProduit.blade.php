<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Liste des Produits</h2>
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
                    <th>Categorie</th>
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
                        <td>
                            <a href="{{ route('formulaire.modifier', $produit->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('produits.supprimer', $produit->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                            <a href="{{ route('produits.detaillesProduit', $produit->id) }}" class="btn btn-info">Voir Détails</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
