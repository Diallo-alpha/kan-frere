<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Commande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Ajouter une Commande</h2>
        <form id="order-form" action="{{ route('commande.creer') }}" method="post">
            @csrf
            <div id="product-list">
                <div class="product-item mb-3">
                    <div class="form-group">
                        <label for="produit">Produit</label>
                        <input type="text" class="form-control produit" name="produits[]" required>
                    </div>
                    <div class="form-group">
                        <label for="quantite">Quantité</label>
                        <input type="number" class="form-control quantite" name="quantites[]" required>
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix</label>
                        <input type="number" class="form-control prix" name="prix[]" required>
                    </div>
                    <button type="button" class="btn btn-danger remove-product">Supprimer</button>
                </div>
            </div>
            <button type="button" id="add-product" class="btn btn-secondary">Ajouter un produit</button>
            <h3 class="mt-4">Total: <span id="total-price">0</span> Frans</h3>
            <input type="hidden" name="total" id="total-input">
            <button type="submit" class="btn btn-primary mt-3">Commander</button>
        </form>
    </div>
    <script src="{{ asset('js/commande.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
