<?php

namespace App\Http\Livewire\Animals;

use App\Models\Animal;
use Livewire\Component;
use App\View\Components\Flash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class DeleteAnimalComp extends Component
{
    use AuthorizesRequests;
    use Flash;
    
    /* Suppression des animaux */
    public $animal;
    public $delete_id_animal;

    protected $listeners = [
    'deleteAnimalConfirmed' => 'deleteAnimal'
  ];

    public function deleteConfirmationAnimal($id)
      {
        $this->authorize('delete', $this->animal);

        $this->delete_id_animal = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation-animal');

      }
    public function deleteAnimal()
      {
          $animal = Animal::where('id', $this->delete_id_animal)->first();

          Storage::delete('animals_photos/' . $animal->photo);
        
          $animal->delete();
 
          self::message('danger', 'Votre fiche a bien été supprimée !');

        return redirect()->route('dashboard'); 

      }

    public function confirmAnimalDeletion()
    {
      $this->confirmingAnimalDeletion = true;
    }

    
    public function deleteAnimals($animal)
    {
      $animal = Animal::where('id', $animal)->get();
      $an = $animal[0]['user_id'];
      $user = auth()->user()->id;
      
      
      if($an === $user) {
        Animal::destroy($animal);
      
        $this->confirmingAnimalDeletion = false;
        $this->emit('flash', 'La fiche de votre animal a bien été supprimée ! :(', 
        'error');
      }
      
      
    }

    /* Fin suppression des animaux */
    
    public function render()
    {
        return view('livewire.animals.delete-animal-comp');
    }
}
