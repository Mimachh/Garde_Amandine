
<div>
    @forelse(auth()->user()->proposals->sortByDesc('updated_at') as $proposal)
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
            <p class="text-sm font-semi-bold text-gray-600 mb-2 text-center">Aucune annonce envoyée à afficher</p>                                                            
    @endforelse
</div>
