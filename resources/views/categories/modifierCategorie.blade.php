@extends('layouts.app')

@section('title', 'Voir les commandes')

@section('content')
    <div class="container mt-5">
        <h1>Modifier une Catégorie</h1>
        <form method="post" action="{{ route('modifierCategorie', $categorie->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="libelle">Libellé</label>
                <input id="libelle" class="form-control" type="text" name="libelle" value="{{ old('libelle', $categorie->libelle) }}" required>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input id="image" class="form-control-file" type="file" name="image">
                @if ($categorie->image)
                    <div class="mt-2">
                        <img src="{{ asset('images/categories/' . $categorie->image) }}" alt="Image de {{ $categorie->libelle }}" width="100">
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
    @endsection
