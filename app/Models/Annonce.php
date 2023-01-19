<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\callback;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Annonce extends Model
{
    use HasFactory;

    public function scopeOnline($query)
    {
        return $query->where('status', 1);
    }

    public function scopeFilters(
        Builder $query,
        ?string $sortBy,
        ?string $direction,
    ): void {
        $query->when(
            value: $sortBy,
            callback: static function ($query, $sortBy) use($direction): void {
                match($sortBy){
                    'price' => $query->orderBy('price', $direction),
                };
            }
        );
    }

/* Fonctions pour le prix */

    public function getPrice()
    {
        $price = $this->price / 100;
        return number_format($price, 2, ',', ' ' ). '€';
    }

    public function getRealPrice()
    {
        $price = $this->price / 100;
        $price2 = $price * 2;

        return number_format($price2, 2, ',', ' ' ). '€';
    }


    public function diffPrice()
    {
        $price = $this->price / 100;
        $price2 = $price * 2;
        $diff = $price2 - $price;
        return 'La différence est de '. number_format($diff, 2, ',', ' ' ). '€';
    }
/* Fin fonctions pour le prix */


/* Fonction pour les dates */ 

public function start_date_fr()
    {
       $date = $this->start_watch;
       return date('d/m/Y', strtotime($date));
    }
    public function end_date_fr()
    {
       $date = $this->end_watch;
       return date('d/m/Y', strtotime($date));
    }
/* Fin fonction pour les dates */


/* Relations */

    public function user()
    {
        return $this->belongsTo(User::class);
    } 
    public function ville()
    {
        return $this->belongsTo('App\Models\Ville');
    }
    public function habitation()
    {
        return $this->belongsTo('App\Models\Habitation');
    }
    public function exterieur()
    {
        return $this->belongsTo('App\Models\Exterieur');
    }
    public function garde()
    {
        return $this->belongsTo('App\Models\Garde');
    }
    public function especes()
    {
        return $this->belongsTo('App\Models\Espece');
    }
   

    public function fav()
    {
        return $this->belongsToMany('App\Models\User');
    }
    
    public function fav_added()
    {
        if (auth()->check()) {
            return auth()->user()->fav->contains('id', $this->id);      
        }
        
    }

    public function proposals()
    {
        return $this->hasMany('App\Models\Proposal');
    }
    
/* Fin Relations */


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        
        'user_id', 'description', 'price', 'visit', 'home', 'name', 'chats', 'chiens', 'poissons', 'rongeurs',
        'oiseaux', 'reptiles', 'ferme', 'autre', 'ville_id', 'start_watch', 'end_watch', 'garde_id', 'photo', 'habitation_id', 'exterieur_id'
    ];
}
