<div>
    <form action="{{ route('annonces.search') }}">
        <div>
            <input class="rounded-full" name="ville" type="search" id="ville">
            <label for="ville">Ville de recherche</label>
        </div>
        <div>
            <input class="rounded-full" type="checkbox" name="chats" value="1" id="chats">
            <label for="chats">Chat</label>
        </div>
        <div>
            <input class="rounded-full" type="checkbox" name="chiens" value="2" id="chiens">
            <label for="chiens">Chien</label>
        </div>
        <div>
            <input class="rounded-full" type="checkbox" name="poissons" value="3" id="poissons">
            <label for="chiens">Poisson</label>
        </div>
        <div>
            <input class="rounded-full" type="checkbox" name="rongeurs" value="4" id="rongeurs">
            <label for="chiens">Rongeur</label>
        </div>
        <div>
            <select name="garde" id="garde">
                @foreach($gardes as $garde)
                <option value="{{$garde->id }}">{{ $garde->name }}</option>
                @endforeach
            </select>
        </div>
        
        <button type="submit"> Ok </button>
    </form>
</div>