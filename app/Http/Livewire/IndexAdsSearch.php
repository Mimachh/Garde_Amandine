<?php

namespace App\Http\Livewire;

use App\Models\Ville;
use App\Models\Annonce;
use Livewire\Component;
use Livewire\WithPagination;

class IndexAdsSearch extends Component
{
    use WithPagination;
    public $search;
    public $chats;
    public $reptiles;
    public $locations;
    public $location;
    public $sortAd = "asc";
    public $orderColumn = 'emp_name';


    public function mount()
    {
        $this->locations = Ville::all();
    }

    public function sortAd()
    {
        if($this->sortAd == 'asc'){
            $this->sortAd == 'desc';
        }
        else{
            $this->sortAd == 'asc';
        }

    }

    public function render()
    {
        $annonces = Annonce::orderby('price', $this->sortAd)->select('*')->where('name', $this->search)
        ->when($this->chats, function($query, $chats) { return $query->where('chats', 1);})
        ->when($this->reptiles, function($query, $reptiles) { return $query->where('reptiles', 6);})
        ->when($this->location, function($query, $location) { return $query->where('ville_id', $location);});
        
        $annonces = $annonces->paginate(5);

        return view('livewire.index-ads-search', 
        ['annonces' => $annonces]);
    }
}
