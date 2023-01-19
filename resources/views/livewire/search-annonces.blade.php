<div>
    <div 
    @click.away="open = false; @this.resetIndex();" x-data="{ open:true }" class="inline-block relative">
        <input id="test"  @click="open = true" class="bg-gray-200 text-gray-700 border-2 focus:outline-none
        placeholder-gray-500 px-2 py-1 rounded-full mr-2 w-56" placeholder="Rechercher une annonce" 
        wire:model="query" wire:keydown.arrow-down.prevent="incrementIndex"
        wire:keydown.arrow-up.prevent="decrementIndex"
        wire:keydown.backspace="resetIndex"
        wire:keydown.enter.prevent="showAnnonce"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        

        <svg class="w-5 h-5 text-gray-500 absolute top-0 right-0 mr-3 mt-2" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
        </svg>
        @if(strlen($query) > 2) 
            <ul x-show="open"
                class="absolute bg-gray-300 rounded-lg border w-56 pt-1">
                @if(count($annonces) > 0)
                    @foreach($annonces as $index => $annonce)
                    <li class="p-1 {{$index === $selectedIndex ? 'text-green-500' : ''}}">{{ $annonce->name }}</li>
                    @endforeach
                @else
                    <span class="text-orange-600">Aucun résultat pour {{ $query }}</span>
                @endif
            </ul>
        @endif
    </div>

    <input type="checkbox" wire:click="chat" value="true">



    
</div>



<!-- @foreach($villes as $ville)
{{ $ville->ville_nom }}
@foreach($ville->annonces as $a)
{{ $a->name }}
{{ $a->price}}
@endforeach
@endforeach -->

