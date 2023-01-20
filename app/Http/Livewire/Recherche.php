<?php

namespace App\Http\Livewire;

use App\Models\Garde;
use App\Models\Ville;
use App\Models\Annonce;
use Livewire\Component;

class Recherche extends Component
{
    public $q;
    public $gardes;

    public function mount()
    {
        $this->gardes = Garde::all();
    }
    
    public function search()
    {
        // if(!empty(request()->input("q"))){
        //     $q = request()->input("q");
        //     $v=Ville::where('ville_nom', 'like', "%$q%")->pluck('id');
        // }

        // if(empty(request()->input("qq")) ){
        //     $a= Annonce::where('ville_id', 'like', $v)->get();
        // }else{
        //     $qq = 1;
        //     $a= Annonce::where('ville_id', 'like', $v)->where('chats', $qq)->get();
        // }
        $ville = request()->input("ville");
        $garde = request()->input("garde");
        $chats = request()->input("chats");
        $chiens = request()->input("chiens");
        $poissons = request()->input("poissons");
        $rongeurs = request()->input("rongeurs");
        $oiseaux = request()->input("oiseaux");
        $reptiles = request()->input("reptiles");
        $ferme = request()->input("ferme");
        $autre = request()->input("autre");

        $v= Ville::where('ville_nom', 'like', "%$ville%")->pluck('id');
        $g = Garde::where('id', 'like', "%$garde%")->pluck('id');
        $a= Annonce::when($v, function ($s) use ($v) {
                return $s->where('ville_id', 'like', $v);})
            ->when($g, function ($s) use ($g) {
                return $s->where('garde_id', $g);})
            ->when($chats, function ($s) use ($chats) {
                return $s->where('chats', $chats);})
            ->when($chiens, function ($s) use ($chiens) {
                return $s->where('chiens', $chiens);})
            ->when($poissons, function ($s) use ($poissons) {
                return $s->where('poissons', $poissons);})
            ->when($rongeurs, function ($s) use ($rongeurs) {
                return $s->where('rongeurs', $rongeurs);})
            ->when($oiseaux, function ($s) use ($oiseaux) {
                return $s->where('oiseaux', $oiseaux);})
            ->when($reptiles, function ($s) use ($reptiles) {
                    return $s->where('reptiles', $reptiles);})
            ->when($ferme, function ($s) use ($ferme) {
                    return $s->where('ferme', $ferme);})
            ->when($autre, function ($s) use ($autre) {
                    return $s->where('autre', $autre);})
            ->get();

        dd($a);

       
    }

    public function render()
    {
        return view('livewire.recherche');
    }
}
