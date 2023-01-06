<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garde extends Model
{
    use HasFactory;

    public function ads()
    {
        return $this->hasMany('App\Models\Annonce');
    }

    public function demandes()
    {
        return $this->hasMany('App\Models\Demande');
    }
    
}
