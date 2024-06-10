<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Catégorie</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Ajouter une Catégorie</h1>
        <form method="post" action="{{ route('ajouterCategorie') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="libelle">Libellé</label>
                <input id="libelle" class="form-control" type="text" name="libelle" value="{{ old('libelle') }}" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input id="image" class="form-control-file" type="file" name="image">
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
