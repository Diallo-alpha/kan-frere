<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Produit</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Modifier un Produit</h2>
        <form method="POST" action="{{ route('produits.modifier', $produit->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nom">Nom</label>
                <input id="nom" class="form-control" type="text" name="nom" value="{{ old('nom', $produit->nom) }}" required>
            </div>

            <div class="form-group">
                <label for="reference">Référence</label>
                <input id="reference" class="form-control" type="text" name="reference" value="{{ old('reference', $produit->reference) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" class="form-control" name="description">{{ old('description', $produit->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input id="image" class="form-control-file" type="file" name="image">
                <img src="{{ asset('images/'.$produit->image) }}" alt="Image du produit" width="100">
            </div>

            <div class="form-group">
                <label for="etat">État</label>
                <select id="etat" class="form-control" name="etat" required>
                    <option value="rupture" {{ old('etat', $produit->etat) == 'rupture' ? 'selected' : '' }}>Rupture de stock</option>
                    <option value="stock" {{ old('etat', $produit->etat) == 'stock' ? 'selected' : '' }}>En stock</option>
                </select>
            </div>

            <div class="form-group">
                <label for="prix">Prix</label>
                <input id="prix" class="form-control" type="number" name="prix" value="{{ old('prix', $produit->prix) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>

        <form method="POST" action="{{ route('produits.supprimer', $produit->id) }}" style="margin-top: 20px;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
