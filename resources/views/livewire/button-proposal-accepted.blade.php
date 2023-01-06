@if($proposal->validated === 2)
    <div>
        <x-jet-button wire:click="accepted" class="bg-blue-600"> Accepter </x-jet-button>
    </div>
@endif
