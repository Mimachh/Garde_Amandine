<?php

namespace App\Http\Livewire\Admin;

use App\Models\Garde;
use App\Models\Annonce;
use Livewire\Component;
use App\Models\Exterieur;
use App\Models\Habitation;
use Illuminate\Support\Facades\Storage;

class AdminAdController extends Component
{
    public $annonces;
    public $habitations;
    public $exterieurs;
    public $gardes;
    public $state = [];
    public $updateMode = false;


    public function mount()
    {
        $this->annonces = Annonce::all();
        $this->habitations = Habitation::all();
        $this->exterieurs = Exterieur::all();
        $this->gardes = Garde::all();
    }

    public function index()
    {
        return view('admin.ads_list');
    }
    private function resetInputFields(){
        $this->reset('state');
    }

    public function edit($id)
    {
        $this->updateMode = true;

        $annonce = Annonce::find($id);

        $this->state = [
            'id' => $annonce->id,
            'name' => $annonce->name,
            'ville_id' => $annonce->ville_id,
            'habitation_id' => $annonce->habitation_id,
            'exterieur_id' => $annonce->exterieur_id,
            'status' => $annonce->status,
            'start_watch' => $annonce->start_watch,
            'end_watch' => $annonce->end_watch,
            'garde_id' => $annonce->garde_id,
            'chats' => $annonce->chats,
            'chiens' => $annonce->chiens,
            'poissons' => $annonce->poissons,
            'rongeurs' => $annonce->rongeurs,
            'oiseaux' => $annonce->oiseaux,
            'reptiles' => $annonce->reptiles,
            'ferme' => $annonce->ferme,
            'autre' => $annonce->autre,
            'description' => $annonce->description,
            'price' => $annonce->price,
            'user_id' => $annonce->user_id,
        ];
    }
    public function update()
    {
       
        if ($this->state['id']) {
            $annonce = Annonce::find($this->state['id']);
            $annonce->update([
                'name' => $this->state['name'],
                'ville_id' => $this->state['ville_id'],
                'habitation_id' => $this->state['habitation_id'],
                'exterieur_id' => $this->state['exterieur_id'],
                'status' => $this->state['status'],
                'start_watch' => $this->state['start_watch'],
                'end_watch' => $this->state['end_watch'],
                'garde_id' => $this->state['garde_id'],
                'chats' => $this->state['chats'],
                'chiens' => $this->state['chiens'],
                'poissons' => $this->state['poissons'],
                'rongeurs' => $this->state['rongeurs'],
                'oiseaux' => $this->state['oiseaux'],
                'reptiles' => $this->state['reptiles'],
                'ferme' => $this->state['ferme'],
                'autre' => $this->state['autre'],
                'description' => $this->state['description'],
                'price' => $this->state['price'],
                'user_id' => $this->state['user_id'],
            ]);


            $this->updateMode = false;
            $this->reset('state');
            $this->annonces = Annonce::all();
        }
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->reset('state');
    }

    public function delete($annonce)
    {

        $annonce = Annonce::where('id', $annonce)->first();
       
        Storage::delete('annonces_photos/' . $annonce->photo);
   
        $annonce->delete();

        $this->annonces = Annonce::all();
    }
    
    public function render()
    {
        return view('livewire.admin.admin-ad-controller');
    }
}
