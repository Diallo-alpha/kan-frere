<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Produit</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Ajouter un Produit</h2>
        <form method="post" action="{{ route('ajoutTraitement') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="nom">Nom</label>
                <input id="nom" class="form-control" type="text" name="nom" value="{{ old('nom') }}" required>
            </div>

            <div class="form-group">
                <label for="reference">Référence</label>
                <input id="reference" class="form-control" type="text" name="reference" value="{{ old('reference') }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input id="image" class="form-control-file" type="file" name="image" required>
            </div>

            <div class="form-group">
                <label for="etat">État</label>
                <select id="etat" class="form-control" name="etat" required>
                    <option value="rupture">Rupture de stock</option>
                    <option value="stock">En stock</option>
                </select>
            </div>

            <div class="form-group">
                <label for="prix">Prix</label>
                <input id="prix" class="form-control" type="number" name="prix" value="{{ old('prix') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
