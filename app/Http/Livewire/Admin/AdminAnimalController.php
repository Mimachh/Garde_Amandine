<?php

namespace App\Http\Livewire\Admin;

use App\Models\Animal;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class AdminAnimalController extends Component
{
    public $animals;
    public $state = [];
    public $updateMode = false;

    public function mount()
    {
        $this->animals = Animal::all();
    }

    public function index()
    {
        return view('admin.animals_list');
    }

    public function edit($id)
    {
        $this->updateMode = true;

        $animal = Animal::find($id);

        $this->state = [
            'id' => $animal->id,
            'age_id' => $animal->age_id,
            'animal_name' => $animal->animal_name,
            'personnality' => $animal->personnality,
            'espece_id' => $animal->espece_id,
            'race_id' => $animal->race_id,
            'male_dogs' => $animal->male_dogs,
            'female_dogs' => $animal->female_dogs,
            'male_cats' => $animal->male_cats,
            'female_cats' => $animal->female_cats,
            'male_rongeurs' => $animal->male_rongeurs,
            'female_rongeurs' => $animal->female_rongeurs,
            'birds' => $animal->birds,
            'reptiles' => $animal->reptiles,            
        ];
    }

    private function resetInputFields(){
        $this->reset('state');
    }

    public function update()
    {
       
        if ($this->state['id']) {
            $animal = Animal::find($this->state['id']);
            $animal->update([
                'age_id' => $this->state['age_id'],
                'animal_name' => $this->state['animal_name'],
                'personnality' => $this->state['personnality'],
                'espece_id' => $this->state['espece_id'],
                'race_id' => $this->state['race_id'],
                'male_dogs' => $this->state['male_dogs'],
                'female_dogs' => $this->state['female_dogs'],
                'male_cats' => $this->state['male_cats'],
                'female_cats' => $this->state['female_cats'],
                'male_rongeurs' => $this->state['male_rongeurs'],
                'female_rongeurs' => $this->state['female_rongeurs'],
                'birds' => $this->state['birds'],
                'reptiles' => $this->state['reptiles'],    
            ]);


            $this->updateMode = false;
            $this->reset('state');
            $this->animals = Animal::all();
        }
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->reset('state');
    }

    public function delete($animal)
    {

        $animal = Animal::where('id', $animal)->first();
       
        Storage::delete('animals_photos/' . $animal->photo);
   
        $animal->delete();
        $this->animals = Animal::all();

    }
    
    public function render()
    {
        return view('livewire.admin.admin-animal-controller');
    }
}
