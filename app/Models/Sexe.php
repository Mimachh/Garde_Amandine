<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sexe extends Model
{
    use HasFactory;

    public function animal()
    {
        return $this->belongsToMany('App\Models\Animal');
    }
}
