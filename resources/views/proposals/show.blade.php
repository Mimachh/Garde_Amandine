<x-app-layout>
    @can('view', $proposal) 
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-200 leading-tight text-center">
            @if(auth()->user()->id !== $proposal->user_id)
                Demande envoyée par {{ $proposal->user->name }}
            @endif
            @if(auth()->user()->id === $proposal->user_id)
            Demande envoyée par vous
            @endif

        </h1>
    </x-slot>

    @livewire('previous-page')

    <div class="px-3 py-5 mb-3 mt-4 mr-4 md:mr-32 ml-5 shadow-sm hover:shadow-md rounded border border-gray-200">   
        <div class="justify-between">
            @if(auth()->user()->id !== $proposal->user_id)
                <h2 class="text-md font-bold text-gray-600 mb-2">Demande envoyée par {{ $proposal->user->name}}</h2>
            @endif
            @if(auth()->user()->id === $proposal->user_id)
                <h2 class="text-md font-bold text-gray-600 mb-2">Demande envoyée par vous</h2>
            @endif
                @if(isset($proposal->demande->first_animal))
                <p class="text-sm text-gray-600 mb-2">Pour garder {{ $proposal->demande->first_animal->animal_name}}, son/sa {{ $proposal->demande->first_animal->race->race_animal}}. <a class="text-blue-600" href="{{ route('animals.show', $proposal->demande->first_animal) }}">Voir la fiche détaillé</a> </p>
            @endif
            @if(isset($proposal->demande->second_animal))
                <p class="text-sm text-gray-600 mb-2">Pour garder {{ $prop->demande->second_animal->animal_name}} son/sa {{ $proposal->demande->second_animal->race->race_animal}}. <a class="text-blue-600" href="{{ route('animals.show', $proposal->demande->second_animal) }}">Voir la fiche détaillé</a></p>
            @endif
            @if(isset($proposal->demande->third_animal))
                <p class="text-sm text-gray-600 mb-2">Pour garder {{ $proposal->demande->third_animal->animal_name}} son/sa {{ $proposal->demande->third_animal->race->race_animal}}. <a class="text-blue-600" href="{{ route('animals.show', $proposal->demande->third_animal) }}">Voir la fiche détaillé</a> </p>
            @endif
            <p class="text-sm text-gray-600 mb-2">{{ $proposal->demande->garde->garde}}</p>
            <p class="text-sm text-gray-600 mb-2">Du {{ $proposal->start_date_fr()}} au {{ $proposal->end_date_fr()}}</p>
            <!-- Prix -->
                <p class="text-sm font-semi-bold text-gray-600 mb-2">Pour un total de <span class="font-semibold text-lg">{{ $proposal->getPriceProposal() }} </span></p>
            <!-- Prix -->
        </div>

        <div>
            @can('buttonForAnswer', $proposal)
                <div class="flex space-x-5"> 
                    <div>         
                        <livewire:button-proposal-accepted :proposal="$proposal">
                    </div>
                    <div>
                        <livewire:button-proposal-declined :proposal="$proposal">
                    </div>
                </div>
            @endcan

                @if($proposal->validated === 0)
                    <p class="text-sm text-red-600 mb-2"> Demande refusée</p>
                @endif

                @if($proposal->validated === 1)
                    <p class="text-sm text-blue-600 mb-2"> Demande acceptée ! </p>
                @endif
            @can('waitingForAnswer', $proposal)   
                @if($proposal->validated === 2)
                    <p class="text-sm text-red-600 mb-2"> Demande en attente de validation ...</p>
                @endif
            @endcan
        </div>
        @can('paid', $proposal)
            <p>système de paiement</p>
            <button> Accéder à la messagerie</button>
        @endcan
     
    </div>
    @endcan
</x-app-layout>
