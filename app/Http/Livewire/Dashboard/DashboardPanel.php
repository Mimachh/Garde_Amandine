<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

use App\Models\Animal;
use App\Models\Annonce;

use Illuminate\Support\Facades\Storage;

class DashboardPanel extends Component
{
    /* Pages */

        public $currentPage = 1;
        public $pages = [1=>1, 2=>2, 3=>3, 4=>4, 5=>5, 6=>6, 7=>7, 8=>8, 9=>9, 10=>10, 11=>11, 12=>12];

        public function goToPageAds()
        {
            $this->currentPage = 1;
        }
        
        public function goToPageAnim()
        {
            $this->currentPage = 2;
        }

        public function goToPageGardeSent()
        {
            $this->currentPage = 3;
        }

        public function goToPageGardeSentWait()
        {
            $this->currentPage = 4;
        }

        public function goToPageGardeSentAccepted()
        {
            $this->currentPage = 5;
        }

        public function goToPageGardeSentDeclined()
        {
            $this->currentPage = 6;
        }

        public function goToPageGardeReceivedWait()
        {
          $this->currentPage = 8;
        }
        

        public function goToPageGardeReceivedAccepted()
        {
            $this->currentPage = 9;
        }

        public function goToPageGardeReceivedDeclined()
        {
            $this->currentPage = 10;
        }
        
        
        public function goToPageFav()
        {
            $this->currentPage = 12;
        }

    /* /Pages */
    
    public $annonces;

    public function mount()
    {
 
    $this->annonces = auth()->user()->ads;
    
    $ads = $this->annonces;
    
    }

   
/* Suppression de mes annonces */

  /* La modal Sweet Alert 2 */

    public $delete_id;

    protected $listeners = ['deleteConfirmed' => 'deleteAnnonce', 
      'deleteAnimalConfirmed' => 'deleteAnimal'
      ];

    public function deleteConfirmation($id)
      {
        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');

      }
    public function deleteAnnonce()
      {
        $annonce = Annonce::where('id', $this->delete_id)->first();
        Storage::delete('annonces_photos/' . $annonce->photo);
        $user = auth()->user()->id;
        $ad = $annonce->user_id;

        if($ad === $user) {
          $annonce->delete();
       
          $this->emit('flash', 'Votre annonce a bien été supprimée ! :(', 
          'error');
        }
      }
  /* Fin la modal Sweet Alert 2 */

  /* Suppression des animaux */

  public $delete_id_animal;

  public function deleteConfirmationAnimal($id)
    {
      $this->delete_id_animal = $id;
      $this->dispatchBrowserEvent('show-delete-confirmation-animal');

    }
  public function deleteAnimal()
    {
      $animal = Animal::where('id', $this->delete_id_animal)->first();
      Storage::delete('animals_photos/' . $animal->photo);
      $user = auth()->user()->id;
      $an = $animal->user_id;

      if($an === $user) {
        $animal->delete();
     
        $this->emit('flash', 'La fiche a bien été supprimée ! :(', 
        'error');
      }
    }

  /* Fin suppression des animaux */

    public function render()
    {
        $ads = auth()->user()->ads;
        $animals = auth()->user()->animals;

        return view('livewire.dashboard.dashboard-panel', ['ads' => $ads, 'animals' => $animals]);
    }
}
