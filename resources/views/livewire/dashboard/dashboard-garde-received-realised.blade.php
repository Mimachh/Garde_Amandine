<div>
    {{ $now }}
    @forelse($annonces as $annonce)
        @foreach($annonce->proposals->where('validated', 1) as $proposal)              
            @if($proposal->demande->end_date < $now)
             Les gardes après aujourd'hui
             {{ $proposal->id }}
                <a class="" href="{{ route('generatePDF', $proposal->id) }}">Exporter en pdf</a>
            @endif
        @endforeach
    @empty
    @endforelse
</div>
