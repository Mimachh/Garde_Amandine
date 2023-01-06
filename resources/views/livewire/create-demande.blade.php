
<h1>Je le garde en exemple au cas ou</h1>

<main class="md:grid md:grid-cols-6 md:gap-4">
{{$annonce->name }}
<x-jet-validation-errors class="mb-4 text-center" />
<div class="mt-5 md:col-start-2 md:col-span-4 md:mt-0 bg-white rounded">
    <form wire:submit.prevent="store" class=" space-y-10 text-center">

        <!-- <div>
            <textarea class="w-full h-20 mt-10" disabled >Bonjour {{$annonce->name}} j'ai besoin de toi pour garder :</textarea>
        </div> -->
        

        <!-- Dates -->
            <x-jet-label class="text-lg mt-10" for="date">Vous souhaitez réserver une garde : </x-jet-label>
            <div class="flex py-5 justify-center bg-red-400">
                <div class="ml-3 text-sm mr-8">
                    <x-jet-label for="start_date" value="{{ __('Du :') }}"/>
                </div>
                <div class="flex h-5 items-center">
                    <x-jet-input id="start_date" wire:model="start_date" name="start_date" type="date"/> 
                    @error('start_date') <span class="error">{{ $message }}</span> @enderror  
                </div>
                <div class="ml-16 text-sm mr-8">
                    <x-jet-label for="end_date" value="{{ __('Au :') }}"/>
                </div>
                <div class="flex h-5 items-center">
                    <x-jet-input id="end_date" wire:model='end_date' name="end_date" type="date"/>   
                </div>
            </div>
        <!-- Fin date -->

        <!-- Garde -->
            <x-jet-label class="text-lg mt-10" for="date">Type de garde souhaité : </x-jet-label>
            <div class="flex py-5 justify-center bg-gray-400">
                <select wire:model='garde_id' class="py-2 px-6 bg-gray-200 border rounded focus:outline-none focus:shadow-outline appearance-none border border-gray-500 rounded text-gray-700 leading-tight">
                    <option value="">--Choisissez un type de garde--</option>
                    @foreach($gardes as $g) 
                        <option value="{{ $g->id }}">{{ $g->garde }}</option>
                    @endforeach
                </select>
            </div>
        <!-- Fin garde -->

        <!-- Selection Animaux -->
            <x-jet-label class="text-lg mt-10" for="animals">Vos animaux à garder :</x-jet-label>

            @forelse(auth()->user()->animals as $anima)
                <div class="space-y-8 pb-5 bg-blue-400">
                    <div>
                        <select class="py-2 px-6 bg-gray-200 border rounded focus:outline-none focus:shadow-outline appearance-none border border-gray-500 rounded text-gray-700 leading-tight" 
                            name="animal_1" id="first_animal_id" wire:model="first_animal_id">
                            <option value="">Choisir l'animal à garder</option>
                                @foreach(auth()->user()->animals as $animal)
                                    <option value="{{$animal->id}}">{{$animal->animal_name}}</option>    
                                @endforeach                         
                        </select>
                    </div>
                    <div>
                        <select class="py-2 px-6 bg-gray-200 border rounded focus:outline-none focus:shadow-outline appearance-none border border-gray-500 rounded text-gray-700 leading-tight"
                        name="animal_2" id="second_animal_id" wire:model="second_animal_id">
                            <option value="">Choisir l'animal à garder</option>
                            @foreach(auth()->user()->animals as $animal)
                                    <option value="{{$animal->id}}">{{$animal->animal_name}}</option>    
                                @endforeach                         
                        </select>
                    </div>
                    <div>
                        <select class="py-2 px-6 bg-gray-200 border rounded focus:outline-none focus:shadow-outline appearance-none border border-gray-500 rounded text-gray-700 leading-tight"
                        name="animal_3" id="third_animal_id" wire:model="third_animal_id">
                            <option value="">Choisir l'animal à garder</option>
                            @foreach(auth()->user()->animals as $animal)
                                    <option value="{{$animal->id}}">{{$animal->animal_name}}</option>    
                                @endforeach                         
                        </select>
                    </div>
                </div>
            @empty
            <p class="mt-2">Vous n'avez aucun animal renseigné. Ajouter un animal en cliquant <a class="text-blue-600" href="{{ route('animals.create') }}">ici.</a></p> 
            @endforelse
        <!-- Fin selection Animaux -->

        <!-- Mail -->
            <div class="justify-center bg-green-400 py-4">
                <x-jet-label for="mail" value="{{ __('Votre adresse mail') }}" />
                <x-jet-input wire:model="mail" id="mail" class="mt-3 w-64" type="email" name="mail"  required autofocus />
                <x-jet-label class="text-sm mt-1" value="(Pour que le Pet-Sitter puisse vous contacter)" />
            </div>
        <!-- Fin mail -->

        <button type="submit">Save Contact</button>

    </form>
</div>



</main>
