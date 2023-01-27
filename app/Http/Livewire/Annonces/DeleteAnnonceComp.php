<?php

namespace App\Http\Livewire\Annonces;

use App\Models\Annonce;
use Livewire\Component;
use App\View\Components\Flash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class DeleteAnnonceComp extends Component
{
    public $annonce;
    use AuthorizesRequests;
    use Flash;
   

/* La modal Sweet Alert 2 */

    public $delete_id;
    public $img;

    protected $listeners = ['deleteConfirmed' => 'deleteAnnonce'
    ];

    public function deleteConfirmation($id)
      {
        $this->authorize('delete', $this->annonce);

        $this->delete_id = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');

      }
    public function deleteAnnonce()
      {
        
          
          $annonce = Annonce::where('id', $this->delete_id)->first();
          Storage::delete('annonces_photos/' . $annonce->photo);
     
          $annonce->delete();
       
       
          self::message('danger', 'Votre annonce a bien été supprimée ! :(');

          return redirect()->route('annonces.index');    
        
      }
  /* Fin la modal Sweet Alert 2 */
  
    public function render()
    {
        return view('livewire.annonces.delete-annonce-comp');
    }
}

