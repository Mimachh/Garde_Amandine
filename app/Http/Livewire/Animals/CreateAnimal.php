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
   

   $validated = $this->validate([
        'nom' => 'required',
        'personnalité' => 'nullable',
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
        'user_id' => 'required',
        'photo' => 'image',
        'age' => 'nullable',
      
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
