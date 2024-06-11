<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-8FGzKlYc+aUU3GxOKGJI/tFUWkswOAhIsH73/2MCdvfiuYQzg+u9BjMvYDBuebKNTpnujps2l1rhjJkxZlP0Kg==" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('css/accueil.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Accueil</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container d-flex justify-content-between">
            <div>
                <h1 class="text-success">Kan&frere</h1>
            </div>
            <div class="navbar navbar-expand-lg bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item nav-items">
                            <a class="nav-link nav-links" aria-current="page" href="{{route('accueilCategories')}}">Accueil</a>
                        </li>
                        <li class="nav-item nav-items">
                            <a class="nav-link nav-links" href="#">A propos</a>
                        </li>
                        <li class="nav-item nav-items">
                            <a class="nav-link nav-links" href="#">Produits</a>
                        </li>
                        <li class="nav-item nav-items">
                            <a class="nav-link nav-links" href="#">Contact</a>
                        </li>
                    </ul>
                    <div class="position-relative">
                        <a href="" class="text-decoration-none text-dark">
                            <i class="fa-solid fa-magnifying-glass nav-icon"></i>
                        </a>
                        <a href="" class="text-decoration-none text-dark">
                            <i class="fa-solid fa-cart-arrow-down nav-icon"></i>
                        </a>
                        @auth
                        <a href="{{ route('deconnexion') }}" class="text-decoration-none text-dark">
                            <i class="fa-solid fa-sign-out-alt nav-icon">Déconnexion</i>
                        </a>
                        @else
                        <a href="{{ route('afficherFormConnexion') }}" class="text-decoration-none text-dark">
                            <i class="fa-solid fa-user nav-icon">connexion</i>
                        </a>
                        <a href="{{ route('form.inscription') }}" class="btn btn-primary ml-3">S'inscrire</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
        <a href="{{ route('commandes.afficherPanier') }}" class="btn btn-primary ml-3"><i class='bx bx-shopping-bag'id="shopicon" ></i></a>
    </nav>
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
