<div class="w-full mx-auto px-2">
		<!--Title-->
		<h1 class="flex items-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl">
			Table des animaux({{ $animals->count() }} animaux en ligne)
		</h1>

		<!--Card-->
		<div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
					<div x-data="{ open: false }">
						<x-jet-button x-on:click="open = ! open" type="button">Ouvrir le formulaire</x-jet-button>
						<form class="space-x-4" x-show="open">
							<div class="mb-3 space-x-4">
								<label for="animal_name" class="form-label">Name</label>
								<x-jet-input type="text" class="form-control" wire:model="state.animal_name" id="animal_name"/>
								
								<label for="age_id" class="form-label">Age</label>
								<x-jet-input type="number" class="form-control" wire:model="state.age_id" id="age_id"/>
							</div>
							<div class="mb-3">
								<label for="espece_id" class="form-label">Espece</label>
								<x-jet-input type="number" class="form-control" wire:model="state.espece_id" id="espece_id"/>

								<label for="race_id" class="form-label">Espece</label>
								<x-jet-input type="number" class="form-control" wire:model="state.race_id" id="race_id"/>
							</div>
							<div class="mb-3">
								<label for="personnality">Personnalité</label>
								<textarea wire:model="state.personnality" name="personnality" id="personnality" class="w-full"></textarea>
							</div>
							<div class="mb-3">
								<x-jet-danger-button type="reset" wire:click.prevent="cancel">Annuler</x-jet-danger-button>
								@if ($updateMode)
									<x-jet-button class="bg-green-600" type="submit" wire:click.prevent="update">Mettre à jour</x-jet-button>
								@else
									<x-jet-button type="submit" wire:click.prevent="store">Enregistrer</x-jet-button>
								@endif
							</div>
						</form>
					</div>
			<table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
				<thead>
					<tr>
						<th data-priority="1">Id</th>
						<th data-priority="2">Nom</th>
						<th data-priority="3">Age</th>
						<th data-priority="4">Espece</th>
						<th data-priority="5">Race</th>
                        <th data-priority="6">Propriétaire</th>
                        <th data-priority="7">Création</th>
                        <th data-priority="8">Crud</th>
					</tr>
				</thead>
				<tbody>
                @foreach($animals as $animal)
                    <tr>
						<td>{{ $animal->id }}</td>
						<td>{{ $animal->animal_name}}</td>
                        <td>{{ $animal->age->age }}</td>
						<td>{{ $animal->espece->espece }}</td>
						<td>{{ $animal->race->race_animal }}</td>
                        <td>{{ $animal->user->id}} / {{$animal->user->name }}</td>
						<td>{{ $animal->created_at }}</td>
                        <td>
                        	<x-jet-danger-button wire:click.prevent="delete({{ $animal->id }})">Supprimer</x-jet-danger-button>
                            <x-jet-button wire:click.prevent="edit({{ $animal->id }})" type="button">Editer</x-jet-button>
                        </td>
					</tr>
                    @endforeach
				</tbody>
			</table>
		</div>
		<!--/Card-->


	</div>
    
