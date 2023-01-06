@component('mail::message')
# Réponse à ta demande

Salut {{ $proposal->user->name}},

@if($proposal->validated === 1)

{{$proposal->annonce->user->name }} accepte de garder {{ $demande->first_animal->animal_name }}. <br>
Il ne te reste plus qu'à régler ta note !

@component('mail::button', ['url' => 'http://127.0.0.1:8001/proposals/'.$proposal->id.'/', 'color' => 'success'])
Voir la demande
@endcomponent

@else

Malheureusement {{$proposal->annonce->user->name }} ne peux pas garder {{ $demande->first_animal->animal_name }}. <br>
N'hésite pas à continuer tes recherches !

@component('mail::button', ['url' => 'http://127.0.0.1:8001/', 'color' => 'success'])
Voir les annonces
@endcomponent

@endif



Thanks,<br>
{{ config('app.name') }}
@endcomponent
