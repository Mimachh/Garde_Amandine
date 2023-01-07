
<x-slot name="header">
    <h1 class="font-semibold text-xl text-gray-200 leading-tight text-center">
        {{ __('Créer la fiche de mon animal') }}
    </h1>
</x-slot>

<x-slot name="buttonBack">
    @livewire('previous-page')
</x-slot>

<main class="bg-gray-100">

        <div class="py-5">
            <h2 class="text-center font-bold">Créer la fiche de mon animal</h2>
            <p class="text-center mb-10 py-5">Ses informations permettront au Pet-Sitter d'en savoir plus sur votre animal. <br>
           Les Pet-Sitter acceptent plus facilement les gardes lorsqu'ils ont une description de votre compagnon. </p>
        </div>

    <!-- Début du formulaire  -->
    <div class="mt-10 sm:mt-2">
        <div class="md:grid md:grid-cols-6 md:gap-4 ">
            <div class="mt-5  md:col-start-2 md:col-span-4 md:mt-0">

                <!-- Messages d'erreur -->
                <div class="text-center mb-5">
                    @error('nom') <span class="italic block text-red-600 text-sm">{{ $message }}</span> @enderror
                    @error('personnalité') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                    @error('espece') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                    @error('race') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                    @error('chiens') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                    @error('chiennes') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                    @error('chats') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                    @error('chattes') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                    @error('rongeurs') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                    @error('rongeuses') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                    @error('birds') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                    @error('reptiles') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                    @error('photo') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                    @error('age') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <!-- Fin messages d'erreur -->
                <form wire:submit.prevent="store">
                    <div class="overflow-hidden shadow sm:rounded-md mb-10 ">
                        <div class="space-y-6 bg-white px-4 py-5 sm:p-6">

                            @if($currentPage === 1)
                            <!-- Nom -->
                            <div>
                                <x-jet-label class="mb-1" for="name" value="{{ __('Nom de mon animal') }}" />
                                <input name="name" type="text" class="block w-64 rounded" wire:model="nom"/>
                            </div>

                            <!-- Photo de l'animal -->
                            <div>
                                <x-jet-label class="mb-1" for="photo" value="{{ __('Sa photo') }}" />
                                <input name="photo" type="file" id="photo" wire:model="photo"/>
                                <div wire:loading wire:target="photo" class="text-sm text-gray-500 italic">Chargement...</div>
                            </div> 

                            <!-- Age -->
                            <div>
                                <x-jet-label for="age" value="{{ __('Son âge') }}" class="pb-3"/>
                                    <select class="block px-3 py-1.5 text-base font-normal text-gray-700 
                                        bg-whiteborder border-solid border-gray-300 rounded transition ease-in-out m-0
                                        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                        id="age" wire:model="age" name="age">
                                            <option value="">Age de votre animal</option>
                                        @foreach($ages as $age) 
                                            <option value="{{$age->id}}">{{$age->age}}</option>    
                                        @endforeach
                                    </select>
                            </div>

                            <!-- Barre de selection espèces et races -->
                            <div>
                                <x-jet-label for="type" value="{{ __('Espèce de mon animal') }}" class="pb-3"/>
                                <div>
                                    <select class="block px-3 py-1.5 text-base font-normal text-gray-700 
                                                bg-whiteborder border-solid border-gray-300 rounded transition ease-in-out m-0
                                                focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                                                id="espece_id" wire:model="espece">
                                            <option value="">Choisir une espece</option>
                                        @foreach($especes as $espece)
                                            <option value="{{$espece->id}}">{{$espece->espece}}</option>    
                                        @endforeach
                                    </select>
                                </div>
                                @if($races->count() > 0)                                   
                                <div>    
                                        <select id="race_id" wire:model="race" 
                                                class="my-3 block px-3 py-1.5 text-base font-normal text-gray-700 
                                                    bg-white border border-solid border-gray-300 rounded transition ease-in-out m-0
                                                    focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                            <option value="">Choisir la race </option>
                                            @foreach($races as $race)   
                                            <option value="{{$race->id}}">{{$race->race_animal}}</option>
                                            @endforeach
                                        </select>  
                                </div>                              
                                @endif
                            </div>

                            <!-- Fin barre de selection espèces et races -->
                            
                            <div>
                                <x-jet-label for="personnality" value="{{ __('Sa personnalité') }}" />
                                <textarea name="personnality" type="text"  class="rounded mt-2 block w-full" wire:model="personnalité" placeholder="Décrivez en quelques mots votre animal pour informer le pet-sitter"></textarea>
                            </div>

                            @elseif($currentPage === 2)   
                            <h4 class="text-center font-semibold text-gray-600 text-sm underline">Votre animal s'entend bien avec : </h4>
                            <div>
                                <!-- CHIENS -->
                                <div class="flex items-start py-2 justify-around">
                                    <div class="flex ml-2">
                                        <div class="flex h-5 items-center">
                                            <x-jet-input wire:model="chiens" value="1" id="chiens mâles" name="chiens mâles" type="checkbox" class=" h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                                        </div>
                                        <div class="ml-2 text-sm">
                                            <x-jet-label for="chiens mâles" value="{{ __('Chiens mâles') }}"/>
                                        </div>
                                    </div>
                                    <div class="flex ml-2">
                                        <div class="flex h-5 items-center">
                                            <x-jet-input wire:model="chiennes" value="1" id="chiens femelles" name="chiens femelles" type="checkbox" class=" h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                                        </div>
                                        <div class="ml-2 text-sm">
                                            <x-jet-label for="chiens femelles" value="{{ __('Chiens femelles') }}"/>
                                        </div>
                                    </div>
                                </div>
                                <!-- CHATS -->
                                <div class="flex items-start py-2 justify-around">
                                    <div class="flex">
                                        <div class="flex h-5 items-center">
                                            <x-jet-input wire:model="chats" value="1" id="chats mâles" name="chats mâles" type="checkbox" class=" h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                                        </div>
                                        <div class="ml-2 text-sm">
                                            <x-jet-label for="chats mâles" value="{{ __('Chats mâles') }}"/>
                                        </div>
                                    </div>
                                    <div class="flex">
                                        <div class="flex h-5 items-center">
                                            <x-jet-input wire:model="chattes" value="1" id="chats femelles" name="chats femelles" type="checkbox" class=" h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                                        </div>
                                        <div class="ml-2 text-sm">
                                            <x-jet-label for="chats femelles" value="{{ __('Chats femelles') }}"/>
                                        </div>
                                    </div>
                                </div>
                                <!-- RONGEURS -->
                                <div class="flex items-start py-2 justify-around">
                                    <div class="flex ml-6">
                                        <div class="flex h-5 items-center">
                                            <x-jet-input wire:model="rongeurs" value="1" id="rongeurs mâles" name="rongeurs mâles" type="checkbox" class=" h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                                        </div>
                                        <div class="ml-2 text-sm">
                                            <x-jet-label for="rongeurs mâles" value="{{ __('Rongeurs mâles') }}"/>
                                        </div>
                                    </div>
                                    <div class="flex ml-6">
                                        <div class="flex h-5 items-center">
                                            <x-jet-input wire:model="rongeuses" value="1" id="rongeurs femelles" name="rongeurs femelles" type="checkbox" class=" h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                                        </div>
                                        <div class="ml-2 text-sm">
                                            <x-jet-label for="rongeurs femelles" value="{{ __('Rongeurs femelles') }}"/>
                                        </div>
                                    </div>
                                </div>
                                <!-- OISEAUX -->
                                <div class="flex items-start py-2 justify-center">
                                    <div class="flex h-5 items-center">
                                        <x-jet-input wire:model="birds" value="1" id="oiseaux" name="oiseaux" type="checkbox" class=" h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                                    </div>
                                    <div class="ml-2 text-sm mr-5">
                                        <x-jet-label for="oiseaux" value="{{ __('Oiseaux') }}"/>
                                    </div>
                                </div>
                                <!-- REPTILES -->
                                <div class="flex items-start py-2 justify-center">
                                    <div class="flex h-5 items-center">
                                        <x-jet-input wire:model="reptiles" value="1" id="reptiles" name="reptiles" type="checkbox" class=" h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                                    </div>
                                    <div class="ml-2 text-sm mr-5">
                                        <x-jet-label for="reptiles" value="{{ __('Reptiles') }}"/>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Boutons -->
                            <div class="flex items-center justify-between px-4 py-8 text-right sm:px-6 mx-8"> 
                                @if($currentPage === 1)
                                    <div></div>
                                @else
                                    <button wire:click='goToPreviousPages' type="button" id="buttonback">Retour</button>
                                @endif
                                @if ($currentPage === count($pages))
                                    <button type="submit" name="submit" id="buttonsubmit">Valider</button>
                                    <div wire:loading wire:target="submit" class="text-sm text-gray-500 italic">Chargement...</div>
                                @else
                                    <button wire:click="goToNextPages" type="button" id="buttonnext">Suivant</button>
                                @endif
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>


