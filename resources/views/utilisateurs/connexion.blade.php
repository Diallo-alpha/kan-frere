<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    <div class="limit">
        <div class="login-container">
            <div class="bb-login">
                <form method="POST" action="{{ route('login') }}" class="bb-form validate-form">
                    @csrf
                    <span class="bb-form-title p-b-26">Bienvenue</span>
                    <span class="bb-form-title p-b-48"><i class="mdi mdi-symfony"></i></span>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is: a@b.c">
                        <input class="input100" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <span class="bbb-input" data-placeholder="Email"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <span class="btn-show-pass"><i class="mdi mdi-eye show_password"></i></span>
                        <input class="input100" id="password" type="password" name="password" required autocomplete="current-password">
                        <span class="bbb-input" data-placeholder="Mots de passe"></span>
                    </div>

                    <div class="login-container-form-btn">
                        <div class="bb-login-form-btn">
                            <div class="bb-form-bgbtn"></div>
                            <button class="bb-form-btn">Connexion</button>
                        </div>
                    </div>

                    <div class="text-center p-t-115">
                        <span class="txt1">Vous n'avez pas de compte?</span>
                        <a class="txt2" href="{{ route('form.inscription') }}">Inscrire</a>
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
