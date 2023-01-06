<x-slot name="header">
    <h1 class="font-semibold text-xl text-gray-200 leading-tight text-center">
        {{ __('Créer mon annonce de pet-sitter') }}
    </h1>
</x-slot>

<x-slot name="buttonBack">
    @livewire('previous-page')
</x-slot>

<main class="bg-indigo-50 pt-5 rounded-3xl ">
        <h2 class="text-center mt-5 py-5 font-semibold">Créer mon annonce de pet-sitter</h2>
    
        <!-- Début du formulaire  -->
        <div class="mt-10 sm:mt-2">
            <div class="md:grid md:grid-cols-6 md:gap-4 ">
                <div class="mt-5  md:col-start-2 md:col-span-4 md:mt-0">

                    <!-- Messages d'erreur -->
                        <div class="text-center mb-5">
                            @error('description') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                            @error('garde') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                            @error('ville') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                            @error('hab') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                            @error('ext') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                            @error('photo') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                            @error('prix') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror

                        </div>
                    <!-- Fin messages d'erreur -->

                    <form wire:submit.prevent="store">
                        <div class="overflow-hidden shadow sm:rounded-md mb-10 ">
                            <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

                            @if($currentPage === 1)
                                <!-- Photo --> 
                                <fieldset class="mt-4">
                                    <h2 class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">  
                                        Votre photo :
                                        <legend class="sr-only">Votre photo</legend>           
                                    </h2>
                                    <small>C'est toujours plus sympa de voir à qui on confie son animal !</small>
                                    <div class="my-5">
                                        <input name="photo" type="file" id="photo" wire:model="photo" wire:loading.attr="disabled"/>
                                        <div wire:loading wire:target="photo" class="text-sm text-gray-500 italic">Chargement...</div>
                                    </div>
                                </fieldset>
                                <!-- Choix de la ville -->    
                                <fieldset class="mt-4">
                                    <button type="button" class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">  
                                        Choisir votre ville :
                                        <legend class="sr-only">Choisir votre ville </legend>           
                                    </button>          
                                    <div class="my-8 space-y-4">
                                        <div class="flex items-start">
                                            <x-jet-input list="list_ville" wire:model='ville' id="ville" class="py-2 px-1 bg-gray-200 border rounded focus:outline-none focus:shadow-outline appearance-none border border-gray-500 rounded text-gray-700 leading-tight" placeholder="Entrez votre ville"/>
                                                @if (strlen($ville) > 2)
                                                    <datalist id="list_ville">
                                                        @if (count($villes) > 0)
                                                            @foreach ($villes as $ville)
                                                                <option value="{{$ville->id}}"> <label for="">{{$ville->ville_nom_reel}}-{{$ville->ville_departement}}</label> </option>
                                                             @endforeach
                                                        @endif
                                                    </datalist>
                                                @endif
                                        </div>
                                    </div>
                                </fieldset>
                                <hr>

                                <!-- Partie date mais en date --> 
                                <fieldset class="mt-4">
                                    <button type="button" class=" py-4 block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">  
                                        Quand êtes-vous disponible?
                                        <legend class="sr-only">Quand êtes-vous disponible?</legend>           
                                    </button>
                                    <div>
                                        <div class="my-8 space-y-4">
                                            <div class="flex items-start">
                                                <div class="ml-3 text-sm mr-8">
                                                    <x-jet-label for="start_watch" value="{{ __('Du :') }}"/>
                                                </div>
                                                <div class="flex h-5 items-center">
                                                    <x-jet-input id="start_watch" wire:model="start_watch" name="start_watch" type="date"/>   
                                                </div>
                                                <div class="ml-16 text-sm mr-8">
                                                    <x-jet-label for="end_watch" value="{{ __('Au :') }}"/>
                                                </div>
                                                <div class="flex h-5 items-center">
                                                    <x-jet-input id="end_watch" wire:model='end_watch' name="end_watch" type="date"/>   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <hr>


                                <!-- Partie type de garde -->
                                <fieldset class="mt-4 pt-4">
                                    <h2 class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2 pb-2">  
                                        Quel type de garde souhaitez vous?
                                        <legend class="sr-only">Quel type de garde <br> souhaitez vous?</legend>           
                                    </h2>
                                    <div class="my-4">                        
                                        <div class="flex items-start">               
                                            <div class="flex items-center">
                                                <select wire:model='garde' id="garde" class="py-2 px-6 bg-gray-200 border rounded focus:outline-none focus:shadow-outline appearance-none border border-gray-500 rounded text-gray-700 leading-tight">
                                                    <option value="">--Choisissez un type de garde--</option>
                                                        @foreach($gardes as $g) 
                                                        <option value="{{ $g->id }}">{{ $g->garde }}</option>
                                                        @endforeach
                                                </select>
                                            </div>       
                                            <small class="ml-4">
                                                Si votre tarif varie en fonction du type de garde <br> nous vous conseillons de créer 2 annonces !    
                                            </small>
                                        </div>
                                    </div>                 
                                </fieldset>
                        

                            @elseif ($currentPage === 2)
                                <!-- Partie type d'animaux -->
                                <fieldset class="mt-4">
                                    <h2 class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">  
                                            Quels animaux pouvez-vous garder?
                                    <legend class="sr-only">Quels animaux <br> pouvez-vous garder?</legend>           
                                    </h2>
                                    <div>   
                                        <div class=" space-y-4">

                                            <!-- Chats -->
                                            <div class="flex items-start pt-2">
                                            <div class="flex h-5 items-center">
                                                <x-jet-input wire:model="chats" value="{{$chats_id->id}}" id="chats" name="chats" type="checkbox" class=" h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <x-jet-label for="chats" name="chats" value="{{$chats_id->espece }}"/>
                                                <p class="text-gray-500 pt-1">Chat de race, de gouttière...</p>
                                            </div>
                                            </div> 

                                            <!-- Chiens -->
                                            <div class="flex items-start pt-2">
                                            <div class="flex h-5 items-center">
                                                <x-jet-input wire:model="chiens" value="{{$chiens_id->id}}" id="chiens" name="chiens" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <x-jet-label for="chiens" value="{{$chiens_id->espece}}"/>
                                                <p class="text-gray-500 pt-1">Labrador, Berger Australien...</p>
                                            </div>
                                            </div> 

                                            <!-- Poissons -->
                                            <div class="flex items-start pt-2">
                                            <div class="flex h-5 items-center">
                                                <x-jet-input wire:model="poissons" value="{{$poissons_id->id}}" id="watch_fish" name="poissons" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <x-jet-label for="watch_fish" value="{{$poissons_id->espece}}"/>
                                                <p class="pt-1 text-gray-500">En bocal, en bassin...</p>
                                            </div>
                                            </div> 
                                            
                                            <!-- Rongeurs -->
                                            <div class="flex items-start pt-2">
                                            <div class="flex h-5 items-center">
                                                <x-jet-input wire:model="rongeurs" value="{{$rongeurs_id->id}}" id="rongeurs" name="rongeurs" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <x-jet-label for="rongeurs" value="{{$rongeurs_id->espece}}"/>
                                                <p class="text-gray-500 pt-1">Lapin, cochon d'inde, hamster...</p>
                                            </div>
                                            </div>

                                            <!-- Oiseaux -->
                                            <div class="flex items-start pt-2">
                                            <div class="flex h-5 items-center">
                                                <x-jet-input wire:model="oiseaux" value="{{$oiseaux_id->id}}" id="bird" name="oiseaux" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                                            </div>
                                            <div class="ml-3 text-sm">
                                            <x-jet-label for="bird" value="{{$oiseaux_id->espece}}"/>
                                                <p class="text-gray-500 pt-1">Oiseaux en cage ou en volière.</p>
                                            </div>
                                            </div>

                                            <!-- Reptiles -->
                                            <div class="flex items-start pt-2">
                                            <div class="flex h-5 items-center">
                                                <x-jet-input wire:model='reptiles' value="{{$reptiles_id->id}}" id="reptile" name="reptiles" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                                            </div>
                                            <div class="ml-3 text-sm">
                                            <x-jet-label for="reptile" value="{{$reptiles_id->espece}}"/>
                                                <p class="text-gray-500 pt-1">Serpent, caméléon, tortue...</p>
                                            </div>
                                            </div>

                                            <!-- Ferme -->
                                            <div class="flex items-start pt-2">
                                            <div class="flex h-5 items-center">
                                                <x-jet-input wire:model="ferme" value="{{$ferme_id->id}}" id="farm_animal" name="ferme" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                                            </div>
                                            <div class="ml-3 text-sm">
                                            <x-jet-label for="farm_animal" value="{{$ferme_id->espece}}"/>
                                                <p class="text-gray-500 pt-1">Poule, oie, cheval...</p>
                                            </div>
                                            </div>

                                            <!-- Autre -->
                                            <div class="flex items-start pt-2">
                                            <div class="flex h-5 items-center">
                                                <x-jet-input wire:model="autre" value="{{$autre_id->id}}" id="other_animal" name="autre" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                                            </div>
                                            <div class="ml-3 text-sm">
                                                <x-jet-label for="other_animal" value="{{ $autre_id->espece}}"/>
                                                <p class="text-gray-500 pt-1">Vous acceptez de garder n'importe quel type d'animal.</p>
                                            </div>
                                        </div>        
                                    </div>
                                </fieldset>


                            @elseif ($currentPage === 3)
                    
                                <fieldset> 
                                        <h2 class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">  
                                        Conditions de garde :
                                            <legend  class="sr-only">Conditions de garde : </legend>           
                                        </h2>
                                    <div>
                                        <div class="my-4">                        
                                            <div class="flex items-start">               
                                                <div class="flex items-center">
                                                    <select wire:model='hab' id="hab" class="py-2 px-6 bg-gray-200 border rounded focus:outline-none focus:shadow-outline appearance-none border border-gray-500 rounded text-gray-700 leading-tight">
                                                        <option value="">--Type d'habitation--</option>
                                                            @foreach($habs as $hab) 
                                                            <option value="{{ $hab->id }}">{{ $hab->hab }}</option>
                                                            @endforeach
                                                    </select>
                                                </div> 
                                                <div class="flex items-center">
                                                    <select wire:model='ext' id="ext" class="ml-4 py-2 px-6 bg-gray-200 border rounded focus:outline-none focus:shadow-outline appearance-none border border-gray-500 rounded text-gray-700 leading-tight">
                                                        <option value="">--Extérieur--</option>
                                                            @foreach($exts as $ext) 
                                                            <option value="{{ $ext->id }}">{{ $ext->ext }}</option>
                                                            @endforeach
                                                    </select>
                                                </div>       
                                            </div>
                                        </div>     
                                    </div>
                                </fieldset>
                                <!-- Description -->
                                <fieldset>
                                    <h2 class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">  
                                            Décrivez-vous en quelques mots
                                            <legend class="sr-only">Décrivez-vous <br> en quelques mots</legend>           
                                    </h2>
                                        <div class="mt-4 space-y-4">
                                            <div class="flex items-start pt-4 pb-4">   
                                                <textarea wire:model="description" id="description" class=" resize border rounded focus:outline-none focus:shadow-outline bg-gray-200 appearance-none border border-gray-500 rounded text-gray-700 leading-tight w-full h-20" id="description" placeholder="Démarquez-vous des autres pet-sitters" name="description"></textarea>       
                                            </div>
                                        </div>       
                                </fieldset>    
                                <hr>

                                <!-- Prix -->
                                <fieldset> 
                                        <button class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">  
                                            Prix
                                            <legend class="sr-only">Prix</legend>           
                                        </button>
                                    <div>
                                    <div class="mt-4 space-y-4">
                                        <div class="flex items-start items-center">
                                            <div class="ml-3 text-sm pr-10 ">
                                            <x-jet-label for="prix" value="{{ __('Votre tarif en euro par jour.') }}"/>
                                            
                                            </div>
                                            <div class="flex">
                                            <x-jet-input wire:model="prix" id="prix" name="prix" type="text" class="bg-gray-200 border rounded focus:outline-none focus:shadow-outline appearance-none border border-gray-500 rounded text-gray-700 leading-tight"/>
                                            </div>
                                        
                                        </div>
                                    </div>
                                    </div>
                                </fieldset>
                            @endif
                                <hr>

                                <!-- Boutons -->
                                <div class="flex items-center justify-between px-4 py-8 text-right sm:px-6 mx-8"> 
                                    @if($currentPage === 1)
                                        <div></div>
                                    @else
                                        <x-jet-button class="bg-blue-600" wire:click='goToPreviousPages' type="button" >Retour</x-jet-button>
                                    @endif
                                    @if ($currentPage === count($pages))
                                        <x-jet-button class="bg-red-600" type="submit">Valider</x-jet-button>
                                    @else
                                        <x-jet-button class="bg-orange-700" wire:click="goToNextPages" type="button">Suivant</x-jet-button>
                                    @endif
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</main>

