              

    <div class="py-8">
    @livewire('previous-page') 
        <div class=" sm:px-6 lg:px-8 opacity-90">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- Boutons -->

                <div class="flex justify-around">  
                
                    @if($currentPage === 1)
                        <button type="button" wire:click='goToPageGardNoValidated'><h2 class="ml-5 mt-5 font-semibold text-lg text-blue-800">Mes gardes non validées</h2></button>
                        @else()
                        <button class="bg-blue" type="button" wire:click='goToPageGardNoValidated'><h2 class=" ml-5 mt-5 font-semibold text-lg text-gray-800">Mes gardes non validées</h2></button>
                    @endif

                    @if($currentPage === 2)
                        <button type="button"  wire:click='goToPageGardValidated'><h2 class="ml-5 mt-5 font-semibold text-lg text-blue-800" >Mes gardes validées</h2></button>
                        @else()
                        <button type="button" class="bg-blue" wire:click='goToPageGardValidated'><h2 class="ml-5 mt-5 font-semibold text-lg text-gray-800" >Mes gardes validées</h2></button>
                    @endif
                    
                    
                    @if($currentPage === 3)
                        <button type="button" wire:click='goToPageGardDone'><h2 class="ml-5 mt-5 font-semibold text-lg text-blue-800">Mes gardes réalisées</h2></button>
                        @else()
                        <button type="button" wire:click='goToPageGardDone'><h2 class="ml-5 mt-5 font-semibold text-lg text-gray-800">Mes gardes réalisées</h2></button>
                    @endif

                   @if($currentPage === 4)
                        <button type="button" wire:click="goToPageGardAsked"><h2 class="ml-5 mt-5 font-semibold text-lg text-blue-800">Mes demandes envoyées</h2></button>
                        @else()
                        <button type="button" wire:click="goToPageGardAsked"><h2 class="ml-5 mt-5 font-semibold text-lg text-gray-800">Mes demandes envoyées</h2></button>
                    @endif
                    <!-- 
                    @if($currentPage === 5)
                        <button type="button"><h2 class="ml-5 mt-5 font-semibold text-lg text-blue-800">Mes gardes </h2></button>    
                        @else()
                        <button type="button"><h2 class="ml-5 mt-5 font-semibold text-lg text-gray-800">Mes gardes </h2></button>    
                    @endif
                    -->
                </div>
                <hr class="my-5 mx-5 border border-2 border-gray-400">
                
                <div>
                        <!-- Page des gardes non validées -->   
                    @if($currentPage === 1)
                        <!-- Demandes reçues -->
                            <div>
                                @foreach($annonces as $annonce)                             
                                    @foreach($annonce->proposals as $prop)
                                        @if($prop->validated === 2)
                                        
                                            <div class="px-3 py-5 mb-3 mt-4 mr-4 md:mr-32 ml-5 shadow-sm hover:shadow-md rounded border border-gray-200">    
                                                <div class="justify-between">
                                                    <h2 class="text-md font-bold text-gray-600 mb-2">Demande envoyée par {{ $prop->user->name}}</h2>
                                                    <p class="text-sm text-gray-900 underline mb-2"> Demande envoyée le {{ $proposal->created_date()}}</p>
                                                    @if(isset($prop->demande->first_animal))
                                                        <p class="text-sm text-gray-600 mb-2">Pour garder {{ $prop->demande->first_animal->animal_name}} son/sa {{ $prop->demande->first_animal->race->race_animal}}. </p>
                                                    @endif
                                                    @if(isset($prop->demande->second_animal))
                                                        <p class="text-sm text-gray-600 mb-2">Pour garder {{ $prop->demande->second_animal->animal_name}} son/sa {{ $prop->demande->second_animal->race->race_animal}}. </p>
                                                    @endif
                                                    @if(isset($prop->demande->third_animal))
                                                        <p class="text-sm text-gray-600 mb-2">Pour garder {{ $prop->demande->third_animal->animal_name}} son/sa {{ $prop->demande->third_animal->race->race_animal}}. </p>
                                                    @endif
                                                    <p class="text-sm text-gray-600 mb-2">{{ $prop->demande->garde->garde}}</p>
                                                    <p class="text-sm text-gray-600 mb-2">Pour un total de <span class="font-semibold text-lg">{{$prop->getFinalPriceWithoutCom()}}</span> </p>
                                                </div>
                                                <div>
                                                    <p class="text-sm text-red-600 mb-2"> Demande en attente de validation ...</p>
                                                </div>
                                                <div class="flex items-center">
                                                    <span class="h-2 w-2 bg-green-600 rounded-full mr-1"></span>
                                                    <a class="text-sm" href="{{ route('proposals.show', $prop) }}">Voir la demande en détail</a>
                                                </div>    
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach 
                                                                                    
                            </div> 
                        <!-- Fin demandes reçues -->

                    @endif
                </div>

                <div>
                        <!-- Page des gardes validées -->
                    @if($currentPage === 2)
                        <!-- Demandes reçues et validées-->
                            <div>
                                @foreach($annonces as $annonce)                                                                                                    
                                    @foreach($annonce->proposals as $prop)
                                        @if($prop->validated === 1)
                                        
                                            <div class="px-3 py-5 mb-3 mt-4 mr-4 md:mr-32 ml-5 shadow-sm hover:shadow-md rounded border border-gray-200">    
                                                <div class="justify-between">
                                                    <h2 class="text-md font-bold text-gray-600 mb-2">Demande envoyée par {{ $prop->user->name}}</h2>
                                                    <p class="text-sm text-gray-900 underline mb-2"> Demande envoyée le {{ $proposal->created_date()}}</p>
                                                    @if(isset($prop->demande->first_animal))
                                                        <p class="text-sm text-gray-600 mb-2">Pour garder {{ $prop->demande->first_animal->animal_name}} son/sa {{ $prop->demande->first_animal->race->race_animal}}. </p>
                                                    @endif
                                                    @if(isset($prop->demande->second_animal))
                                                        <p class="text-sm text-gray-600 mb-2">Pour garder {{ $prop->demande->second_animal->animal_name}} son/sa {{ $prop->demande->second_animal->race->race_animal}}. </p>
                                                    @endif
                                                    @if(isset($prop->demande->third_animal))
                                                        <p class="text-sm text-gray-600 mb-2">Pour garder {{ $prop->demande->third_animal->animal_name}} son/sa {{ $prop->demande->third_animal->race->race_animal}}. </p>
                                                    @endif
                                                    <p class="text-sm text-gray-600 mb-2">{{ $prop->demande->garde->garde}}</p>
                                                    <p class="text-sm font-semi-bold text-gray-600 mb-2">Pour un total de <span class="font-semibold text-lg">{{$prop->getFinalPriceWithoutCom()}} </span></p>
                                                </div>
                                                <div>        
                                                        <p class="text-sm text-blue-600 mb-2"> Demande acceptée ! </p>     
                                                </div>
                                                <div class="flex items-center">
                                                    <span class="h-2 w-2 bg-green-600 rounded-full mr-1"></span>
                                                    <a class="text-sm" href="{{ route('proposals.show', $prop) }}">Voir la demande en détail</a>
                                                </div>    
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach                                                        
                            </div> 
                        <!-- Fin demandes reçues -->               
                    @endif
                </div>

                <div>

                        <!-- Page des gardes réalisées -->
                    @if($currentPage === 3)

                    @endif

                </div>

                <div>
                    <!-- Page des gardes demandées -->
                    @if($currentPage === 4)
                        <!-- Demandes envoyées -->
                            <div>
                                <h2 class="ml-5 text-md font-bold text-gray-600 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                    </svg>
                                    Vos demandes de garde envoyées ({{auth()->user()->proposals->count()}})
                                </h2>
                                
                                @forelse(auth()->user()->proposals as $proposal)
                                    <div class="px-3 py-5 mb-3 mt-4 mr-4 md:mr-32 ml-5 shadow-sm hover:shadow-md rounded border border-gray-200"> 
                                        <div class="flex justify-between">
                                            <h2 class="text-md font-bold text-gray-600 mb-2">{{ $proposal->annonce->name}}</h2>
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-900 underline mb-2"> Demande envoyée le {{ $proposal->created_date()}}</p>
                                            <p class="text-sm font-semi-bold text-gray-600 mb-2">{{ $proposal->annonce->getRealPrice()}} / jour</p>
                                            <p class="text-sm font-semi-bold text-gray-600 mb-2">Soit un total pour la garde de <span class="font-semibold text-lg">{{ $proposal->finalPrice() }} </span> </p>
                                            @if($proposal->validated === 0)
                                                <p class="text-sm text-red-600 mb-2"> Demande refusée</p>
                                            @endif

                                            @if($proposal->validated === 1)
                                                <p class="text-sm text-blue-600 mb-2"> Demande acceptée ! </p>
                                            @endif
                                        
                                            @if($proposal->validated === 2)
                                                <p class="text-sm text-red-600 mb-2"> Demande en attente de validation ...</p>
                                            @endif
                                        </div>
                                        <div class="flex items-center">
                                            <span class="h-2 w-2 bg-green-600 rounded-full mr-1"></span>
                                                <a class="text-sm" href="{{ route('proposals.show', $proposal) }}">Voir la demande en détail</a>
                                        </div>
                                
                                    </div>
                                @empty
                                    <div class="px-3 py-5 mb-3 mr-4 md:mr-32 lg:mr-32 ml-5">
                                        <div class="flex justify-between pb-2">
                                            <p class="text-md font-normal text-gray-800">Vous n'avez envoyé aucune demande de garde pour l'instant. </p>
                                        </div>
                                    </div>
                                                            
                                @endforelse
                            </div> 
                        <!-- Fin demandes envoyées -->
                    @endif
                </div>
            </div>            
        </div>                    
    </div>

