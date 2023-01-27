<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Proposal;
use Livewire\WithPagination;

class DashboardGardeSentWait extends Component
{
    use WithPagination;
    public function render()
    {
        $auth = auth()->user()->id;
        $gardeWait = Proposal::where('user_id', $auth)->where('validated', 2)->orderBy('updated_at', 'DESC')->paginate(2);
        return view('livewire.dashboard.dashboard-garde-sent-wait', [
            'gardeWait' => $gardeWait,
        ]);
    }
}
