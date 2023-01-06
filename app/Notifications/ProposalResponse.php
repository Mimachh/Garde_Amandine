<?php

namespace App\Notifications;

use App\Mail\ProposalResponse as MailProposalResponse;
use App\Models\Demande;
use App\Models\Proposal;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class ProposalResponse extends Notification
{
    use Queueable;

    public $proposal;
    public $demande;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Proposal $proposal, Demande $demande)
    {
        $this->proposal = $proposal;
        $this->demande = $demande;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailProposalResponse($this->proposal, $this->demande, $notifiable  ))
        ->to($notifiable->email);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'proposal_id' => $this->proposal->id,
            'annonce_user_name' => $this->proposal->annonce->user->name,
            'proposal_response' => $this->proposal->validated,
        ];
    }

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'proposal_id' => $this->proposal->id,
            'annonce_user_name' => $this->proposal->annonce->user->name,
            'proposal_response' => $this->proposal->validated,
           
        ]);
    }
}
