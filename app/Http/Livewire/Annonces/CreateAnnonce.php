<?php

namespace App\Http\Livewire\Annonces;

use App\Models\Garde;
use App\Models\Ville;
use App\Models\Espece;
use App\Models\Annonce;
use Livewire\Component;
use App\Models\Exterieur;
use App\Models\Habitation;
use Livewire\WithFileUploads;
use App\View\Components\Flash;

use Intervention\Image\Facades\Image;

class CreateAnnonce extends Component
{
  use Flash;

  use WithFileUploads;

    /* Séparation des pages */

    public $currentPage = 1;
    public $pages = [1=>1, 2=>2, 3=>3];

    public function goToPreviousPages()
      {
        $this->currentPage--;
      }
    public function goToNextPages()
      {
        $this->currentPage++;
      }


    /* Barre de data-list */

    public $ville='';
    public $villes = [];
     

  public function updatedVille()
  {
        $words = '%' . $this->ville . '%';

        if(strlen($this->ville) > 2) 
            {
                $this->villes = Ville::where('ville_nom', 'like', $words)
                ->orWhere('ville_departement', 'like', $words)
                ->orWhere('ville_code_postal', 'like', $words)
                ->orWhere('ville_nom_simple', 'like', $words)
                ->get();
            
            }   
  }

  /* Validation du formulaire */
 public $v;
  public $garde;
  public $prix;
  
  public $ville_id;

  public $chats;
  public $chats_id;

  public $chiens;
  public $chiens_id;

  public $poissons;
  public $poissons_id;

  public $rongeurs;
  public $rongeurs_id;

  public $oiseaux;
  public $oiseaux_id;

  public $reptiles;
  public $reptiles_id;

  public $ferme;
  public $ferme_id;

  public $autre;
  public $autre_id;

  public $description;


  public $start_watch;
  public $end_watch;

  public $photo;

  public $habs;
  public $exts;
  public $hab;
  public $ext;

  public function mount()
  {
      $this->gardes = Garde::all();
      $this->habs = Habitation::all();
      $this->exts = Exterieur::all();  
      $this->chats_id = Espece::find(1);
      $this->chiens_id = Espece::find(2);
      $this->poissons_id  = Espece::find(3);
      $this->rongeurs_id = Espece::find(4);
      $this->oiseaux_id = Espece::find(5);
      $this->reptiles_id = Espece::find(6);
      $this->ferme_id = Espece::find(7);
      $this->autre_id = Espece::find(8);
  }

 

  public function store()
  {   

    $this->validate(
      [ 
        'description' => 'required|max:60',
        'garde' => 'required|integer',
        'ville' => 'required|integer',
        'hab' => 'required|integer',
        'ext' => 'required|integer',
        'photo' => 'required|image|max:2048|mimes:jpg,jpeg,png',
        'start_watch' => 'nullable|date',
        'end_watch' => 'nullable|date',
        'chats' => 'nullable|integer',
        'chiens' => 'nullable|integer',
        'poissons' => 'nullable|integer',
        'rongeurs' => 'nullable|integer',
        'oiseaux' => 'nullable|integer',
        'reptiles' => 'nullable|integer',
        'ferme' => 'nullable|integer',
        'autre' => 'nullable|integer',
        'prix' => 'required|integer',
      ],
      [
        'description.max' => 'La description ne doit pas dépasser 60 caractères !',
        'description.required' => 'La description est obligatoire !',
        'garde.required' => 'Un type de garde est obligatoire !',
        'garde.integer' => 'La valeur renseignée n\'est pas bonne !',
        'ville.required' => 'Une ville est obligatoire !',
        'ville.integer' => 'La valeur renseignée n\'est pas bonne !',
        'hab.required' => 'Un type d\'habitation est obligatoire !',
        'hab.integer' => 'La valeur renseignée n\'est pas bonne !',
        'ext.required' => 'Un extérieur est obligatoire !',
        'ext.integer' => 'La valeur renseignée n\'est pas bonne !',
        'photo.required' => 'Une photo est obligatoire !',
        'photo.image' => 'Le format du fichier photo n\'est pas accepté',
        'photo.max' => 'La photo est trop lourde !',
        'photo.mimes' => 'Le type du fichier photo n\'est pas accepté !',
        'start_watch.date' => 'La date de début doit être une date !',
        'end_watch.date' => 'La date de fin doit être une date !',
        'chats.integer' => 'La valeur du champs chats n\'est pas acceptée !',
        'chiens.integer' => 'La valeur du champs chats n\'est pas acceptée !',
        'poissons.integer' => 'La valeur du champs chiens n\'est pas acceptée !', 
        'rongeurs.integer' => 'La valeur du champs rongeurs n\'est pas acceptée !',
        'oiseaux.integer' => 'La valeur du champs oiseaux n\'est pas acceptée !',
        'reptiles.integer' => 'La valeur du champs reptiles n\'est pas acceptée !', 
        'ferme.integer' => 'La valeur du champs ferme n\'est pas acceptée !', 
        'autre.integer' => 'La valeur du champs autre n\'est pas acceptée !',
        'prix.integer' => 'La valeur du champs prix n\'est pas acceptée !',
        'prix.required' => 'Le prix est obligatoire !',

      ]
    );

    $name = auth()->user()->name;
    $user_id = auth()->user()->id;
    
    /* Image */
      $prix = $this->prix * 100;
      $name_file = md5($this->photo . microtime()).'.'.$this->photo->extension();
      $this->photo->storeAs('annonces_photos', $name_file);
      $img = Image::make(public_path("/storage/annonces_photos/{$name_file}"))->fit(1795, 1200);
      $img->save();

    
    $annonces=Annonce::create([
         
        'garde_id' => $this->garde,
        'ville_id' => $this->ville,
        'start_watch' => $this->start_watch,
        'end_watch' => $this->end_watch,
        'chats' => $this->chats,
        'chiens' => $this->chiens,
        'oiseaux' => $this->oiseaux,
        'poissons' => $this->poissons,
        'rongeurs' => $this->rongeurs,
        'ferme' => $this->ferme,
        'autre' => $this->autre,
        'reptiles' => $this->reptiles,
        'description' => $this->description,
        'price' => $prix,
        'name' => $name,
        'user_id' => $user_id,
        'photo' => $name_file,
        'habitation_id' => $this->hab,
        'exterieur_id' => $this->ext,
    ]);

     
      self::message('success', 'Ton annonce est bien enregistrée !.');
      return redirect()->route('annonces.show', $annonces->id);

  }

    public function render()
    {
        return view('livewire.annonces.create-annonce');
    }
}