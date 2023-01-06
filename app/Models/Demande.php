<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demande extends Model
{
    use HasFactory;


   /* public function user()
    {
        return $this->belongsTo('App\Models\User');
    } Pas besoin je crois */

    public function proposal()
    {
        return $this->belongsTo('App\Models\Proposal');
    }

    public function garde()
    {
        return $this->belongsTo('App\Models\Garde');
    }
    public function first_animal()
    {
        return $this->belongsTo('App\Models\Animal');
    }
    public function second_animal()
    {
        return $this->belongsTo('App\Models\Animal');
    }
    public function third_animal()
    {
        return $this->belongsTo('App\Models\Animal');
    }

    protected $fillable = [
        'content', 'start_date', 'end_date',
        'first_animal_id', 'second_animal_id', 'third_animal_id',
        'garde_id', 'phone', 'number_visit', 'proposal_id', 'prix_final', 
    ];
}
