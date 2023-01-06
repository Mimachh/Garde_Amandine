<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Proposal;
use App\View\Components\Flash;
use App\Notifications\ProposalResponse;


class ButtonProposalAccepted extends Component
{
    public $proposal;
   
    use Flash;

    public function accepted(Proposal $proposal)
    {
        $id = $this->proposal->id;

        $proposal = Proposal::findOrFail($id);

        $demande = $proposal->demande;

        $proposal->fill(['validated' => 1]);

        if($proposal->isDirty()) {

            $proposal->save();
        }
        
        self::message('success', 'Ta réponse est envoyée au propriétaire, son paiement ne devrait pas tarder !');

        $proposal->user->notify(new ProposalResponse($proposal, $demande));


        return redirect()->route('proposals.show', $id);

      
    }


    public function render()
    {
        return view('livewire.button-proposal-accepted');
    }
}

