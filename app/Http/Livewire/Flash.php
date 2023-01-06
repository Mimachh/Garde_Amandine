<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Flash extends Component
{
    public $message;
    public $type;
    public $colors = [
        'error' => 'border-red-700 text-red-600 bg-red-200',
        'success' => 'border-green-400 text-green-700 bg-green-400',
        'warning' => 'border-orange-700 text-orange-700 bg-orange-200',
        'info' => ' border-blue-700 text-blue-700 bg-blue-200'
    ];
    
    protected $listeners = ['flash' => 'setFlashMessage'];

    

    public function setFlashMessage($message, $type)
    {
        $this->message = $message;
        $this->type = $type;

        $this->dispatchBrowserEvent('flash-message');
    }

    public function render()
    {
        return view('livewire.flash');
    }
}
