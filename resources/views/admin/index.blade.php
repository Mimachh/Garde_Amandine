<x-app-layout>

    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-200 leading-tight text-center">
        Bonjour {{ auth()->user()->name }}, vous êtes connecté en tant que {{ auth()->user()->role->name }}
        </h1>
    </x-slot>


    <div class="space-y-10 ml-10 text-center mt-8">
        <div>
            <a class="bg-cyan-800 px-8 py-2 rounded-lg text-gray-200" href="{{ route('admin.ads.index') }}">Liste des annonces</a>
        </div>

        <div>
           <a class="bg-cyan-800 px-8 py-2 rounded-lg text-gray-200" href="{{ route('admin.animals.index') }}">Liste des animaux</a>
        </div>

        <div>
           <a class="bg-cyan-800 px-8 py-2 rounded-lg text-gray-200" href="{{ route('admin.users.index') }}">Liste des utilisateurs</a>
        </div>

        <div>
            <a class="bg-cyan-800 px-8 py-2 rounded-lg text-gray-200" href="{{ route('admin.proposals.index') }}">Liste des propositions</a>
        </div>

        <div>
            <a class="bg-cyan-800 px-8 py-2 rounded-lg text-gray-200" href="{{ route('admin.contacts.index') }}">Liste des messages contact</a>
        </div>

    </div>
</x-app-layout>