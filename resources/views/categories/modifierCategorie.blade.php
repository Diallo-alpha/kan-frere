<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Catégorie</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Modifier une Catégorie</h1>
        <form method="post" action="{{ route('modifierCategorie', $categorie->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="libelle">Libellé</label>
                <input id="libelle" class="form-control" type="text" name="libelle" value="{{ old('libelle', $categorie->libelle) }}" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input id="image" class="form-control-file" type="file" name="image">
                @if ($categorie->image)
                    <div class="mt-2">
                        <img src="{{ asset('images/categories/' . $categorie->image) }}" alt="Image de {{ $categorie->libelle }}" width="100">
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
