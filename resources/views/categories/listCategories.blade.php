@extends('layouts.app')

@section('title', 'Voir les commandes')

@section('content')
    <div class="container mt-5">
        <h1>Liste des catégories</h1>
        <a href="{{ route('afficherFormAjoutCategorie') }}" class="btn btn-primary mb-3">Ajouter une catégorie</a>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Libellé</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $categorie)
                    <tr>
                        <td>{{ $categorie->id }}</td>
                        <td>{{ $categorie->libelle }}</td>
                        <td>
                            @if ($categorie->image)
                                <img src="{{ asset('images/categories/' . $categorie->image) }}" alt="Image de {{ $categorie->libelle }}" width="100">
                            @else
                                <span>Aucune image</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('afficherFormModifierCategorie', $categorie->id) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('supprimerCategorie', $categorie->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
