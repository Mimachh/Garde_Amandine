<?php

namespace App\Http\Livewire;

use Livewire\Component;

class AdFav extends Component
{
    public $annonce;


    public function add_fav()
    {
      if(auth()->check()) {

       $response = auth()->user()->fav()->toggle($this->annonce->id);
        
        if($response['attached']) {
          $this->emit('flash', 'Ajouté aux favoris', 
          'success'); 
        } else {
          $this->emit('flash', 'Retiré des favoris', 
          'error'); 
        } 
        
      }
      else {
        
        $this->emit('flash', 'Vous devez être connecté pour ajouter un favori', 
        'error');       
      }
     
    }
    public function render()
    {
        return view('livewire.ad-fav');
    }
}
