<div>
@foreach ($contacts as $contact) 
<h1>Message numéro {{ $contact->id }} de {{ $contact->nom }} {{ $contact->prenom }}</h1>
@endforeach
</div>

<div class="container p-2 mx-auto sm:p-4 dark:text-gray-100">
	<h2 class="mb-4 text-2xl font-semibold leading-tight">Emails</h2>
	<div class="flex flex-col overflow-x-auto text-xs">
		<div class="flex text-left dark:bg-gray-700">
			<div class="flex items-center justify-center w-8 px-2 py-3 sm:p-3">
				<input type="checkbox" name="All" class="w-3 h-3 rounded-sm accent-violet-400">
			</div>
			<div class="w-32 px-2 py-3 sm:p-3">Envoyé par</div>
            <div class="w-24 px-2 py-3 sm:p-3 sm:block">Sujet</div>
			<div class="flex-1 px-2 py-3 sm:p-3">Message</div>
			<div class="hidden w-24 px-2 py-3 text-right sm:p-3 sm:block">Reçu</div>
		</div>
        @foreach($contacts as $contact)
		<div class="flex border-b border-opacity-20 dark:border-gray-700 dark:bg-gray-900">
			<div class="flex items-center justify-center w-8 px-2 py-3 sm:p-3">
				<input type="checkbox" class="w-3 h-3 rounded-sm accent-violet-400" name="Box0">
			</div>
			<div class="w-32 px-2 py-3 sm:p-3">
				<p>{{ $contact->nom }} - {{ $contact->prenom }}</p>
			</div>
            <div class="w-24 px-2 py-3 sm:p-3 sm:block">
				<p> {{ $contact->subject }}</p>
			</div>
			<div class="flex-1 block px-2 py-3 truncate sm:p-3 sm:w-auto">
                {{ $contact->message }}
            </div>
			<div class="hidden w-24 px-2 py-3 text-right sm:p-3 sm:block dark:text-gray-400">
				<p>5min ago</p>
			</div>
        </div>
        @endforeach
	</div>
</div>

