<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function annonce()
    {
        return $this->belongsTo('App\Models\Annonce');
    }

    public function demande()
    {
        return $this->hasOne('App\Models\Demande');
    }

    protected $fillable = [ 'annonce_id', 'validated'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = auth()->user()->id;
        });
    }

    public function getFinalPriceWithoutCom()
    {
       $price = $this->demande->prix_final /200;
       return number_format($price, 2, ',', ' ' ). '€';
    }
    public function finalPrice()
    {
        $price = $this->demande->prix_final / 100;
        return number_format($price, 2, ',', ' ' ). '€';
    }
    public function start_date_fr()
    {
       $date = $this->demande->start_date;
       return date('d/m/Y', strtotime($date));
    }
    public function end_date_fr()
    {
       $date = $this->demande->end_date;
       return date('d/m/Y', strtotime($date));
    }
    public function created_date()
    {
        $date = $this->demande->created_at;
        return date('d/m/Y', strtotime($date));
    }
}
