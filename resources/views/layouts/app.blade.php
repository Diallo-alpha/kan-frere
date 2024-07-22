<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-8FGzKlYc+aUU3GxOKGJI/tFUWkswOAhIsH73/2MCdvfiuYQzg+u9BjMvYDBuebKNTpnujps2l1rhjJkxZlP0Kg==" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/produits.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>@yield('title', 'Dashboard')</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container d-flex justify-content-between">
            <div>
                <h1 class="text-success">Kan&frere</h1>
            </div>
            <div class="navbar navbar-expand-lg bg-light">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('accueilCategories')}}">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">A propos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Produits</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                    <div class="position-relative">
                        <a href="" class="text-decoration-none text-dark">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                        <a href="" class="text-decoration-none text-dark">
                            <i class="fa-solid fa-cart-arrow-down"></i>
                        </a>
                        @auth
                        <a href="{{ route('deconnexion') }}" class="text-decoration-none text-dark">
                            <i class="fa-solid fa-sign-out-alt">Déconnexion</i>
                        </a>
                        @else
                        <a href="{{ route('afficherFormConnexion') }}" class="text-decoration-none text-dark">
                            <i class="fa-solid fa-user">connexion</i>
                        </a>
                        <a href="{{ route('form.inscription') }}" class="btn btn-primary ml-3">S'inscrire</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('commandes.afficherPanier') }}" class="btn btn-primary ml-3"><i class='bx bx-shopping-bag' id="shopicon"></i></a>
    </nav>

    <div class="d-flex">
        @include('includes.sidebar')

        <div class="content p-4" style="flex-grow: 1;">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-8FGzKlYc+aUU3GxOKGJI/tFUWkswOAhIsH73/2MCdvfiuYQzg+u9BjMvYDBuebKNTpnujps2l1rhjJkxZlP0Kg==" crossorigin="anonymous"></script>
</body>
</html>
