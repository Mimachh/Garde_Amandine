<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class DashboardFav extends Component
{
    public function render()
    {
        $favs = auth()->user()->fav;

        return view('livewire.dashboard.dashboard-fav', ['favs' => $favs]);
    }
}
