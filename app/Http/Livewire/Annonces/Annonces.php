<?php

namespace App\Http\Livewire\Annonces;

use App\Models\Garde;
use App\Models\Ville;
use App\Models\Animal;
use App\Models\Espece;
use App\Models\Annonce;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Routing\Route;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Annonces extends Component
{
    use AuthorizesRequests;
    use WithPagination;
    public $chats;

    public function index(Request $request)
    {
        $annonces = Annonce::query()
        ->where('status', 1)->filters(
            sortBy: $request->sortBy,
            direction: $request->direction,
        )->withCount(relations: 'fav')->latest()->paginate(6);    
        return view('annonces.index', ['annonces' => $annonces]);
    }


    public $q;

    public function search(Request $request): JsonResponse
    { 
        $chat = $request->input('chat');
        if($chat != 1)
        {
            $chat = NULL;
        }else{
            $chat = 1;
        }
        
        $q = $request->input('q');

        
        $ville = $request->input('ville');
        /* Ville */
        if($request->input('ville')){
            
            $v= Ville::where('ville_nom', 'like', "%". $ville . "%")->pluck('id');
        }else{
            //$ville = 'Le mans';
            $rand = rand(1,2);
            $v= Ville::where('id', 'like', $rand)->pluck('id')->all();
        }

        //$v= Ville::where('ville_nom', 'like', "%". $ville . "%")->pluck('id');



        $annonces = Annonce::where('name', 'like', '%'. $q . '%')
        ->when($v, function ($s) use ($v) {
            return $s->where('ville_id', 'like', $v);})
        ->when($chat, function ($s) use ($chat) {
            return $s->where('chats', 'like', $chat);})->where('status', 1)
        ->get();


        return response()->json([
            'annonces' => $annonces,
        ]);
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

