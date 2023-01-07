<?php

namespace App\Http\Livewire\Animals;

use App\Models\Age;
use App\Models\Race;
use App\Models\Animal;
use App\Models\Espece;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;
use App\View\Components\Flash;


class CreateAnimal extends Component
{
    use Flash;
    use WithFileUploads;
    /* Séparation des pages */

    public $currentPage = 1;
    public $pages = [1=>1,
                    2=>2];

    public function goToPreviousPages()
    {
        $this->currentPage--;
    }
    public function goToNextPages()
    {
        $this->currentPage++;
    }
/* Fin séparation page */

/* Début du formulaire */
    

/* Validation du formulaire */

public $nom;

public $personnalité;

public $chiens;
public $chiennes;

public $chats;
public $chattes;

public $rongeurs;
public $rongeuses;

public $birds;

public $reptiles;

public $owner;


public $espece;

public $race;

public $photo;

public $age;

public $races;
public $user_id;

public function mount()
{
    $this->races = collect();
    $this->user_id = auth()->user()->id;


}

public function updatedEspece($newValue)
{
    $this->races = Race::where('espece_id', $newValue)->orderBy('race_animal')->get();
}

public function store(Request  $request)
{
   

   $validated = $this->validate(
    [
        'nom' => 'required|max:60',
        'personnalité' => 'required|max:255',
        'espece' => 'required|integer',
        'race' => 'required|integer',
        'chiens' => 'nullable|integer',
        'chiennes' => 'nullable|integer',
        'chats' => 'nullable|integer',
        'chattes' => 'nullable|integer',
        'rongeurs' => 'nullable|integer',
        'rongeuses' => 'nullable|integer',
        'birds' => 'nullable|integer',
        'reptiles' => 'nullable|integer',
        'user_id' => 'required|integer',
        'photo' => 'required|image|max:2048|mimes:jpg,jpeg,png',
        'age' => 'required|integer',
      
    ],
    [
        'nom.required' => 'Un nom est obligatoire !',
        'nom.max' => 'Le nom est trop long ! Mettez un surnom plus court :)',
        'personnalité.required' => 'La personnalité est obligatoire !',
        'personnalité.max' => 'La personnalité est trop longue !',
        'espece.required' => 'L\'espece est obligatoire !',
        'espece.integer' => 'La valeur d\'espèce n\'est pas bonne !',
        'race.required' => 'La race est obligatoire !',
        'race.integer' => 'La valeur de la race n\'est pas bonne !',
        'chiens.integer' => 'La valeur de chiens mâles n\'est pas bonne !',
        'chienne.integer' => 'La valeur de chiens femelles n\'est pas bonne !',
        'chats.integer' => 'La valeur de chats mâles n\'est pas bonne !',
        'chattes.integer' => 'La valeur de chats femelles n\'est pas bonne !',
        'rongeurs.integer' => 'La valeur de rongeurs mâles n\'est pas bonne !',
        'rongeuses.integer' => 'La valeur de rongeurs femelles n\'est pas bonne !',
        'birds.integer' => 'La valeur de oiseaux n\'est pas bonne !',
        'reptiles.integer' => 'La valeur de reptiles n\'est pas bonne !',
        'age.required' => 'L\'âge est obligatoire !',
        'age.integer' => 'La valeur de l\'âge n\'est pas bonne !',
        'photo.required' => 'Une photo est obligatoire !',
        'photo.image' => 'Le format du fichier photo n\'est pas accepté',
        'photo.max' => 'La photo est trop lourde !',
        'photo.mimes' => 'Le type du fichier photo n\'est pas accepté !',
    ]);


   $name_file = md5($this->photo . microtime()).'.'.$this->photo->extension();
   $this->photo->storeAs('animals_photos', $name_file);
  

   $animals = Animal::create([
       
     
        'animal_name' => $this->nom,
        'age_id' => $this->age,
        'personnality' => $this->personnalité,
        'male_dogs' => $this->chiens,
        'female_dogs' => $this->chiennes,
        'male_cats' => $this->chats,
        'female_cats' => $this->chattes,
        'male_rongeurs' => $this->rongeurs,
        'female_rongeurs' => $this->rongeuses,
        'birds' => $this->birds,
        'reptiles' => $this->reptiles,
        'espece_id' =>$this->espece,
        'race_id' => $this->race,
        'user_id' => $this->user_id,
        'photo' => $name_file,
        
    ]);

    self::message('success', 'La fiche de ton animal est bien enregistrée !.');
    return redirect()->route('animals.show', $animals->id);

   
 
    }

    public function render()
    {
        
        $ages = Age::all();
        $especes = Espece::select('id', 'espece')->where('id', '<', 9 )->get();

        return view('livewire.animals.create-animal', ["especes"=>$especes, 'ages'=>$ages]);
    }
}
