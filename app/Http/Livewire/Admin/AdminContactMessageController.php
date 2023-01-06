<?php

namespace App\Http\Livewire\Admin;

use App\Models\Contact;
use Livewire\Component;

class AdminContactMessageController extends Component
{
    public $contacts;

    public function mount()
    {
        $this->contacts = Contact::all();

    }
    public function index()
    {
        return view('admin.contacts_message');
    }
    
    public function render()
    {
        return view('livewire.admin.admin-contact-message-controller');
    }
}
