<div class="w-full mx-auto px-2">

<!--Title-->
<h1 class="flex items-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl">
    Table de propositions ({{ $proposals->count()}})		
</h1>


<!--Card-->
<div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">


    <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
        <thead>
            <tr>
                <th data-priority="1">Id</th>
                <th data-priority="2">Envoyé par</th>
                <th data-priority="3">Envoyé à</th>
                <th data-priority="4">Validated</th>
                <th data-priority="5">Dates</th>
                <th data-priority="6">Animaux</th>
                <th data-priority="7">Garde</th>
                <th data-priority="8">Nombre visites</th>
                <th data-priority="9">Téléphone</th>
                <th data-priority="10">Prix sans commission</th>
                <th data-priority="11">Prix avec commission</th>
            </tr>
        </thead>
        <tbody>
            @foreach($proposals as $proposal)
            <tr>
                <td>{{ $proposal->id }}</td>
                <td>{{ $proposal->user->id }} - {{ $proposal->user->name }}</td>
                <td>{{ $proposal->annonce->user->id }} - {{ $proposal->annonce->user->name }}</td>
                <td>{{ $proposal->validated }}</td>
                <td>{{ $proposal->start_date_fr() }} / {{ $proposal->end_date_fr() }}</td>
                <td>
                    @isset($proposal->demande->first_animal_id)
                    {{ $proposal->demande->first_animal->animal_name }}
                    @endisset
                    @isset($proposal->demande->second_animal_id)
                    /{{ $proposal->demande->second_animal->animal_name }}
                    @endisset
                    @isset($proposal->demande->third_animal_id)
                    /{{ $proposal->demande->third_animal->animal_name }}
                    @endisset
                </td>
                <td>{{ $proposal->demande->garde->garde }}</td>
                <td>{{ $proposal->demande->number_visit }}</td>
                <td>{{ $proposal->demande->phone }}</td>
                <td>{{ $proposal->getFinalPriceWithoutCom() }}</td>
                <td>{{ $proposal->finalPrice() }}</td>
                <td class="px-6 py-4">
                    <button wire:click.prevent="delete({{ $proposal->id }})" type="button" class="px-4 py-1 text-sm text-red-400 bg-red-200 rounded-full">Delete</button>
                </td>
            </tr>
            @endforeach
        
        </tbody>

    </table>


</div>
<!--/Card-->


</div>

