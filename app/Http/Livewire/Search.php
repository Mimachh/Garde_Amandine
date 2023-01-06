<?php

namespace App\Http\Livewire;

use App\Models\Annonce;
use Livewire\Component;

class Search extends Component
{
    public $query_city ='';

    public $annonces = [];

    public function updatedQuery()
    {
        $words = '%' . $this->query . '%';

        if (strlen($this->query) > 2) {
        $this->annonces = Annonce::where('city-where', 'like', $words)
        ->get(); 
        }

       dd($this->annonces);
    }

    public function render()
    {
        return view('livewire.search');
    }
}
