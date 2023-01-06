<?php

namespace App\Http\Livewire;

use App\Models\Contact;
use Livewire\Component;
use App\View\Components\Flash;

class ContactForm extends Component
{
    use Flash;
    
    public $nom;
    public $prenom;
    public $sujet;
    public $message;
    public $email;

    protected $rules = [
            'nom' => 'required',
            'email' => 'required',
            'sujet' => 'required',
            'message' => 'required',
            'prenom' => 'required',
        ];
    

    public function store()
    {
        $this->validate();

        Contact::create([
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'sujet' => $this->sujet,
            'message' => $this->message,
            'email' => $this->email,
        ]);

        
        $this->emit('flash', 'Ton message a bien été envoyé, nous y répondrons dans les plus brefs délais.', 
        'info'); 
    }
    public function render()
    {
        return view('livewire.contact-form');
    }
}

