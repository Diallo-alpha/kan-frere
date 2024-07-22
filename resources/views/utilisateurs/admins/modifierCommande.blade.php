@extends('layouts.app')

@section('title', 'Voir les commandes')

@section('content')
    <div class="container mt-5">
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
        <h2>Modifier Commande</h2>
        <form action="{{ route('commandes.modiferTraitement', $commande->id) }}" method="POST">
            @csrf
            <div id="product-list">
                @foreach($commande->produits as $produit)
                    <div class="product-item mb-3">
                        <div class="form-group">
                            <label for="produit">Produit</label>
                            <select class="form-control produit" name="produits[]" required>
                                <option value="" data-prix="">Sélectionnez un produit</option>
                                @foreach($produits as $p)
                                    <option value="{{ $p->id }}" data-prix="{{ $p->prix }}" {{ $produit->id == $p->id ? 'selected' : '' }}>
                                        {{ $p->nom }} - {{ $p->prix }} Frans
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="quantite">Quantité</label>
                            <input type="number" class="form-control quantite" name="quantites[]" value="{{ $produit->pivot->quantite }}" required>
                        </div>
                        <div class="form-group">
                            <label for="prix">Prix</label>
                            <input type="number" class="form-control prix" name="prix[]" value="{{ $produit->pivot->prix }}" required>
                        </div>
                    </div>
                @endforeach
            </div>
            <h3 class="mt-4">Total: <span id="total-price">0</span> Frans</h3>
            <input type="hidden" name="total" id="total-input">
            <button type="submit" class="btn btn-primary mt-3">Mettre à jour</button>
        </form>
    </div>
    @endsection
