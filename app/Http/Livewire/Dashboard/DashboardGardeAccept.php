<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class DashboardGardeAccept extends Component
{
    public $annonces;

    public function mount()
    {
 
    $this->annonces = auth()->user()->ads;
    
    $ads = $this->annonces;

    }

    public function render()
    {
        
        return view('livewire.dashboard.dashboard-garde-accept');
    }
}
