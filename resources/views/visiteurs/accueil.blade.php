<!DOCTYPE html>
<html lang="fr">
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
    {{-- Affichage des messages de succès et d'erreur --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Carrousel --}}
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
    <br>
    <br>
  {{-- Section des produits --}}
<section class="shop container">
    <h2 class="section-title">Produit Boutique</h2>
    <div class="shop-content">
        @foreach($produits as $produit)
            <div class="product-box">
                <img src="{{ asset('images/' . $produit->image) }}" alt="{{ $produit->nom }}" class="prod-img">
                <h2 class="product-title">{{ $produit->nom }}</h2>
                <p>{{ $produit->description }}</p>
                <span class="price">{{ $produit->prix }} Frans</span>
                <form action="{{ route('commandes.ajouter', $produit->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                    <button type="submit" class="btn btn-primary">
                        <i class='bx bx-shopping-bag add-cart'></i>
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</section>
    {{-- Cartes --}}
    <div class="container mt-5">
        <h2 class="mb-4">Nos categories</h2>
        <div class="conteneur-cartes row">
            @foreach($categories as $categorie)
                <div class="carte-produit col-md-4 mb-4">
                    <div class="details-produit">
                        <div class="categorie col-md-3 mb-4">
                            @if ($categorie->image)
                                <img src="{{ asset('images/categories/' . $categorie->image) }}" class="img-fluid" alt="{{ $categorie->libelle }}">
                            @else
                                <img src="https://via.placeholder.com/150" class="img-fluid" alt="Image par défaut">
                            @endif
                            <p class="mt-2">{{ $categorie->libelle }}</p>
                        </div>
                        <button class="btn btn-secondary">Voir Détails</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- Contact --}}
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>A propos de nous</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet.</p>
                </div>
                <div class="col-md-4">
                    <h4>Naviguer</h4>
                    <ul class="list-unstyled">
                        <li><a href="#">Accueil</a></li>
                        <li><a href="#">A propos</a></li>
                        <li><a href="#">Produits</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Suivez-nous</h4>
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
    <script src="{{ asset('js/commande.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
