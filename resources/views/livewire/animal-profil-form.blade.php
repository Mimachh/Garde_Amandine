<x-jet-form-section submit="">
    <x-slot name="title">
        {{ __('Mes animaux') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Crée des fiches de présentation de tes animaux.
             Cela aide les Pet-Sitter à connaitre tes compagnons.') }}
    </x-slot>

    <x-slot name="form">
        

         <!-- Accéder au formulaire -->                           
         <div class="col-span-6 sm:col-span-4 ">
        <x-jet-button type="button"><a href="{{ route('welcome') }}">Créer une fiche</a>
        
        </x-jet-button>
        </div>  
                      
    </x-slot>
</x-jet-form-section>

