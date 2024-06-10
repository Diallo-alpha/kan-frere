<!-- resources/views/utilisateurs/admins/listeCommande.blade.php -->

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Commandes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Liste des Commandes</h2>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if($commandes->isEmpty())
            <p>Aucune commande trouvée.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Référence</th>
                        <th>Total</th>
                        <th>Date de Commande</th>
                        <th>Produits</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($commandes as $commande)
                        <tr>
                            <td>{{ $commande->id }}</td>
                            <td>{{ $commande->reference }}</td>
                            <td>{{ $commande->total }} Frans</td>
                            <td>{{ $commande->created_at }}</td>
                            <td>
                                <ul>
                                    @foreach($commande->produits as $produit)
                                        <li>{{ $produit->nom }} ({{ $produit->pivot->quantite }} x {{ $produit->pivot->prix }} Frans)</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <a href="{{ route('commandes.modifier', $commande->id) }}" class="btn btn-warning">Modifier</a>
                                <form action="{{ route('commandes.supprimer', $commande->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                                <form action="{{ route('commandes.annuler', $commande->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">Annuler</button>
                                </form>
                                <form action="{{ route('commandes.confirmer', $commande->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Confirmer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
