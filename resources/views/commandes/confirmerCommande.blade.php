<!DOCTYPE html>
<html>
<head>
    <title>Confirmer la commande</title>
</head>
<body>
    <h2>Confirmer la commande</h2>
    <form action="{{ route('commande.confirmer', $commande->id) }}" method="POST">
        @csrf
        <p>Êtes-vous sûr de vouloir confirmer cette commande ?</p>
        <div>
            <button type="submit">Confirmer</button>
        </div>
    </form>
</body>
</html>
