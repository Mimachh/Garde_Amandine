<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Proposal;
use App\Notifications\ProposalResponse;

class ButtonProposalDeclined extends Component
{
    public $proposal;

    public function declined(Proposal $proposal)
    {
        
        
        
        $id = $this->proposal->id;
        
        $proposal = Proposal::findOrFail($id);

        $demande = $proposal->demande;

        $proposal->fill(['validated' => 0]);

        if($proposal->isDirty()) {
            $proposal->save();
        }


        $proposal->user->notify(new ProposalResponse($proposal, $demande));

        return redirect()->route('proposals.show', $id);
    }

    public function render()
    {
        return view('livewire.button-proposal-declined');
    }
}

