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
        <h2 class="mb-4">Modifier un Produit</h2>
        <form method="POST" action="{{ route('traiterModificationProduit', $produit->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nom">Nom</label>
                <input id="nom" class="form-control" type="text" name="nom" value="{{ old('nom', $produit->nom) }}" required>
            </div>

            <div class="form-group">
                <label for="reference">Référence</label>
                <input id="reference" class="form-control" type="text" name="reference" value="{{ old('reference', $produit->reference) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" class="form-control" name="description">{{ old('description', $produit->description) }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">Image</label>
                <input id="image" class="form-control-file" type="file" name="image">
                <img src="{{ asset('images/'.$produit->image) }}" alt="Image du produit" width="100">
            </div>

            <div class="form-group">
                <label for="etat">État</label>
                <select id="etat" class="form-control" name="etat" required>
                    <option value="rupture" {{ old('etat', $produit->etat) == 'rupture' ? 'selected' : '' }}>Rupture de stock</option>
                    <option value="stock" {{ old('etat', $produit->etat) == 'stock' ? 'selected' : '' }}>En stock</option>
                </select>
            </div>

            <div class="form-group">
                <label for="prix">Prix</label>
                <input id="prix" class="form-control" type="number" name="prix" value="{{ old('prix', $produit->prix) }}" required>
            </div>
            <div class="form-group">
                <label for="categorie_id">Catégorie</label>
                <select id="categorie_id" class="form-control" name="categorie_id">
                    <option value="">Sélectionnez une catégorie</option>
                    @foreach ($categories as $categorie)
                        <option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>

        <form method="POST" action="{{ route('supprimerProduit', $produit->id) }}" style="margin-top: 20px;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Supprimer</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
