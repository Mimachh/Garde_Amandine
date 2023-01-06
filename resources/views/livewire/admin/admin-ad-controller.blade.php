
<div>
	<!--Title-->
	<h1 class="flex items-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-sm md:text-2xl">
		Table des annonces ({{ $annonces->count() }} annonces en ligne)
	</h1>

	<div class="container flex justify-center mx-auto">
		<div class="flex flex-col">
			<div class="w-full">
				<div class="border-b border-gray-200 shadow">
					<div x-data="{ open: false }">
						<button x-on:click="open = ! open" type="button">Ouvrir le formulaire</button>
						<form class="space-x-4" x-show="open">
							<div class="mb-3 space-x-4">
								<label for="name" class="form-label">Name</label>
								<x-jet-input type="text" class="form-control" wire:model="state.name" id="marque"/>
								
								<label for="status" class="form-label">Status</label>
								<x-jet-input type="number" class="form-control" wire:model="state.status" id="status"/>
							</div>
							<div class="mb-3">
								<label for="habitation" class="form-label">Habitation</label>
								<select class="form-control" wire:model="state.habitation_id" id="habitation">
									<option value="">Habitation</option>
									@foreach($habitations as $hab)
									<option value="{{$hab->id}}">{{$hab->hab}}</option>
									@endforeach
								</select>
								<label for="exterieur" class="form-label">Exterieur</label>
								<select class="form-control" wire:model="state.exterieur_id" id="exterieur">
									<option value="">Exterieur</option>
									@foreach($exterieurs as $ext)
									<option value="{{$ext->id}}">{{$ext->ext}}</option>
									@endforeach
								</select>
							</div>
							<div class="mb-3">
								<label for="start_watch">Date début</label>
								<x-jet-input id="start_watch" wire:model="state.start_watch" name="start_watch" type="date"/>
								<label for="end_watch">Date fin</label>
								<x-jet-input id="end_watch" wire:model="state.end_watch" name="end_watch" type="date"/>   
							</div>
							<div class="mb-3">
								<label for="Garde" class="form-label">Garde</label>
								<select class="form-control" wire:model="state.garde_id" id="garde">
									<option value="">Garde</option>
									@foreach($gardes as $g)
									<option value="{{$g->id}}">{{$g->garde}}</option>
									@endforeach
								</select>

								<label for="price">Prix</label>
								<x-jet-input type="text" wire:model="state.price"/>
							</div>
							<div class="mb-3">
								<label for="description">Description</label>
								<textarea wire:model="state.description" name="description" id="description" class="w-full"></textarea>
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
					

					<table class="divide-y divide-gray-300 ">
						<thead class="bg-gray-50">
							<tr class="px-6 py-2 text-xs text-gray-500">
								<th data-priority="1" class="border">Id</th>
								<th data-priority="2" class="border">Nom</th>
								<th data-priority="3" class="border">Ville</th>
								<th data-priority="4" class="border">Conditions</th>
								<th data-priority="5" class="border">Status</th>
								<th data-priority="6" class="border">Dates</th>
								<th data-priority="7" class="border">Type de Garde</th>
								<th data-priority="8" class="border">Animaux</th>
								<th data-priority="9" class="border">Description</th>
								<th data-priority="10" class="border">Prix</th>
								<th data-priority="11" class="border">Prix commission</th>
								<th data-priority="12" class="border">Utilisateur</th>
								<th data-priority="13" class="border">Crud</th>
							</tr>
						</thead>
						<tbody class="bg-white divide-y divide-gray-300">
							@foreach($annonces as $annonce)
							<tr class="whitespace-nowrap text-xs text-center text-gray-500">
								<td class="border">{{ $annonce->id }}</td>
								<td class="border">{{ $annonce->name }}</td>
								<td class="border">{{ $annonce->ville_id }}</td>
								<td class="border">{{ $annonce->habitation->hab }} / {{ $annonce->exterieur->ext}}</td>
								<td class="border">{{ $annonce->status }}</td>
								<td class="border">{{ $annonce->start_date_fr() }} / {{ $annonce->end_date_fr() }}</td>
								<td class="border">{{ $annonce->garde->garde }}</td>
								<td class="border">
									{{ $annonce->chats }}/{{ $annonce->chiens }}/{{ $annonce->poissons }}/
									{{ $annonce->rongeurs }}/{{ $annonce->oiseaux }}/{{ $annonce->reptiles }}/
									{{ $annonce->ferme }}/{{ $annonce->autre }}
								</td>
								<td class="border">{{ $annonce->description }}</td>
								<td class="border">{{ $annonce->getPrice() }}</td>
								<td class="border">{{ $annonce->getRealPrice() }}</td>
								<td class="border">{{ $annonce->user->id }} / {{ $annonce->user->name }}</td>
								<td class="px-6 py-4">
									<button wire:click.prevent="edit({{ $annonce->id }})" type="button" class="px-4 py-1 text-sm text-blue-600 bg-blue-200 rounded-full">Edit</button>
							
									<button wire:click.prevent="delete({{ $annonce->id }})" type="button" class="px-4 py-1 text-sm text-red-400 bg-red-200 rounded-full">Delete</button>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>	
