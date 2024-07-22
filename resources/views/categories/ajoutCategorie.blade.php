@extends('layouts.app')

@section('title', 'Voir les commandes')

@section('content')
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
            <br>
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
    @endsection
