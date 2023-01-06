<div class="py-8">
    @livewire('previous-page')  
        <div class=" sm:px-6 lg:px-8 opacity-90">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Boutons -->
                
                
                <div class="flex justify-around">  
                
                    @if($currentPage === 1)
                        <button type="button" wire:click='goToPageAds'><h2 class="ml-5 mt-5 font-semibold text-lg text-blue-800">Mes annonces ({{auth()->user()->ads->count()}})</h2></button>
                        @else()
                        <button class="bg-blue" type="button" wire:click='goToPageAds'><h2 class=" ml-5 mt-5 font-semibold text-lg text-gray-800">Mes annonces ({{auth()->user()->ads->count()}})</h2></button>
                    @endif

                    @if($currentPage === 2)
                        <button type="button"  wire:click='goToPageFav'><h2 class="ml-5 mt-5 font-semibold text-lg text-blue-800" >Mes favoris ({{auth()->user()->fav->count()}})</h2></button>
                        @else()
                        <button type="button" class="bg-blue" wire:click='goToPageFav'><h2 class="ml-5 mt-5 font-semibold text-lg text-gray-800" >Mes favoris ({{auth()->user()->fav->count()}})</h2></button>
                    @endif
                    
                    
                    @if($currentPage === 3)
                        <button type="button" wire:click='goToPageAnim'><h2 class="ml-5 mt-5 font-semibold text-lg text-blue-800">Mes animaux</h2></button>
                        @else()
                        <button type="button" wire:click='goToPageAnim'><h2 class="ml-5 mt-5 font-semibold text-lg text-gray-800">Mes animaux</h2></button>
                    @endif

                    @if($currentPage === 4)
                        <button type="button" wire:click='goToPageMess'><h2 class="ml-5 mt-5 font-semibold text-lg text-blue-800">Mes messages</h2></button>
                        @else()
                        <button type="button" wire:click='goToPageMess'><h2 class="ml-5 mt-5 font-semibold text-lg text-gray-800">Mes messages</h2></button>
                    @endif              
                </div>
                <hr class="my-5 mx-5 border border-2 border-gray-400">
                <div>            
                    <!-- Page de mes annonces --> 
                    @if($currentPage === 1)
                        <a href="{{ route('annonces.create') }}" class="mb-3 ml-5 text-blue-600">
                            Ajouter une nouvelle annone 
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2563EB" class="inline w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                        </a>      
                        @forelse($ads as $annonce)
                            <div class="px-3 py-5 mb-3 mr-4 md:mr-32 ml-5 mt-4 shadow-sm hover:shadow-md rounded border border-gray-200">    
                                <div class="flex justify-between">
                                    <h2 class="text-md font-bold text-gray-600 mb-2">{{$annonce->name}}</h2>
                                    
                                    <div class="flex md:justify-end mb-3 pr-10">
                                        <a class="text-sm pr-10 items-center" href="{{ route('annonces.edit', $annonce) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-5 inline">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                            <p class="inline text-green-700">Modifier mon annonce</p>
                                        </a> 
                                        <button wire:click.prevent="deleteConfirmation( {{ $annonce->id }} )" type="button" class="text-sm pr-10 items-center text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-5 h-5 inline-block">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Supprimer mon annonce
                                        </button>
                                    </div>
                                </div>

                                @if($annonce->start_watch && $annonce->end_watch !== null)
                                    <div class="flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                        </svg>
                                        <p class="text-sm text-gray-600 pb-3 pl-1">
                                            Disponible du : <span class="text-md text-gray-800">{{date('d/m/Y', strtotime($annonce->start_watch))}}</span>  
                                            au : <span class="text-md text-gray-800">{{date('d/m/Y', strtotime($annonce->end_watch))}}</span>
                                        </p>
                                    </div>
                                @endif
                                <!-- Ville -->
                                @if($annonce->ville_id !== null)
                                    <div class="flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="blue" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                                        </svg>
                                        <p class="text-sm text-gray-600 pl-1 pb-3"><span class="text-md text-gray-800"> Ville : {{ $annonce->ville->ville_nom }}</span></p>    
                                    </div>
                                @endif
                                <!--Fin ville -->
                                @if($annonce->garde !== null)        
                                <p class="text-sm text-gray-600 pb-2">Type de garde : <span class="text-sm text-gray-800">
                                    {{ $annonce->garde->garde }}</span>  
                                </p>
                                @endif          
                                <p class="text-sm text-gray-600">Animaux gardés :  </p>
                                <ul class="text-sm text-gray-800 pb-2">
                                    <li class="pb-1">{{ $annonce->chats ? 'Chats' : ''}}</li>
                                    <li class="pb-1">{{ $annonce->chiens ? ' Chiens' : ''}} </li>
                                    <li class="pb-1">{{ $annonce->poissons ? ' Poissons' : ''}}</li>
                                    <li class="pb-1">{{ $annonce->rongeurs ? ' Rongeurs' : ''}}</li>
                                    <li class="pb-1">{{ $annonce->oiseaux ? ' Oiseaux' : ''}}</li>                                <li class="pb-1">{{ $annonce->reptiles ? ' Reptiles' : ''}}</li>                                    <li class="pb-1">{{ $annonce->ferme ? ' Animaux de la ferme' : ''}}</li>
                                </ul>    
                                <p class="text-sm text-gray-600 pb-2">Prix : <span class="text-sm text-gray-800">{{ $annonce->getPrice() }} /jour.</span></p>     
                                <div class="flex justify-between">

                                    <div class="flex items-center">
                                        <span class="h-2 w-2 bg-green-600 rounded-full mr-1"></span>
                                        <a class="text-sm" href="{{ route('annonces.show', $annonce) }}">Voir mon annonce</a>
                                    </div>

                                    <div class=" my-4">
                                        <p class="text-sm text-black mr-12 pr-5">Demandes de garde reçues ({{ $annonce->proposals->count() }})</p>
                                        @if($annonce->proposals->count() > 0)
                                        <a class="text-sm text-green-700" href="{{ route('proposals.index') }}">Voir les demandes</a>
                                        @endif
                                    </div>
                                </div>
                                                                        
                            </div>                          
                        @empty
                            <div class="px-3 py-5 mb-3 mr-4 md:mr-32 lg:mr-32 ml-5">
                                <div class="flex justify-between pb-2">
                                    <p class="text-md font-normal text-gray-800">Vous n'avez aucune annonce active pour l'instant. Vous pouvez en poster une en cliquant <a class="text-blue-600" href="{{ route('annonces.create') }}">ici.</a></p>
                                </div>
                            </div>          
                        @endforelse
                    @endif
                    </div> 
                <div>
                        <!-- Page de Favoris -->   
                    @if($currentPage === 2)
                        @forelse($favs as $annonce)
                            <div class="px-3 py-5 mb-3 mr-4 md:mr-32 lg:mr-32 ml-5 shadow-sm hover:shadow-md rounded border border-gray-200">
                            <div class="flex justify-between pb-2">
                                <h2 class="text-md font-bold text-gray-600">{{$annonce->name}}</h2>
                                <div class="flex items-center">
                                    <livewire:ad-fav :annonce="$annonce">
                                    <div>
                                        ({{$annonce->fav->count()}})
                                    </div>
                                </div>
                            </div>
                                @if($annonce->start_watch && $annonce->end_watch !== null)
                                    <div class="flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                        </svg>
                                        <p class="text-sm text-gray-600 pb-3 pl-1">
                                            Disponible du : <span class="text-md text-gray-800">{{date('d/m/Y', strtotime($annonce->start_watch))}}</span>  
                                            au : <span class="text-md text-gray-800">{{date('d/m/Y', strtotime($annonce->end_watch))}}</span>
                                        </p>
                                    </div>
                                @endif    
                                <!-- Ville -->
                                @if($annonce->ville_id !== null)
                                    <div class="flex">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="blue" class="w-4 h-4">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                                        </svg>
                                        <p class="text-sm text-gray-600 pl-1 pb-3"><span class="text-md text-gray-800"> Ville : {{ $annonce->ville->ville_nom }}</span></p>    
                                    </div>
                                @endif
                                <!--Fin ville --> 
                                @if($annonce->garde !== null)        
                                <p class="text-sm text-gray-600 pb-2">Type de garde : <span class="text-sm text-gray-800">
                                    {{ $annonce->garde->garde }}</span>  
                                </p>
                                @endif   
                            <p class="text-sm text-gray-600">Animaux gardés :  </p>
                                <ul class="text-sm text-gray-800 pb-2">
                                    <li class="pb-1">{{ $annonce->chats ? 'Chats' : ''}}</li>
                                    <li class="pb-1">{{ $annonce->chiens ? ' Chiens' : ''}} </li>
                                    <li class="pb-1">{{ $annonce->poissons ? ' Poissons' : ''}}</li>
                                    <li class="pb-1">{{ $annonce->rongeurs ? ' Rongeurs' : ''}}</li>
                                    <li class="pb-1">{{ $annonce->oiseaux ? ' Oiseaux' : ''}}</li>
                                    <li class="pb-1">{{ $annonce->reptiles ? ' Reptiles' : ''}}</li>
                                    <li class="pb-1">{{ $annonce->ferme ? ' Animaux de la ferme' : ''}}</li>
                                </ul> 
                            <p class="text-sm text-gray-600 pb-2">Prix : <span class="text-sm text-gray-800">{{ $annonce->getRealPrice() }}/ jour.</span></p>     
                            <div class="flex items-center">
                                <span class="h-2 w-2 bg-green-600 rounded-full mr-1"></span>
                                <a class="text-sm" href="{{ route('annonces.show', $annonce) }}">Voir l'annonce</a>
                            </div> 
                            </div>
                        @empty
                            <div class="px-3 py-5 mb-3 mr-4 md:mr-32 lg:mr-32 ml-5">
                                <div class="flex justify-between pb-2">
                                    <p class="text-md font-normal text-gray-800">Vous n'avez aucun favori pour l'instant. Vous pouvez trouver l'annonce adéquate en cliquant <a class="text-blue-600" href="{{ route('annonces.index') }}">ici.</a></p>
                                </div>
                            </div>    
                        @endforelse
                    @endif
                </div>

                <div>

                        <!-- Page des animaux -->
                    @if($currentPage === 3)
                        <a href="{{ route('animals.create') }}" class="mb-3 ml-5 text-blue-600 text-blue-600">
                            Ajouter une nouvelle fiche animal
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2563EB" class="inline w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>

                        </a>
                        @forelse($animals as $animal)
                            <div class="px-3 py-5 mb-3 mt-4 mr-4 md:mr-32 ml-5 shadow-sm hover:shadow-md rounded border border-gray-200">    
                                <div class="flex justify-between">
                                    <h2 class="text-md font-bold text-gray-600 mb-2">{{$animal->animal_name}}</h2>
                                        
                                    <div class="flex md:justify-end mb-3 pr-10">
                                        <a class="text-sm pr-10 items-center" href="{{ route('animals.edit', $animal) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-5 inline">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                            </svg>
                                            <p class="inline text-green-700">Modifier la fiche de {{$animal->animal_name}}</p>
                                        </a>
                                       
                                        <button wire:click="deleteConfirmationAnimal( {{ $animal->id }} )" type="button" class="text-sm pr-10 items-center text-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-5 h-5 inline-block">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Supprimer la fiche
                                        </button>          
                                    </div>
                                </div>
                                <div class="flex items-center">
                                    <span class="h-2 w-2 bg-green-600 rounded-full mr-1"></span>
                                    <a class="text-sm" href="{{ route('animals.show', $animal) }}">Voir la fiche {{ $animal->animal_name }}</a>
                                </div>    
                            </div>
                        @empty
                            <div class="px-3 py-5 mb-3 mr-4 md:mr-32 lg:mr-32 ml-5">
                                <div class="flex justify-between pb-2">
                                    <p class="text-md font-normal text-gray-800">Vous n'avez aucune fiche pour vos animaux pour l'instant. Vous pouvez en créer une en cliquant <a class="text-blue-600" href="{{ route('animals.create') }}">ici.</a></p>
                                </div>
                            </div>
                        @endforelse                      
                    @endif
                </div>
            </div>            
        </div>                    
</div>

