<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href ="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==">
    <link rel="stylesheet" href="{{ asset('css/accueil.css') }}">
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
                            <a class="nav-link nav-links" aria-current="page" href="#">Accueil</a>
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
                        @auth <!-- Vérifie si l'utilisateur est connecté -->
                        <a href="{{ route('deconnexion') }}" class="text-decoration-none text-dark">
                            <i class="fa-solid fa-sign-out-alt nav-icon">Déconnexion</i>
                        </a>
                        @else
                        <a href="{{ route('connexion') }}" class="text-decoration-none text-dark">
                            <i class="fa-solid fa-user nav-icon">connexion</i>
                        </a>
                        <a href="{{ route('form.inscription') }}" class="btn btn-primary ml-3">S'inscrire</a>
                        @endauth <!-- Fin de la vérification de l'authentification -->
                    </div>
                </div>
            </div>
        </div>
    </nav>

{{-- carroussel --}}
<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="https://images.unsplash.com/photo-1523381294911-8d3cead13475?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1523381294911-8d3cead13475?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="d-block w-100" alt="...">
        </div>
        <div class="carousel-item">
            <img src="https://images.unsplash.com/photo-1523381294911-8d3cead13475?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="d-block w-100" alt="...">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>

  {{--cartes--}}
  <div class="container mt-5">
    <h2 class="mb-4">Nos Produits</h2>
    <div class="conteneur-cartes row">
        @foreach($produits as $produit)
            <div class="carte-produit col-md-4 mb-4">
                <div class="vignette-produit">
                    <img src="{{ asset('images/' . $produit->image) }}" alt="{{ $produit->nom }}" class="img-fluid">
                </div>
                <div class="details-produit">
                    <span class="categorie-produit">{{ $produit->categorie ? $produit->categorie->libelle : 'N/A' }}</span>
                    <h4><a href="">{{ $produit->nom }}</a></h4>
                    <p>{{ $produit->description }}</p>
                    <div class="details-bas-produit">
                        <div class="prix-produit">{{ $produit->prix }} Frans</div>
                        <div class="liens-produit">
                            <a href=""><i class="fa fa-heart"></i></a>
                            <a href=""><i class="fa fa-shopping-cart"></i></a>
                        </div>
                    </div>
                    <form action="{{ route('creerCommande') }}" method="POST" class="d-inline">
                        @csrf
                        <input type="hidden" name="total" value="{{ $produit->prix }}">
                        <button type="submit" class="btn btn-primary">Commander</button>
                    </form>
                    <button class="btn btn-secondary">Voir Détails</button>
                </div>
            </div>
        @endforeach
    </div>
</div>
 {{-- Catégories --}}
<div class="container mt-5">
    <h2 class="mb-4">Catégories</h2>
    <div class="categorie-section row">
        @foreach($categories as $categorie)
            <div class="categorie col-md-3 mb-4">
                @if ($categorie->image)
                    <img src="{{ asset('images/categories/' . $categorie->image) }}" class="img-fluid" alt="{{ $categorie->libelle }}">
                @else
                    <img src="https://via.placeholder.com/150" class="img-fluid" alt="Image par défaut">
                @endif
                <p class="mt-2">{{ $categorie->libelle }}</p>
            </div>
        @endforeach
    </div>
</div>
{{--contact--}}
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4>About Us</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet.</p>
            </div>
            <div class="col-md-4">
                <h4>Quick Links</h4>
                <ul class="list-unstyled">
                    <li><a href="#">Accueil</a></li>
                    <li><a href="#">A propos</a></li>
                    <li><a href="#">Produits</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h4>Follow Us</h4>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
</footer>
<script src="{{asset('js/commande.js')}}"></script>
<script src="{{asset('js/script.js')}}"></script>
</body>
</html>
