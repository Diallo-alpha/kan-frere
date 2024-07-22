@extends('layouts.app')

@section('title', 'Voir les commandes')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center"> 
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Détails du produit') }}</div>

                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>
                            <div class="col-md-6">
                                <p class="form-control">{{ $produit->nom }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="reference" class="col-md-4 col-form-label text-md-right">{{ __('Référence') }}</label>
                            <div class="col-md-6">
                                <p class="form-control">{{ $produit->reference }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                            <div class="col-md-6">
                                <p class="form-control">{{ $produit->description }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
                            <div class="col-md-6">
                                <img src="{{ asset('images/' . $produit->image) }}" alt="{{ $produit->nom }}" class="img-fluid">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="etat" class="col-md-4 col-form-label text-md-right">{{ __('État') }}</label>
                            <div class="col-md-6">
                                <p class="form-control">{{ $produit->etat }}</p>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="prix" class="col-md-4 col-form-label text-md-right">{{ __('Prix') }}</label>
                            <div class="col-md-6">
                                <p class="form-control">{{ $produit->prix }} Frans CFA</p>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <a href="{{ route('produits.list') }}" class="btn btn-primary">
                                    {{ __('Retour à la liste des produits') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
