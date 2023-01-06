<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Proposal;

class AdminProposalController extends Component
{
    public $proposals;

    public function mount()
    {
        $this->proposals = Proposal::all();

    }
    public function index()
    {
        return view('admin.proposals_list');
    }

    public function delete($proposal)
    {

        $proposal = Proposal::where('id', $proposal)->first();
          
        $proposal->delete();
        $this->proposals = Proposal::all();
    }

    
    public function render()
    {
        return view('livewire.admin.admin-proposal-controller');
    }
}
