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
    <title>Pannier</title>
</head>
<body>
    <header class="header">
        <div class="logo">
            <a href="#">
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
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Votre Panier</h1>
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
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Produit</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0 @endphp
                @foreach($panier as $id => $details)
                    @php $total += $details['prix'] * $details['quantite'] @endphp
                    <tr>
                        <td>
                            <img src="{{ asset('images/' . $details['produit']->image) }}" width="50" height="50" alt="{{ $details['produit']->nom }}">
                            <span>{{ $details['produit']->nom }}</span>
                        </td>
                        <td>{{ $details['quantite'] }}</td>
                        <td>{{ $details['prix'] }} Frans</td>
                        <td>{{ $details['prix'] * $details['quantite'] }} Frans</td>
                        <td>
                            <form action="{{ route('commandes.supprimerDuPanier', $id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            <h4>Total: {{ $total }} Frans</h4>
        </div>
        <div class="mt-3">
            <form action="{{ route('commandes.creer') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-primary">Valider la commande</button>
            </form>
        </div>
    </div>
</body>
</html>
