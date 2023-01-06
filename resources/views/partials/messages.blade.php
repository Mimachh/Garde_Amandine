@if (count($messages))

  @foreach ($messages as $message)
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 5000)" x-show="show" class="{{ $message['level'] }}  border-2 px-1 py-2 rounded text-center md:mx-32 lg:mx-32 mt-2" role="alert">
        <!-- <strong class="font-bold">Bravo !</strong> -->
        <span class="block sm:inline">{!! $message['message'] !!}</span> 
    </div>
  @endforeach

@endif


