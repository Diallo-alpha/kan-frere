<?php

namespace App\Models;

use App\Models\Commande;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produit extends Model
{
    use HasFactory;
    protected $table = 'produits';

    protected $fillable = ['nom', 'reference', 'description', 'image', 'etat', 'prix' ,'categorie_id'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'commande_produit')->withPivot('quantite');
    }
}
