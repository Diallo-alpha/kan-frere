<!DOCTYPE html>
<html>
<head>
    <title>Annuler la commande</title>
</head>
<body>
    <h2>Annuler la commande</h2>
    <form action="{{ route('commande.annuler', $commande->id) }}" method="POST">
        @csrf
        <p>Êtes-vous sûr de vouloir annuler cette commande ?</p>
        <div>
            <button type="submit">Annuler</button>
        </div>
    </form>
</body>
</html>
