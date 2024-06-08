<?php
namespace App\Models;
use App\Models\User;
use App\Models\Produit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commande extends Model
{
    use HasFactory;
    protected $table = 'commandes';

    protected $fillable = ['user_id','reference', 'total', 'etat_commande','date_commande'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'commande_produit')->withPivot('quantite');
    }
}
