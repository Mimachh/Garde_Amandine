<div>
@foreach ($contacts as $contact) 
<h1>Message numéro {{ $contact->id }} de {{ $contact->nom }} {{ $contact->prenom }}</h1>
@endforeach
</div>

