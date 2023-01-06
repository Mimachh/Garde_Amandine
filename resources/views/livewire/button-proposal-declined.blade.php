@if($proposal->validated === 2)
    <div>
        <x-jet-button wire:click="declined" class="bg-red-500"> Refuser </x-jet-button> 
    </div>
@endif
