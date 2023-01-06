<div x-data="{ open:false }" @flash-message.window="open = true; setTimeout(() =>open = false, 6000);" class="{{ $type ? $colors[$type] : '' }} rounded md:mx-32 lg:mx-32 mt-2">

        <div x-show="open" x-cloak class="py-2 text-center md:mx-32 lg:mx-32">
            {{ $message }}
        </div>

</div>

