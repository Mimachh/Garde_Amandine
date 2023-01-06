<div class="w-full mx-auto px-2">
		<!--Title-->
		<h1 class="flex items-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl">
			Table des utilisateurs ({{ $users->count() }} Utilisateurs inscrits)
		</h1>

		
		<!--Card-->
		<div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">
			<form class="flex space-x-4">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <x-jet-input type="text" class="form-control" wire:model="state.name" id="marque" placeholder=""/>
                </div>
                <div class="mb-3">
                    <label for="role_id" class="form-label">Role</label>
                    <x-jet-input type="text" class="form-control" wire:model="state.role_id" id="prix" placeholder=""/>
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
			<div>
			<table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
				<thead>
					<tr>
						<th data-priority="1">Id</th>
						<th data-priority="2">Nom</th>
						<th data-priority="3">Mail</th>
						<th data-priority="4">Role</th>
						<th data-priority="5">Création</th>
                        <th data-priority="6">Crud</th>
					</tr>
				</thead>
				<tbody>
                @foreach($users as $user)
                    <tr>
						<td>{{ $user->id }}</td>
						<td>{{ $user->name}}</td>
						<td>{{ $user->email }}</td>
						<td>{{ $user->role->name }}</td>
						<td>{{ $user->created_at }}</td>
                        <td>
                            <x-jet-danger-button wire:click.prevent="delete({{ $user->id }})">Supprimer</x-jet-danger-button>
                            <x-jet-button wire:click.prevent="edit({{ $user->id }})" type="button">Editer</x-jet-button>
                        </td>
					</tr>
                @endforeach
				</tbody>
			</table>
			</div>
		</div>
		<!--/Card-->


	</div>

	
