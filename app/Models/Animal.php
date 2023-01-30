<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Animal extends Model
{
    use HasFactory;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    } 

    protected $fillable = [
        
        'animal_name', 'user_id', 'personnality', 'male_cats', 'female_cats', 'male_dogs', 'female_dogs', 
        'male_rongeurs', 'female_rongeurs', 'birds', 'reptiles', 'espece_id', 'race_id', 'photo', 'age_id',
        'sexe_id'
    ];

    public function espece()
    {
        return $this->belongsTo('App\Models\Espece');
    }
    public function race()
    {
        return $this->belongsTo('App\Models\Race');
    }
    public function age()
    {
        return $this->belongsTo('App\Models\Age');
    }

    public function demandes()
    {
        return $this->hasMany('App\Models\Demande');
    }
}
