<?php

namespace App\Http\Livewire;

use App\Models\Ville;
use App\Models\Annonce;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;

class SearchAnnonces extends Component
{
    public $query = '';
    public $chat;
    public $annonces = [];
    public Int $selectedIndex = 0;

    public function incrementIndex()
    {
 
        if($this->selectedIndex === count($this->annonces)-1){
            
            $this->selectedIndex = 0;
            return;
        }
        $this->selectedIndex++;
        
    }

    public function decrementIndex()
    {
        if($this->selectedIndex === 0){ 
            $this->selectedIndex = count($this->annonces)-1;
            return;
        }
        $this->selectedIndex--;   
    }

    public function updatedQuery()
    {
        $words = '%' . $this->query . '%';
        if (strlen($this->query) > 1) {
        
        $ville = Ville::select('id')->where('ville_nom', 'like', $words)->get();
        
        $this->annonces = Annonce::where('name', 'like', $words)->get();
        }
      
    }

    public function showAnnonce(){
        if($this->annonces){
            return redirect()->route('annonces.show', [$this->annonces[$this->selectedIndex]['id']]);
        }
    }
    
    public function resetIndex()
    {
        $this->reset('selectedIndex');
    }










    public $villes;
    public function mount()
    {
        $this->villes = Ville::all();
    }
    public function chat()
    {
        $this->annonces = Annonce::where('chats', 'like', 1)->get();
        dd($this->annonces);
    }

    public function render()
    {
        return view('livewire.search-annonces');
    }
}
