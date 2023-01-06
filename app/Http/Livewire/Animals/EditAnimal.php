<?php

namespace App\Http\Livewire\Animals;

use App\Models\Age;
use App\Models\Race;
use App\Models\Animal;
use App\Models\Espece;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\View\Components\Flash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EditAnimal extends Component
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

public $ids;

public $animal;

public $personnality;

/* FAIRE LES ESPECES */





public $races;

public function mount()
{
    $this->races = collect();
   

}

public function updatedEspece($newValue)
{
    $this->races = Race::where('espece_id', $newValue)->orderBy('race_animal')->get();
}

public function oldValuesAnimals(Animal $animal)
{
    $animal_id = $this->animal->id;
    $animals = Animal::findOrFail($animal_id);

   

    $this->nom = $animals->animal_name;
    $this->age = $animals->age_id;
    $this->espece = $animals->espece_id;
    $this->race = $animals->race_id;
    $this->personnality = $animals->personnality;
    $this->chiens = $animals->male_dogs;
    $this->chiennes = $animals->female_dogs;
    $this->chats = $animals->male_cats;
    $this->chattes = $animals->female_cats;
    $this->rongeurs = $animals->male_rongeurs;
    $this->rongeuses = $animals->female_rongeuses;
    $this->birds = $animals->birds;
    $this->reptiles = $animals->reptiles;

}

public function update()
{
   

    /* Photo */
    if(isset($this->photo))
        {
            Storage::delete('animals_photos/' . $this->animal->photo);
            $name_file = md5($this->photo . microtime()).'.'.$this->photo->extension();
            $this->photo->storeAs('animals_photos', $name_file);
        }

    else {
        $name_file = $this->animal->photo;
        }
        
    /* Fin photo */
    

   $validated =$this->validate([
        'nom' => 'required',
        'personnality' => 'nullable',
        'espece' => 'required',
        'race' => 'required',
        'chiens' => 'nullable',
        'chiennes' => 'nullable',
        'chats' => 'nullable',
        'chattes' => 'nullable',
        'rongeurs' => 'nullable',
        'rongeuses' => 'nullable',
        'birds' => 'nullable',
        'reptiles' => 'nullable',
        'photo' => 'image',
        'age' => 'nullable',
      
   ]);

   $ids = $this->animal->id;
  
   $animals = Animal::find($ids)->update([
       
     
        'animal_name' => $this->nom,
        'age_id' => $this->age,
        'personnality' => $this->personnality,
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
        'photo' => $name_file,
        
    ]);

    self::message('success', 'La fiche de ton animal a bien été modifiée !');
    return redirect()->route('animals.show', $ids);

   
 
    }

    public function render()
    {
        $ages = Age::all();
        $especes = Espece::select('id', 'espece')->where('id', '<', 9 )->get();

        return view('livewire.animals.edit-animal',  ["especes"=>$especes, 'ages'=>$ages]);
    }
}
