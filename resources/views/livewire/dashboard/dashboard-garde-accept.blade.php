<div>
    @forelse($annonces as $annonce)                                                                                                    
        @foreach($annonce->proposals->sortByDesc('updated_at') as $prop)
            @if($prop->validated === 1)
                <div class="px-3 py-5 mb-3 mt-4 mr-4 md:mr-32 ml-5 shadow-sm hover:shadow-md rounded border border-gray-200">    
                    <div class="justify-between">
                        <h2 class="text-md font-bold text-gray-600 mb-2">Demande envoyée par {{ $prop->user->name}}</h2>
                        <p class="text-sm text-gray-900 underline mb-2"> Demande envoyée le {{ $prop->created_date()}}</p>
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
                        <p class="text-sm font-semi-bold text-gray-600 mb-2">Pour un total de <span class="font-semibold text-lg">{{$prop->getPriceProposal() }} </span></p>
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
    @empty
        <p class="text-sm font-semi-bold text-gray-600 mb-2 text-center">Aucune annonce validée à afficher</p>
    @endforelse
</div>

