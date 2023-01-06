<x-app-layout>

    
    <x-slot name="header">
    
            <h1 class="ml-14 md:ml-64 font-semibold text-xl text-white leading-tight">
                {{ __('Tableau de bord de ') }}{{auth()->user()->name}}
            </h1>
     
    </x-slot>
    
   
        @livewire('dashboard.dashboard-panel')
   
               
        
</x-app-layout>
