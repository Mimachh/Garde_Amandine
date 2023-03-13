
<main class="md:mx-10 mt-10">

<!-- La garde -->
    <div class="mt-10 sm:mt-0 md:mx-10">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Vos critères </h3>
            <p class="mt-1 text-sm text-gray-600">A l'exception du nombre de visites, les autres champs sont obligatoires.</p>
        </div>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0">
        <form wire:submit.prevent="store">
            <div class="overflow-hidden shadow sm:rounded-md">
            <div class="bg-white px-4 py-5 sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                    <!-- Type de garde -->
                        <div class="col-span-6 sm:col-span-3">
                            <label for="last-name" class="block text-sm font-medium text-gray-700">Type de garde</label>
                            <select id="gardeType" wire:model='garde_id' class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                <option value="">--Choisissez un type de garde--</option>
                                @foreach($gardes as $g) 
                                    <option value="{{ $g->id }}">{{ $g->garde }}</option>
                                @endforeach
                            </select>
                            @error('garde_id') <span class="error mt-2 text-red-600 text-sm">{{$message}}</span> @enderror
                        </div>
                    

                        <div class="col-span-6 sm:col-span-3">
                            
                        </div>

                        <div id="numberDiv" class="col-span-6 sm:col-span-6">
                            <label  class="block text-sm font-medium text-gray-700" for="number_visit">
                                Nombre de <span id="visitOrAway"></span> par jour : 
                            </label>
                            <select wire:model="number_visit" name="number_visit" id="number_visit">
                                <option value=""> -- </option>
                                <option value="1"> 1 </option>
                                <option value="2"> 2 </option>
                                <option value="3"> 3 </option>
                            </select>
                            @error('number_visit') <span class="error mt-2 text-red-600 text-sm">{{$message}}</span> @enderror    
                        </div>
                    <!-- Fin garde -->

                    <!-- Date -->
                        <div class="col-span-6 sm:col-span-6 lg:col-span-3">
                            <label for="start_watch" class="block text-sm font-medium text-gray-700">Du : </label>
                            <x-jet-input id="start_date" wire:model="start_date" name="start_date" type="date"/>
                            @error('start_date') <span class="block error mt-2 text-red-600 text-sm">{{$message}}</span> @enderror 
                        </div>

                        <div class="col-span-6 sm:col-span-3 lg:col-span-3">
                            <label for="sendwatch" class="block text-sm font-medium text-gray-700">Au : </label>
                            <x-jet-input id="end_date" wire:model="end_date" name="end_date" type="date"/> 
                            @error('end_date') <span class="block error mt-2 text-red-600 text-sm">{{$message}}</span> @enderror 
                        </div>
                    <!-- Fin date -->

                </div>
            </div>
            </div>
        </div>
    </div>
    </div>
<!-- Fin de la garde -->

    <div class="hidden sm:block" aria-hidden="true">
    <div class="py-5">
        <div class="border-t border-gray-200"></div>
    </div>
    </div>

<!-- Les animaux -->
        <div class="mt-10 sm:mt-0 sm:mx-10">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Vos animaux à garder</h3>
                        <p class="mt-1 text-sm text-gray-600">Vous pouvez en ajouter 3 maximums. Si vous avez besoin de garder davantage d'animaux nous vous conseillons de réaliser une demande supplémentaire.</p>
                    </div>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0">
                        <div class="overflow-hidden shadow sm:rounded-md">
                        <div class="bg-white px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
            
                                    <div class="col-span-6 sm:col-span-3 space-y-5">
                                    @if(auth()->user()->animals->count() > 0)
                                        <div>
                                            <label for="first_animal_id" class="block text-sm font-medium text-gray-700">Votre animal à garder</label>
                                            <select wire:model='first_animal_id' class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                <option value="">--Choisissez l'animal à garder--</option>
                                                @foreach(auth()->user()->animals as $animal) 
                                                    <option value="{{ $animal->id }}">{{ $animal->animal_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('first_animal_id') <span class="error mt-2 text-red-600 text-sm">{{$message}}</span> @enderror 
                                        </div>
                                        <div x-data="{ open: false }">
                                            <label for="second_animal_id" class="block text-sm font-medium text-gray-700">
                                                <button type="button" x-on:click="open = ! open"> Ajouter un deuxième animal</button>
                                            </label>
                                            <select x-show="open" wire:model='second_animal_id' class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                <option value="">--Choisissez l'animal à garder--</option>
                                                @foreach(auth()->user()->animals as $animal) 
                                                    <option value="{{ $animal->id }}">{{ $animal->animal_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('second_animal_id') <span class="error mt-2 text-red-600 text-sm">{{$message}}</span> @enderror 
                                        </div>
                                        <div x-data="{ open: false }">
                                            <label for="third_animal_id" class="block text-sm font-medium text-gray-700">
                                                <button type="button" x-on:click="open = ! open"> Ajouter un troisième animal </button>
                                            </label>
                                            <select x-show="open" wire:model='third_animal_id' class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                                <option value="">--Choisissez l'animal à garder--</option>
                                                @foreach(auth()->user()->animals as $animal) 
                                                    <option value="{{ $animal->id }}">{{ $animal->animal_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('third_animal_id') <span class="error mt-2 text-red-600 text-sm">{{$message}}</span> @enderror 
                                        </div>
                                    @endif
                                        <p class="mt-2 text-sm font-medium text-gray-700">Vous pouvez ajouter un animal en cliquant <a class="text-blue-600" href="{{ route('animals.create') }}">ici.</a></p> 
                                    </div>
                            </div>
                        </div>

                        </div>
                </div>
            </div>
        </div>
<!-- Fin des animaux -->

    <div class="hidden sm:block" aria-hidden="true">
    <div class="py-5">
        <div class="border-t border-gray-200"></div>
    </div>
    </div>

<!-- Les infos -->
    <div class="mt-10 sm:mt-0 sm:mx-10">
    <div class="md:grid md:grid-cols-3 md:gap-6">
        <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Vos informations</h3>
            <p class="mt-1 text-sm text-gray-600">Pour permettre au Pet-Sitter de vous contacter nous lui fournissons l'adresse mail que vous avez
                renseigné à l'inscription. Vous pouvez aussi laisser votre numéro de téléphone pour qu'il vous appelle.
            </p>
        </div>
        </div>
        <div class="mt-5 md:col-span-2 md:mt-0">

            <div class="overflow-hidden shadow sm:rounded-md">
            <div class="bg-white px-4 py-5 sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                    <!-- Telephone -->
                        <div class="col-span-6 sm:col-span-4">
                            <label for="phone" class="block text-sm font-medium text-gray-700">Votre numéro de téléphone</label>
                            <input wire:model="phone" type="text" name="phone" id="phone" autocomplete="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            @error('phone') <span class="error mt-2 text-red-600 text-sm">{{$message}}</span> @enderror 
                        </div>
                    <!-- Fin telephone -->
                </div>
            </div>

            
            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                <button type="submit" class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Envoyer</button>
            </div>
            </div>
        </form>
        </div>
    </div>
    </div>
<!-- Fin des infos -->

    <div class="hidden sm:block" aria-hidden="true">
    <div class="py-5">
        <div class="border-t border-gray-200"></div>
    </div>
    </div>

    <script>
        let gardeType = document.querySelector('#gardeType');
        let text = document.querySelector('#visitOrAway');
        let numberDiv = document.getElementById('numberDiv');

        gardeType.addEventListener("change", (event) => {
            const result = `${event.target.value}`;
            if (result == 1)
            {
                console.log(1)
                numberDiv.classList.remove('hidden');
                text.innerHTML = 'sortie';
            }
          
        });
</script>
</main>