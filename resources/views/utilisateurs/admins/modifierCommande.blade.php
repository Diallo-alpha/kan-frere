<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la commande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <h2>Modifier la commande</h2>
        <form action="{{ route('commande.update', $commande->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="total" class="form-label">Total:</label>
                <input type="number" class="form-control" name="total" value="{{ $commande->total }}" required>
            </div>
            <div class="mb-3">
                <label for="etat_commande" class="form-label">État de la commande:</label>
                <select class="form-select" name="etat_commande" required>
                    <option value="en_cours" {{ $commande->etat_commande == 'en_cours' ? 'selected' : '' }}>En cours</option>
                    <option value="valider" {{ $commande->etat_commande == 'valider' ? 'selected' : '' }}>Validée</option>
                    <option value="annulé" {{ $commande->etat_commande == 'annulé' ? 'selected' : '' }}>Annulée</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
