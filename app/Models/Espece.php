<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Espece extends Model
{
    use HasFactory;

    public function annonces()
    {
        return $this->hasMany('App\Models\Annonce');
    }
    public function animals()
    {
        return $this->hasMany('App\Models\Animal');
    }
}
