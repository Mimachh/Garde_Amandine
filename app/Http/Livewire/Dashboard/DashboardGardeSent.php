<?php

namespace App\Http\Livewire\Dashboard;


use Livewire\Component;
use App\Models\Proposal;
use Livewire\WithPagination;

class DashboardGardeSent extends Component
{
    use WithPagination;
    public function render()
    {
        $auth = auth()->user()->id;
        $gardeSent = Proposal::where('user_id', $auth)->orderBy('updated_at', 'DESC')->paginate(2);

        return view('livewire.dashboard.dashboard-garde-sent', [
            'gardeSent' => $gardeSent,
        ]);
    }
}
