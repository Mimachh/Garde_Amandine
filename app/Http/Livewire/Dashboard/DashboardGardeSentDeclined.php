<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use App\Models\Proposal;
use Livewire\WithPagination;

class DashboardGardeSentDeclined extends Component
{
    use WithPagination;
    public function render()
    {
        $auth = auth()->user()->id;
        $gardeDeclined = Proposal::where('user_id', $auth)->where('validated', 0)->orderBy('updated_at', 'DESC')->paginate(2);
        return view('livewire.dashboard.dashboard-garde-sent-declined', [
            'gardeDeclined' => $gardeDeclined,]);
    }
}
