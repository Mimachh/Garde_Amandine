<x-app-layout>

    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-200 leading-tight text-center">
            Demande de garde à {{ $annonce->name }}
        </h1>
    </x-slot>

    <x-slot name="buttonBack">
        @livewire('previous-page')
    </x-slot>

<livewire:demandes :annonce="$annonce"/>

</x-app-layout>