<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-200 leading-tight text-center">
            Fiche de {{$animal->animal_name}}
        </h1>
    </x-slot>
    
    <x-slot name="buttonBack">
        @livewire('previous-page')
    </x-slot>

<div class="pb-5">
    <div class="grid grid-cols-3 gap-4 mx-10 my-10 border rounded shadow hover:shadow-lg">
        <div class=" col-span-3 md:col-span-1 mx-auto">       
            <div class="mx-2 my-2 aspect-w-1 aspect-h-1 overflow-hidden xl:aspect-w-3 xl:aspect-h-4 ">
                <img class="h-80 w-80 rounded-lg object-cover object-center group-hover:opacity-75 " src="{{ asset('storage/animals_photos/' . $animal->photo) }}"">
            </div>
        </div>
        <!-- Partie description annonce -->
            <div class="md:col-span-2 col-span-3 pl-5">
                <div class="flex justify-between mt-4 mb-4 mr-10"> 

                    <h2 class="text-xl text-bold text-gray-700">{{ $animal->animal_name }}</h2>

                    <div class="flex md:justify-end mb-3 pr-10">
                        @can('update', $animal)    
                        <a class="text-sm pr-10 items-center" href="{{ route('animals.edit', $animal) }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-5 inline">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>
                            <p class="inline text-green-700">Modifier la fiche</p>
                        </a>
                        @endcan
                        @can('delete', $animal) 
                        <livewire:animals.delete-animal-comp :animal="$animal" />
                        @endcan
                    </div>                                            
                </div>
                <div class="mb-2 space-y-1">
                    <p class="text-gray-700">Je fais parti des {{$animal->espece->espece}}</p> 
                    <p class="text-gray-700">Je suis un {{$animal->race->race_animal}}</p>
                </div>
                <!-- Personnalité -->
                    <label for="personnality" class="my-1 font-medium text-gray-600 mt-6">Ma personnalité :</label> 
                    <p class="text-gray-800 mb-5" id="personnality" name="personnality">{{ $animal->personnality }} </p>
                <!-- Fin personnalité -->

                <!-- Age -->
                    <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="blue" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mt-1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.87c1.355 0 2.697.055 4.024.165C17.155 8.51 18 9.473 18 10.608v2.513m-3-4.87v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.38a48.474 48.474 0 00-6-.37c-2.032 0-4.034.125-6 .37m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.17c0 .62-.504 1.124-1.125 1.124H4.125A1.125 1.125 0 013 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 016 13.12M12.265 3.11a.375.375 0 11-.53 0L12 2.845l.265.265zm-3 0a.375.375 0 11-.53 0L9 2.845l.265.265zm6 0a.375.375 0 11-.53 0L15 2.845l.265.265z" />
                        </svg>
                        <label for="age" class="ml-2 my-1 font-medium text-gray-600 ">Mon âge :</label>   
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
    
                                Je m'entend bien avec
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

                            @if($animal->male_cats === 1)
                                <div class="flex">
                                    <p class="text-gray-800 mr-2">Chats mâles</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @endif
                            @if($animal->female_cats === 1)
                                <div class="flex">
                                    <p class="text-gray-800 mr-2">Chats femelles</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @endif

                            @if($animal->male_rongeurs === 1)
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
                <!-- Fin s'entend bien avec -->

            </div>
        <!-- Fin partie description annonce -->
    </div>        
</div>
</x-app-layout>