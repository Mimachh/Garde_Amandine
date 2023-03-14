<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class DashboardGardeReceivedRealised extends Component
{
    public $annonces;
    public $now;
    public function mount()
    {
        $this->annonces = auth()->user()->ads;
        $ads = $this->annonces;
        $this->now = Date('Y-m-d');

    }

    
    public function render()
    {
        return view('livewire.dashboard.dashboard-garde-received-realised');
    }
}
