<div> 
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-200 leading-tight text-center">
            {{ __('Modifier la fiche de mon animal') }}
        </h1>
    </x-slot>

    <x-slot name="buttonBack">
        @livewire('previous-page')
    </x-slot>

    <main class="bg-gray-100">
        <div class="py-5">
            <h2 class="text-center font-bold">Modifier la fiche de mon animal</h2>
        </div>
        <form wire:submit.prevent="update" 
            class="bg-white space-y-6 w-full max-w-full md:max-w-3xl mx-auto mb-12 px-4 py-10 rounded shadow-lg" enctype="multipart/form-data">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <p>Les champs obligatoires sont marqués par *</p>
            <!-- Info -->
            <h2 class="uppercase tracking-wide text-gray-700 text-md font-bold mt-4 mb-2">
            Profil de votre compagnon*
            </h2>
            <x-jet-button class="bg-orange-600" type="button" wire:click="oldValuesAnimals" >Remplir avec vos anciens champs</x-jet-button>
            <div class="flex flex-wrap -mx-3 mb-6">
                <!-- Name -->
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="nom">
                        Son nom*
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    type="text" id="nom" wire:model="nom">
                    @error('nom') <span class="italic block text-red-600 text-sm">{{ $message }}</span> @enderror
                    <p class="text-gray-600 text-xs italic"></p>
                </div>
                <!-- Photo -->
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="photo">
                        Sa photo*
                    </label>
                    <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="photo" wire:model="photo" type="file">
                    <div wire:loading wire:target="photo" class="text-sm text-gray-500 italic">Chargement...</div>
                    @error('photo') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <!-- Age -->
                <div class="w-full md:w-1/2 px-3 pb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                    for="age">
                        Son age *
                    </label>
                    <div class="relative">
                        <select id="age" wire:model="age" name="age" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">Age de votre animal</option>
                            @foreach($ages as $age) 
                                <option value="{{$age->id}}">{{$age->age}}</option>    
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                    @error('age') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <!-- Sexe -->
                <div class="w-full md:w-1/2 px-3 pb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                    for="sexe_id">
                        Son sexe
                    </label>
                    <div class="relative">
                        <select id="sexe_id" wire:model="sexe_id" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">Sexe de votre animal</option>
                            @foreach($sexes as $sexe) 
                                <option value="{{$sexe->id}}">{{$sexe->sexe}}</option>    
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                    @error('sexe_id') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                <!-- Race and speces -->
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                    for="espece_id">
                    Son espèce*
                    </label>
                    <div class="relative">
                        <select id="espece_id" wire:model="espece" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">Choisir une espece</option>
                            @foreach($especes as $espece)
                                <option value="{{$espece->id}}">{{$espece->espece}}</option>    
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                    @error('espece') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                @if($races->count() > 0)
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                    for="race_id">
                        Sa race*
                    </label>
                    <div class="relative">
                        <select id="race_id" wire:model="race" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="">Choisir la race </option>
                            @foreach($races as $race)   
                                <option value="{{$race->id}}">{{$race->race_animal}}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                        </div>
                    </div>
                    @error('race') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
                @endif
            </div>

            <!-- Personnalité -->
            <h2 class="uppercase tracking-wide text-gray-700 text-md font-bold mt-4 mb-2">
            Sa personnalité*
            </h2>
            <div class="flex flex-wrap -mx-3 mb-6">
                <div class="w-full px-3">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="personnality">
                        Décrivez sa personnalité
                    </label>
                    <textarea wire:model="personnalité" name="personnality" id="personnality" cols="30" rows="10"
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    </textarea>
                    @error('personnalité') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>   
            <!-- Checkbox -->
            <h2 class="uppercase tracking-wide text-gray-700 text-md font-bold mt-4 mb-2">
                Votre compagnon s'entend bien avec :
            </h2>
                <!-- CHIENS -->
                <div class="flex items-start py-2 justify-around">
                    <div class="flex ml-2">
                        <div class="flex h-5 items-center">
                            <x-jet-input wire:model="chiens" value="1" id="chiens mâles" name="chiens mâles" type="checkbox" class=" h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                        </div>
                        @error('chiens') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                        <div class="ml-2 text-sm">
                            <x-jet-label for="chiens mâles" value="{{ __('Chiens mâles') }}"/>
                        </div>
                    </div>
                    <div class="flex ml-2">
                        <div class="flex h-5 items-center">
                            <x-jet-input wire:model="chiennes" value="1" id="chiens femelles" name="chiens femelles" type="checkbox" class=" h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                        </div>
                        @error('chiennes') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
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
                        @error('chats') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                        <div class="ml-2 text-sm">
                            <x-jet-label for="chats mâles" value="{{ __('Chats mâles') }}"/>
                        </div>
                    </div>
                    <div class="flex">
                        <div class="flex h-5 items-center">
                            <x-jet-input wire:model="chattes" value="1" id="chats femelles" name="chats femelles" type="checkbox" class=" h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                        </div>
                        @error('chattes') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
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
                        @error('rongeurs') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                        <div class="ml-2 text-sm">
                            <x-jet-label for="rongeurs mâles" value="{{ __('Rongeurs mâles') }}"/>
                        </div>
                    </div>
                    <div class="flex ml-6">
                        <div class="flex h-5 items-center">
                            <x-jet-input wire:model="rongeuses" value="1" id="rongeurs femelles" name="rongeurs femelles" type="checkbox" class=" h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                        </div>
                        @error('rongeuses') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
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
                    @error('birds') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                    <div class="ml-2 text-sm mr-5">
                        <x-jet-label for="oiseaux" value="{{ __('Oiseaux') }}"/>
                    </div>
                </div>
                <!-- REPTILES -->
                <div class="flex items-start py-2 justify-center">
                    <div class="flex h-5 items-center">
                        <x-jet-input wire:model="reptiles" value="1" id="reptiles" name="reptiles" type="checkbox" class=" h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"/>
                    </div>
                    @error('reptiles') <span class="italic block mt-2 text-red-600 text-sm">{{ $message }}</span> @enderror
                    <div class="ml-2 text-sm mr-5">
                        <x-jet-label for="reptiles" value="{{ __('Reptiles') }}"/>
                    </div>
                </div>
            <button type="submit" class="button-perso inline-block md:px-6 py-2.5 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out w-full mb-3">
            Enregistrer
            </button>
        </form>
    </main>
</div> 


