<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5 mb-4">Connexion</h2>
        <form method="POST" action="{{ route('connexion') }}">
            @csrf

            <div class="form-group">
                <label for="email">E-mail</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password">
            </div>

            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
    </div>

    <!-- Inclure les scripts Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
