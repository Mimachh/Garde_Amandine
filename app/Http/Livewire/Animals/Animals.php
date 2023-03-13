<?php

namespace App\Http\Livewire\Animals;

use App\Models\Animal;
use Livewire\Component;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Animals extends Component
{
    use AuthorizesRequests;
    
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


 /**
 * Display a listing of the resource.
 *
 * @return \Illuminate\Http\Response
 */
    public function index()
    {
        $animals = Animal::paginate(8);
        

            return view('animals.index', ['animals' => $animals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $oldUrl = $_SERVER['HTTP_REFERER'];
        return view('animals.create', ['oldUrl' => $oldUrl]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function show(Animal $animal)
    {
        
        return view('animals.show', compact('animal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function edit(Animal $animal)
    {
        $this->authorize('update', $animal);

        return view ('animals.edit', compact('animal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Animal $animal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        //
    }

    public function render()
    {
        return view('livewire.animals.animals');
    }
}
