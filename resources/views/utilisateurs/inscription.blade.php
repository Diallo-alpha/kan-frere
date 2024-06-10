<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h2 class="mt-5 mb-4">Inscription</h2>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
        <form action="{{ route('inscription') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="nom">Nom</label>
                <input id="nom" class="form-control" type="text" name="nom" value="{{ old('nom') }}" required autocomplete="nom" autofocus>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input id="prenom" class="form-control" type="text" name="prenom" value="{{ old('prenom') }}" required autocomplete="prenom">
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="email">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirmer le mot de passe</label>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
            </div>
            @if(auth()->user() && auth()->user()->isAdmin())
            <div class="form-group">
                <label for="role">Rôle</label>
                <select id="role" class="form-control" name="role">
                    <option value="client">Client</option>
                    <option value="admin">Administrateur</option>
                </select>
            </div>
            @else
                <input type="hidden" name="role" value="client">
            @endif
            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
