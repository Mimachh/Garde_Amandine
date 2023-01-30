<?php

namespace App\Http\Livewire\Animals;

use App\Models\Age;
use App\Models\Race;
use App\Models\Sexe;
use App\Models\Animal;
use App\Models\Espece;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\View\Components\Flash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

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
public $sexes;
public $sexe_id;

/* FAIRE LES ESPECES */





public $races;

public function mount()
{
    $this->races = collect();
    $this->sexes = Sexe::all();

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
    $this->sexe_id = $animals->sexe_id;
    $this->age = $animals->age_id;
    $this->espece = $animals->espece_id;
    $this->race = $animals->race_id;
    $this->personnalité = $animals->personnality;
    $this->chiens = $animals->male_dogs;
    $this->chiennes = $animals->female_dogs;
    $this->chats = $animals->male_cats;
    $this->chattes = $animals->female_cats;
    $this->rongeurs = $animals->male_rongeurs;
    $this->rongeuses = $animals->female_rongeurs;
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
            $img = Image::make(public_path("/storage/animals_photos/{$name_file}"))->fit(1795, 1200);
            $img->save();  
        }

    else {
        $name_file = $this->animal->photo;
        }
        
    /* Fin photo */
    

    $validated = $this->validate(
        [
            'nom' => 'required|max:60',
            'personnalité' => 'required|max:255',
            'sexe_id' => 'nullable|integer',
            'espece' => 'required|integer',
            'race' => 'required|integer',
            'chiens' => 'nullable|boolean',
            'chiennes' => 'nullable|boolean',
            'chats' => 'nullable|boolean',
            'chattes' => 'nullable|boolean',
            'rongeurs' => 'nullable|boolean',
            'rongeuses' => 'nullable|boolean',
            'birds' => 'nullable|boolean',
            'reptiles' => 'nullable|boolean',
            'photo' => 'nullable|image|max:2048|mimes:jpg,jpeg,png',
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
            'photo.image' => 'Le format du fichier photo n\'est pas accepté',
            'photo.max' => 'La photo est trop lourde !',
            'photo.mimes' => 'Le type du fichier photo n\'est pas accepté !',
            'sexe_id.integer' => 'La valeur n\'est pas correcte !',
        ]);

    $ids = $this->animal->id;
  
    $animals = Animal::find($ids)->update([
       
     
        'animal_name' => $this->nom,
        'age_id' => $this->age,
        'sexe_id' => $this->sexe_id,
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
