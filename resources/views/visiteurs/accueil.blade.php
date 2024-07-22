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
    <link rel="stylesheet" href="{{ asset('css/carrousel.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>Accueil</title>
</head>
<body>
<header class="header">
    <div class="logo">
        <a href="{{route('accueilCategories')}}">
            <h1 class="text-success">Kan&frere</h1>
        </a>
    </div>
    <nav class="nav">
        <div class="dropdown">
            <button class="dropbtn">Boutique
                <svg class="icon-chevron" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m6 9 6 6 6-6" />
                </svg>
            </button>
            <div class="dropdown-content">
                <a href="#">Fruits</a>
                <a href="#">Légumes</a>
                <a href="#">Produits Bio</a>
                <a href="#">Accessoires</a>
            </div>
        </div>
        <div class="dropdown">
            <button class="dropbtn">Promotions
                <svg class="icon-chevron" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m6 9 6 6 6-6" />
                </svg>
            </button>
            <div class="dropdown-content">
                <a href="#">Fruits</a>
                <a href="#">Légumes</a>
                <a href="#">Produits Bio</a>
                <a href="#">Accessoires</a>
            </div>
        </div>
        <a href="#" class="nav-link">Contact</a>
    </nav>
    <div class="actions">
        <a href="{{ route('commandes.afficherPanier') }}" class="action-link cart-icon">
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="8" cy="21" r="1" />
                <circle cx="19" cy="21" r="1" />
                <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
            </svg>
            <span id="cart-count" class="cart-count">0</span>
            <span class="sr-only">Panier</span>
        </a>
        @if(auth()->check())
            <a href="{{ route('deconnexion') }}" class="btn btn-primary">Déconnexion</a>
        @else
            <a href="{{ route('afficherFormConnexion') }}" class="btn btn-primary">Connexion</a>
        @endif
    </div>
</header>

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
<div class="hero-section">
    <div class="hero-text">
        <h1>
            Nous fournissons les meilleurs
            <span>aliments </span> pour vous
        </h1>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Facilisis ut interdum duis tellus. Suspendisse pharetra feugiat lacus eu.
        </p>
        <button class="btn btn-shop1">Acheter Maintenant</button>
    </div>
</div>
<br>
<br>

<section id="products">
    <div class="container py-3 w-100 px-3">
        <h2 class="mb-4">Produits</h2>
        <div class="row">
            @foreach($produits as $produit)
                <div class="col-lg-4 col-md-6 col-sm-10 offset-md-0 offset-sm-1">
                    <div class="card">
                        <img class="card-img-top" src="{{ asset('images/' . $produit->image) }}" alt="{{ $produit->nom }}">
                        <div class="card-body">
                            <h6 class="font-weight-bold pt-1">{{ $produit->nom }}</h6>
                            <div class="text-muted description">{{ $produit->description }}</div>
                            <div class="d-flex align-items-center product">
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="fas fa-star"></span>
                                <span class="far fa-star"></span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between pt-3">
                                <div class="d-flex flex-column">
                                    <div class="h6 font-weight-bold">{{ $produit->prix }} CFA</div>
                                </div>
                                <form action="{{ route('commandes.ajouter', $produit->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="produit_id" value="{{ $produit->id }}">
                                    <button type="submit" class="btn btn-primary acheter" data-id="{{ $produit->id }}">Acheter</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
    </div>
    <section id=" container contact">
        <div class="form4 top">
            <div class="container">
                <h2 class="mb-4">Nous contactez</h2>
                <div class="row">
                    <div class="col-md-12 col-md-offset-4">
                        <div class="form-bg">
                            <form class="form">
                                <div class="form-group">
                                    <label class="sr-only">Nome</label>
                                    <input type="text" class="form-control" required="" id="nameNine" placeholder="Nome">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Email</label>
                                    <input type="email" class="form-control" required="" id="emailNine" placeholder="Addresse mail">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only">Name</label>
                                    <textarea class="form-control" required="" rows="7" id="messageNine" placeholder="Message"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Envoyer</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>
<footer>
    <div id="container">
        <div id="part1">
            <div id="companyinfo">
                <a id="sitelink" href="#">KAN&FRERE</a>
                <p id="title">Produits Alimentaires de Qualité</p>
                <p id="detail">Nous proposons une sélection exceptionnelle de produits alimentaires pour une expérience culinaire inoubliable.</p>
            </div>
            <div id="explore">
                <p id="txt1">Explorer</p>
                <a class="link" href="#">Accueil</a>
                <a class="link" href="#">À Propos</a>
                <a class="link" href="#">Produits</a>
                <a class="link" href="#">Contact</a>
            </div>
            <div id="visit">
                <p id="txt2">Visitez-nous</p>
                <p class="text">KAN&FRERE</p>
                <p class="text">Sacré coeur 3</p>
                <p class="text">DAKAR</p>
                <p class="text">Téléphone : +221781111111</p>
                <p class="text">Fax : 331111111</p>
            </div>
            <div id="legal">
                <p id="txt3">Légal</p>
                <a class="link1" href="#">Termes et Conditions</a>
                <a class="link1" href="#">Politique de Confidentialité</a>
            </div>
            <div id="subscribe">
                <p id="txt4">Abonnez-vous</p>
                <form>
                    <input id="email" type="email" placeholder="Email">
                </form>
                <a class="waves-effect waves-light btn">S'abonner</a>
                <p id="txt5">Suivez-nous</p>
                <i class="fab fa-facebook-square social fa-2x"></i>
                <i class="fab fa-linkedin social fa-2x"></i>
                <i class="fab fa-twitter-square social fa-2x"></i>
            </div>
        </div>
        <div id="part2">
            <p id="txt6"><i class="material-icons tiny"></i>&copy; 2024 Boutique KAN&FRERE - Tous droits réservés</p>
        </div>
    </div>
</footer>

<script src="{{ asset('js/commande.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
