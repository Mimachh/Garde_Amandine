<div>
    @forelse($favs as $annonce)
        <div class="px-3 py-5 mb-3 mr-4 md:mr-32 lg:mr-32 ml-5 shadow-sm hover:shadow-md rounded border border-gray-200">
        <div class="flex justify-between pb-2">
            <h2 class="text-md font-bold text-gray-600">{{$annonce->user->name}}</h2>
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
                <div class="flex">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="blue" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                    </svg>
                    <p class="text-sm text-gray-600 pl-1 pb-3"><span class="text-md text-gray-800"> Ville : {{ $annonce->ville_name }}</span></p>    
                </div>
            <!--Fin ville --> 
            @if($annonce->garde !== null)        
            <p class="text-sm text-gray-600 pb-2">Type de garde : <span class="text-sm text-gray-800">
                {{ $annonce->garde->garde }}</span>  
            </p>
            @endif   
        <p class="text-sm text-gray-600">Animaux gardés :  </p>
        <ul class="text-sm text-gray-800 pb-2">
            @if($annonce->chats)
              <li class="pb-1">{{ $annonce->chats ? 'Chats' : ''}}</li>
            @endif
            @if($annonce->chiens)
              <li class="pb-1">{{ $annonce->chiens ? ' Chiens' : ''}} </li>
            @endif
            @if($annonce->poissons)
              <li class="pb-1">{{ $annonce->poissons ? ' Poissons' : ''}}</li>
            @endif
            @if($annonce->rongeurs)
              <li class="pb-1">{{ $annonce->rongeurs ? ' Rongeurs' : ''}}</li>
            @endif
            @if($annonce->oiseaux)
              <li class="pb-1">{{ $annonce->oiseaux ? ' Oiseaux' : ''}}</li>
            @endif
            @if($annonce->reptiles)                               
              <li class="pb-1">{{ $annonce->reptiles ? ' Reptiles' : ''}}</li> 
            @endif
            @if($annonce->ferme)                                   
              <li class="pb-1">{{ $annonce->ferme ? ' Animaux de la ferme' : ''}}</li>
            @endif
            </ul>
        <p class="text-sm text-gray-600 pb-2">Prix : <span class="text-sm text-gray-800">{{ $annonce->getPrice() }}/ jour.</span></p>     
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
</div>

