<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-200 leading-tight text-center">
            Annonce de {{$annonce->name}}
        </h1>
    </x-slot>
    
    <x-slot name="buttonBack">
        @livewire('previous-page')
    </x-slot>
    
<div class="pb-5">
    <div class="grid grid-cols-3 gap-4 sm:mx-10 my-10 border rounded shadow hover:shadow-lg">
        <div class=" col-span-3 md:col-span-1 mx-auto">       
            <div class="mx-2 my-2 aspect-w-1 aspect-h-1 overflow-hidden xl:aspect-w-3 xl:aspect-h-4">
                <img class="h-80 w-80 rounded-lg object-cover object-center group-hover:opacity-75 " src="{{ asset('storage/annonces_photos/' . $annonce->photo) }}">
            </div>
        </div>
        <!-- Partie description annonce -->
            <div class=" md:col-span-2 col-span-3 pl-5">

                <div class="flex">
                    @can('update', $annonce)
                        <div class="md:justify-end mb-3 pr-10 mt-4">
                            <a class="text-sm pr-10 items-center"  href="{{ route('annonces.edit', $annonce) }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-5 inline">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                                <p class="inline text-green-700">Modifier mon annonce</p>
                            </a> 
                        </div>      
                    @endcan
                            
                    @can('delete', $annonce)
                        <div class="md:justify-end mb-3 pr-10 mt-4">
                            <livewire:annonces.delete-annonce-comp :annonce="$annonce">
                        </div>  
                    @endcan
                </div>

                <div class="flex justify-between mt-4 mb-4 mr-10"> 
                    <h2 class="text-xl text-bold text-gray-700">Je m'appelle {{ $annonce->name }}</h2>                               
                    @if($annonce->user_id !== auth()->user()->id)
                    <div class="flex items-end">
                        <livewire:ad-fav :annonce="$annonce">
                        @if($annonce->fav->count() > 0)
                            <div>
                                ({{$annonce->fav->count()}})
                            </div>
                        @endif
                    </div>
                    @endif
                                                              
                </div>
                
                <!-- Dispo -->
                    @if($annonce->start_watch && $annonce->end_watch !== null)
                        <div class="flex text-md">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                            </svg>
                            <p class="text-gray-600 pb-3 pl-4">
                                Je suis disponible du : <span class=" text-gray-800">{{ $annonce->start_date_fr() }}</span>  
                                au : <span class="text-gray-800">{{ $annonce->end_date_fr() }}</span>
                            </p>
                        </div>
                    @endif
                <!-- Fin dispo -->

                <!-- Ville -->
                    @if($annonce->ville_id !== null)
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="blue" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                            </svg>
                            <p class="text-gray-600 pl-4 pb-3">J'habite : <span class="text-gray-800"> {{ $annonce->ville->ville_nom_reel }}</span></p>    
                        </div>
                    @endif
                <!--Fin ville -->

                <!-- Type de garde -->
                    <div x-data="{ open: false }" class="mb-4">
                        <button x-on:click="open = ! open" class="text-gray-600 pb-2">
                            Mon type de garde 
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-5 h-5 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg> 
                        </button>              
                        <div x-cloak x-show="open" x-transition class="mt-1 space-y-2">
                            <div class="flex">
                                <p class="mr-2 text-gray-800">{{$annonce->garde->garde}}</p>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            @if($annonce->habitation_id !== 3)
                                <div class="flex">
                                    <p class="text-gray-800 mr-2">{{$annonce->habitation->hab}}</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @endif
                            @if($annonce->exterieur_id !== 3)
                                <div class="flex">
                                    <p class="text-gray-800 mr-2">{{$annonce->exterieur->ext}}</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @endif       
                        </div>
                    </div>
                <!-- Fin type de garde -->

                <!-- Animaux gardés -->
                    <div x-data="{ open: false }" class="mb-2">
                        <button x-on:click="open = ! open" class="text-gray-600 pb-2">
                            Je garde 
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-5 h-5 ml-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg> 
                        </button>
                        <!--                                   
                        <p class="text-gray-800 mb-5">{{ $annonce->chats ? 'Chats' : ''}}
                            {{ $annonce->chiens ? ' Chiens' : ''}} 
                            {{ $annonce->poissons ? ' Poissons' : ''}}
                            {{ $annonce->rongeurs ? ' Rongeurs' : ''}} 
                            {{ $annonce->oiseaux ? ' Oiseaux' : ''}} 
                            {{ $annonce->reptiles ? ' Reptiles' : ''}} 
                            {{ $annonce->ferme ? ' Animaux de la ferme' : ''}}
                        </p>
                        -->
                        <div x-cloak x-show="open" x-transition class="mt-1 space-y-1">
                            @if(isset($watches[0]))
                                @foreach($watches as $watch)
                                    @if(isset($watch[0]))
                                        <div class="flex">
                                            <p class="mr-2">{{$watch[0]['espece']}}</p>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>         
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>
                <!-- Fin animaux gardés -->

                <label for="description" class="my-1 font-medium text-gray-600 mt-6">Me concernant :</label> 
                <p class="text-gray-800 mb-5" id="description" name="description">{{ $annonce->description }}</p>
                                                          
                <div class="flex text-md">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="gray" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 7.756a4.5 4.5 0 100 8.488M7.5 10.5h5.25m-5.25 3h5.25M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <label for="prix" class=" text-md font-medium text-gray-600 "> Mon tarif : </label>
                    <p class="font-medium text-gray-900 pb-3 ml-2" id="prix" name="prix">
                        @auth
                            @if($annonce->user_id !== auth()->user()->id)
                                {{ $annonce->getRealPrice() }} / jour
                            @else
                                {{ $annonce->getPrice() }} / jour
                            @endif
                        @endauth    
                        @guest
                            {{ $annonce->getRealPrice() }} / jour
                        @endguest
                    </p>  
                </div>

                <!-- Bouton contact -->
                    @if($annonce->user_id !== auth()->user()->id)
                    <div class=" text-center md:text-start my-5">
                        <x-jet-button type="button" class="bg-blue-600"><a href="{{route('demandes.create', $annonce->id)}}">Contacter</a></x-jet-button>   
                    </div>                                       
                    @endif 
                <!-- Fin bouton contact -->

            </div>
        <!-- Fin partie description annonce -->
    </div>
       

        <!-- Animaux -->
        <div class="col-span-3 text-center">
            <h3 class="text-green-700 font-bold text-3xl pb-2">Je vous présente mes animaux </h3>
        </div>
        @if(auth()->user()->id === $annonce->user_id)
            <p class="ml-10 mt-2">Ajouter un animal en cliquant <a class="text-blue-600" href="{{ route('animals.create') }}">ici.</a></p> 
        @endif
        @forelse($animals as $animal)
            <div class="grid grid-cols-3 gap-4 sm:mx-10 my-10 border rounded shadow hover:shadow-lg">
                <div class="pr-5 md:col-span-2 col-span-3 ml-4">

                    <!-- Plaque d'immat -->
                        <!-- 
                        <div class="grid place-items-center pt-1">
                            <div class="rounded-lg bg-white shadow-md hover:shadow-xl">
                                <div class="flex w-full rounded-lg border-4 border-black bg-yellow-500 shadow">
                                    <label class="flex flex-col justify-between bg-blue-700 rounded-l p-4 text-2xl font-bold text-white">
                                        <img class="h-4" src="https://cdn.cdnlogo.com/logos/e/51/eu.svg" />
                                        <small class="text-xs text-center py-1">{{ $animal->espece->espece }}</small>
                                        <small class="text-xs text-center">{{ $animal->race->race_animal}}</small>
                                    </label>
                                    <label class="p-4 font-mono text-5xl font-medium">{{$animal->animal_name}}</label>
                                </div>
                            </div>
                        </div>
                        -->
                    <!-- Fin plaque -->

                    <!-- Nom -->
                        <div class="flex">
                            @can('update', $animal)
                                <div class="flex md:justify-end mb-3 pr-2 mt-2">
                                    <a class="text-sm pr-10 items-center" href="{{ route('animals.edit', $animal) }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-5 inline">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                        </svg>
                                        <p class="inline text-green-700">Modifier la fiche</p>
                                    </a>
                                </div> 
                            @endcan

                            @can('delete', $animal)
                                <div class="flex md:justify-end mb-3 pr-2 mt-2">
                                    <livewire:animals.delete-animal-comp :animal="$animal">
                                </div>
                            @endcan
                        </div>
                        <h2 class="text-xl text-bold text-gray-700">Voici {{ $animal->animal_name }}</h2>                                                                 
                        <div class="mt-4 mb-4 mr-10 space-y-1">       
                            <p class="ml-2 text-gray-700">{{$animal->espece->espece}}</p>
                            <p class="ml-2 text-gray-700">{{$animal->race->race_animal}}</p>                                                                         
                        </div>
                        
                    <!-- Fin Nom -->

                    <!-- Personnalité -->
                        <label for="personnality" class="my-1 font-medium text-gray-600 mt-6">Sa personnalité :</label> 
                        <p class="text-gray-800 mb-5" id="personnality" name="personnality">{{ $animal->personnality }} </p>
                    <!-- Fin personnalité -->

                    <!-- Age -->
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="blue" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mt-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.87c1.355 0 2.697.055 4.024.165C17.155 8.51 18 9.473 18 10.608v2.513m-3-4.87v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.38a48.474 48.474 0 00-6-.37c-2.032 0-4.034.125-6 .37m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.17c0 .62-.504 1.124-1.125 1.124H4.125A1.125 1.125 0 013 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 016 13.12M12.265 3.11a.375.375 0 11-.53 0L12 2.845l.265.265zm-3 0a.375.375 0 11-.53 0L9 2.845l.265.265zm6 0a.375.375 0 11-.53 0L15 2.845l.265.265z" />
                            </svg>
                            <label for="age" class="ml-2 my-1 font-medium text-gray-600 ">Son âge :</label>   
                        </div> 
                        <p class="text-gray-800 mb-5" id="age" name="age"> {{ $animal->age->age}}</p>
                    <!-- Fin age -->

                    <!-- S'entend bien avec -->
                        <div x-data="{ open: false }">
                            
                            <h2 for="like" class="my-1 font-medium text-gray-600 mt-6 mb-2">
                            <button x-on:click="open = ! open">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="green" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="inline w-5 h-5 mb-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.182 15.182a4.5 4.5 0 01-6.364 0M21 12a9 9 0 11-18 0 9 9 0 0118 0zM9.75 9.75c0 .414-.168.75-.375.75S9 10.164 9 9.75 9.168 9 9.375 9s.375.336.375.75zm-.375 0h.008v.015h-.008V9.75zm5.625 0c0 .414-.168.75-.375.75s-.375-.336-.375-.75.168-.75.375-.75.375.336.375.75zm-.375 0h.008v.015h-.008V9.75z" />
                                    </svg>
    
                                    S'entend bien avec
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="inline w-5 h-5 ml-2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>
                            </h2>
                            <div x-cloak x-show="open" x-transition class="space-y-2 mb-4 ml-2 md:pr-6"> 
                                @if($animal->male_dogs === 1)
                                    <div class="flex">
                                        <p class="text-gray-800 mr-2">Chiens mâles</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                @endif

                                @if($animal->female_dogs === 1)
                                    <div class="flex">
                                        <p class="text-gray-800 mr-2">Chiens femelles</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                @endif

                                @if($animal->male_cats  === 1)
                                    <div class="flex">
                                        <p class="text-gray-800 mr-2">Chats mâles</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                @endif

                                @if($animal->female_cats  === 1)
                                    <div class="flex">
                                        <p class="text-gray-800 mr-2">Chats femelles</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                @endif

                                @if($animal->male_rongeurs  === 1)
                                    <div class="flex">
                                        <p class="text-gray-800 mr-2">Rongeurs mâles</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                @endif

                                @if($animal->female_rongeurs === 1)
                                    <div class="flex">
                                        <p class="text-gray-800 mr-2">Rongeurs femelles</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                @endif

                                @if($animal->birds === 1)
                                    <div class="flex">
                                        <p class="text-gray-800 mr-2">Oiseaux</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                @endif

                                @if($animal->reptiles === 1)
                                    <div class="flex">
                                        <p class="text-gray-800 mr-2">Reptiles</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>
                    <!-- S'entend bien avec -->
                </div>
            
                <div class="col-span-3 md:col-span-1 mx-auto">
                    <div class="mx-2 my-2 aspect-w-1 aspect-h-1 overflow-hidden xl:aspect-w-3 xl:aspect-h-4">
                        <img class="h-80 w-80 rounded-lg object-cover object-center group-hover:opacity-75" src="{{ asset('storage/animals_photos/' . $animal->photo) }}">
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center">
                <small class="text-lg text-blue-900">Aucun animal renseigné.
                </small>       
            </div>
        @endforelse 
         
</div>
</x-app-layout>