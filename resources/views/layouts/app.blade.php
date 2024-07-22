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
    <div class="d-flex">
        <div class="sidebar">
            <div class="text-center mb-4">
                <h1>KAN&FRERE</h1>
            </div>
            <nav class="nav flex-column">
                <div class="nav-item {{ request()->routeIs('accueilCategories') ? 'active' : '' }}">
                    <a href="{{ route('accueilCategories') }}"><i class="fas fa-home"></i> Accueil</a>
                </div>
                <div class="nav-item {{ request()->routeIs('ajouterProduit') ? 'active' : '' }}">
                    <a href="{{ route('ajouterProduit') }}"><i class="fas fa-box"></i> Ajouter un produit</a>
                </div>
                <div class="nav-item {{ request()->routeIs('commandes.liste') ? 'active' : '' }}">
                    <a href="{{ route('commandes.liste') }}"><i class="fas fa-list"></i> Voir les commandes</a>
                </div>
                <div class="nav-item {{ request()->routeIs('listeCategories') ? 'active' : '' }}">
                    <a href="{{ route('listeCategories') }}"><i class="fas fa-list"></i> Voir les catégories</a>
                </div>
                <div class="nav-item {{ request()->routeIs('vueDensemble') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-chart-bar"></i> Vue d'ensemble</a>
                </div>
                <div class="nav-item {{ request()->routeIs('stock') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-warehouse"></i> Stock</a>
                </div>
                <div class="nav-item {{ request()->routeIs('rapports') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-file-alt"></i> Rapports</a>
                </div>
                <div class="nav-item {{ request()->routeIs('transfertDonnees') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-exchange-alt"></i> Transfert de données</a>
                </div>
                <div class="nav-item {{ request()->routeIs('aide') ? 'active' : '' }}">
                    <a href="#"><i class="fas fa-question-circle"></i> Aide</a>
                </div>
                <div class="mt-4">
                    <h6>Paramètres et Compte</h6>
                    <div class="nav-item {{ request()->routeIs('parametresCompte') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-cog"></i> Paramètres du compte</a>
                    </div>
                    <div class="nav-item {{ request()->routeIs('activite') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-history"></i> Activité</a>
                    </div>
                    <div class="nav-item">
                        <a href="#"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>
                    </div>
                </div>
            </nav>
        </div>
        <div class="content p-4" style="flex-grow: 1;">
            @yield('content')
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-8FGzKlYc+aUU3GxOKGJI/tFUWkswOAhIsH73/2MCdvfiuYQzg+u9BjMvYDBuebKNTpnujps2l1rhjJkxZlP0Kg==" crossorigin="anonymous"></script>
</body>
</html>
