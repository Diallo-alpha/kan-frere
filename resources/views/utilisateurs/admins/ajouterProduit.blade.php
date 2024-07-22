@extends('layouts.app')

@section('title', 'Ajouter un Produit')

@section('content')

        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Ajouter un Produit</h2>

                <!-- Messages de succès -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Messages d'erreur -->
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="{{ route('traiterAjoutProduit') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input id="nom" class="form-control" type="text" name="nom" value="{{ old('nom') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="reference">Référence</label>
                        <input id="reference" class="form-control" type="text" name="reference" value="{{ old('reference') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" class="form-control" name="description">{{ old('description') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input id="image" class="form-control-file" type="file" name="image" required>
                    </div>

                    <div class="form-group">
                        <label for="etat">État</label>
                        <select id="etat" class="form-control" name="etat" required>
                            <option value="rupture">Rupture de stock</option>
                            <option value="stock">En stock</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input id="prix" class="form-control" type="number" name="prix" value="{{ old('prix') }}" required>
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
                    <br>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
@endsection
