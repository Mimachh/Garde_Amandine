<x-app-layout>
<form action="{{  route('a.store' ) }}" method="post" id="apiform">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @csrf
    <input type="text" name="zipcode" id="zipcode">
        <div id="error-message"></div>
            <select  name="city_code" id="city_code"></select>
    <button type="submit" class="btn-submit">ok</button>
</form>
</x-app-layout>