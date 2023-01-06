<?php

namespace App\Http\Livewire\Annonces;

use App\Models\Animal;
use App\Models\Espece;
use App\Models\Annonce;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Annonces extends Component
{
    use AuthorizesRequests;
    use WithPagination;

   
    public function index()
    {
        $annonces = Annonce::where('status', 1)->paginate(6);
      
        
        return view('annonces.index', ['annonces' => $annonces]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('annonces.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }
    public $annonce;
    
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function show(Annonce $annonce)
    {       
      
        $animal = Animal::where('user_id', $annonce->user_id)->get();
     
       $this->emit('annonce', $annonce->id);

      

        $cat= Espece::select('espece')->where('id', $annonce->chats)->get();
        $dog = Espece::select('espece')->where('id', $annonce->chiens)->get();
        $fish = Espece::select('espece')->where('id', $annonce->poissons)->get();
        $rabbit = Espece::select('espece')->where('id', $annonce->rongeurs)->get(); 
        $bird = Espece::select('espece')->where('id', $annonce->oiseaux)->get();
        $rept = Espece::select('espece')->where('id', $annonce->reptiles)->get();
        $farm = Espece::select('espece')->where('id', $annonce->ferme)->get();
        $other = Espece::select('espece')->where('id', $annonce->autre)->get();
    
        $all_garde = [$cat, $dog, $fish, $rabbit, $bird, $rept, $farm, $other];
   
        
  
        return view('annonces.show', [
            'annonce' => $annonce, 
            'watches'=>$all_garde, 
            'animals' => $animal,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
  public $ids;
    public function edit(Annonce $annonce)
    {
        $this->authorize('update', $annonce);
       
        return view ('annonces.edit', compact('annonce'));
       
     
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Annonce $annonce)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Annonce  $annonce
     * @return \Illuminate\Http\Response
     */
    public function destroy(Annonce $annonce)
    {
        $this->authorize('destroy', $annonce);
    }

    

    public function render()
    {
        return view('livewire.annonces.annonces');
    }
}

