<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    <div class="limit">
        <div class="login-container">
            <div class="bb-login">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('inscription') }}" class="bb-form validate-form">
                    @csrf
                    <span class="bb-form-title p-b-26">Créer un compte</span>
                    <span class="bb-form-title p-b-48"><i class="mdi mdi-symfony"></i></span>

                    <div class="wrap-input100 validate-input" data-validate="Veuillez saisir votre nom">
                        <input class="input100" id="nom" type="text" name="nom" placeholder="Nom" value="{{ old('nom') }}" required autocomplete="nom" autofocus>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Veuillez saisir votre prénom">
                        <input class="input100" id="prenom" type="text" name="prenom" placeholder="Prénom" value="{{ old('prenom') }}" required autocomplete="prenom">
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">
                        <input class="input100" id="email" type="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Enter phone number">
                        <input class="input100" id="telephone" type="text" name="telephone" placeholder="Numéro de téléphone" value="{{ old('telephone') }}">
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <span class="btn-show-pass"><i class="mdi mdi-eye show_password"></i></span>
                        <input class="input100" id="password" type="password" name="password" placeholder="Mot de passe" required autocomplete="new-password">
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Confirm password">
                        <span class="btn-show-pass"><i class="mdi mdi-eye show_password"></i></span>
                        <input class="input100" id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required autocomplete="new-password">
                    </div>

                    <input type="hidden" name="role" value="client">

                    <div class="login-container-form-btn">
                        <div class="bb-login-form-btn">
                            <div class="bb-form-bgbtn"></div>
                            <button type="submit" class="bb-form-btn">Incrire</button>
                        </div>
                    </div>

                    <div class="text-center p-t-115">
                        <span class="txt1">Vous avez déjà un compte?</span>
                        <a class="txt2" href="{{ route('afficherFormConnexion') }}">Se connecter</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
