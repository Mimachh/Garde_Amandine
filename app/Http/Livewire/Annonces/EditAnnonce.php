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
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class EditAnnonce extends Component
{
    use Flash;
    use WithFileUploads;
    
    public $annonce;

    

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

    
    public $user_id, $name, $price, $garde, $prix, $chats, 
           $chats_id, $chiens, $chiens_id, $poissons, $poissons_id,
           $rongeurs, $rongeurs_id, $oiseaux, $oiseaux_id, $reptiles,
           $reptiles_id, $ferme, $ferme_id, $autre, $autre_id, $description, 
           $start_watch, $end_watch, $garde_type, $gardes, $photo, $habs, $exts, $hab, $ext, $Infoprice;

    public function mount()
        {
            $this->gardes = Garde::all();
            $this->name = auth()->user()->name;
            $this->user_id = auth()->user()->id;
            $this->habs = Habitation::all();
            $this->exts = Exterieur::all();  
         
            /* Animals */
         
                $this->chats_id = Espece::find(1);
                $this->chiens_id = Espece::find(2);
                $this->poissons_id  = Espece::find(3);
                $this->rongeurs_id = Espece::find(4);
                $this->oiseaux_id = Espece::find(5);
                $this->reptiles_id = Espece::find(6);
                $this->ferme_id = Espece::find(7);
                $this->autre_id = Espece::find(8);
         
            /* Fin animaux */    
        }


        /* Affichage des anciennes valeurs */


            public function oldValuesAnnonces(Annonce $annonce)
            {
            
                $annonce_id = $this->annonce->id;
                $annonce = Annonce::findorFail($annonce_id);

                $this->start_watch = $annonce->start_watch;
                $this->end_watch = $annonce->end_watch;
                $this->garde = $annonce->garde_id;
                $this->ville = $annonce->ville_id;
                $this->prix = $annonce->price /100;
                $this->hab = $annonce->habitation_id;
                $this->ext = $annonce->exterieur_id;
                $this->description = $annonce->description;
                $this->chats = $annonce->chats;
                $this->chiens = $annonce->chiens;
                $this->poissons = $annonce->poissons;
                $this->rongeurs = $annonce->rongeurs;
                $this->oiseaux = $annonce->oiseaux;
                $this->reptiles = $annonce->reptiles;
                $this->ferme = $annonce->ferme;
                $this->autre = $annonce->autre;
            
            }
        /* Fin affichage des anciennes valeurs */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
   

    public function update()
    {
        
        $ids = $this->annonce->id;
        
        $prix = $this->prix * 100;
        
        /* Photo */
            if(isset($this->photo))
                {
                    Storage::delete('annonces_photos/' . $this->annonce->photo);
                    $name_file = md5($this->photo . microtime()).'.'.$this->photo->extension();
                    $this->photo->storeAs('annonces_photos', $name_file);
                    $img = Image::make(public_path("/storage/annonces_photos/{$name_file}"))->fit(1795, 1200);
                    $img->save();
                }

            else {
                $name_file = $this->annonce->photo;
                }
        /* Fin photo */

        

        /* Checkbox null */
            if($this->chats != 1)
            {
                $this->chats = null;
            }
            if($this->chiens != 2)
            {
                $this->chiens = null;
            }
            if($this->poissons != 3)
            {
                $this->poissons = null;
            }
            if($this->rongeurs != 4)
            {
                $this->rongeurs = null;
            }
            if($this->oiseaux != 5)
            {
                $this->oiseaux = null;
            }
            if($this->reptiles != 6)
            {
                $this->reptiles = null;
            }
            if($this->ferme != 7)
            {
                $this->ferme = null;
            }
            if($this->autre != 8)
            {
                $this->autre = null;
            }
        /* Fin checkbox */   

        $this->validate(
            [ 'description' => 'required|max:60',
              'garde' => 'required|integer',
              'ville' => 'required|integer',
              'hab' => 'required|integer',
              'ext' => 'required|integer',
              'photo' => 'nullable|image|max:2048|mimes:jpg,jpeg,png',
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

        $update = Annonce::find($ids)->update([
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
            'photo' => $name_file,
            'habitation_id' => $this->hab,
            'exterieur_id' => $this->ext,
        ]);

        self::message('success', 'La modification a bien été enregistrée !');
        return redirect()->route('annonces.show', $ids);
    }
    
    
    
    public function render()
    {
        return view('livewire.annonces.edit-annonce');
    }
}

