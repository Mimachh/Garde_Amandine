<?php

namespace App\Mail;

use App\Models\Demande;
use App\Models\Proposal;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ProposalResponse extends Mailable
{
    use Queueable, SerializesModels;

    public $proposal;
    public $demande;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Proposal $proposal, Demande $demande)
    {
        $this->proposal = $proposal;
        $this->demande = $demande;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mails.proposal-response')->subject('Demande de garde : Réponse');
    }
}
