<x-app-layout>
<form >

    <input type="text" >
        <div id="error-message"></div>
        <select  ></select>
    <button type="submit" class="btn-submit">ok</button>
</form>


<form action="{{ route('a.store' ) }}" method="post" id="apiform" 
    class="space-y-6 w-full max-w-lg mx-auto mb-12" enctype="multipart/form-data">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @csrf
    <!-- Dates -->
    <h2 class="uppercase tracking-wide text-gray-700 text-md font-bold mt-4 mb-2">
       Vos disponibilités
    </h2>
    <div class="flex flex-wrap -mx-3 mb-2">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="start_watch">
                Date de début
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="start_watch" type="date">
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="end_watch">
                Date de fin
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="end_watch" type="date">
        </div>
    </div>
    <hr>
    <!-- Conditions -->
    <h2 class="uppercase tracking-wide text-gray-700 text-md font-bold mt-4 mb-2">
       Les conditions de garde
    </h2>
    <div class="flex flex-wrap -mx-3 mb-2">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="habitation_id">
                Type d'habitation
            </label>
            <div class="relative">
                <select name="habitation_id" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Choisir une option</option>
                    @foreach($habitations as $habitation)
                        <option value="{{ $habitation->id }}">{{ $habitation->hab }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="exterieur_id">
                Exterieur
            </label>
            <div class="relative">
                <select name="exterieur_id" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="">Choisir une option</option>
                    @foreach($exterieurs as $exterieur)
                        <option value="{{ $exterieur->id }}">{{ $exterieur->ext }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <!-- Commune -->
    <h2 class="uppercase tracking-wide text-gray-700 text-md font-bold mt-4 mb-2">
       Localisation
    </h2>
    <div class="flex flex-wrap -mx-3 mb-2">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="zipcode">
            Code Postal
        </label>
        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
        name="zipcode" id="zipcode"type="text" placeholder="72500">
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="city_code">
                Commune
            </label>
            <div class="relative">
                <select name="city_code" id="city_code" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <!-- Checkbox -->
    <h2 class="uppercase tracking-wide text-gray-700 text-md font-bold mt-4 mb-2">
        Les animaux que vous pouvez garder
    </h2>
    <div class="flex flex-wrap -mx-3 mb-2">
        <div class="checkboxAnimalsFormDiv w-full w-1/2 px-3 mb-6 md:mb-0">
            <input id="animalsCheckbox1" type="checkbox" value="1" name="chats">
            <label class="checkboxAnimalsForm" for="animalsCheckbox1">
                <small class="italic">Chats</small> 
                <img class="rounded-lg h-32 w-full" src="{{ Vite::asset('public/storage/site_photos/Chats.jpg') }}" alt="">
            </label>
        </div>
        <div class="checkboxAnimalsFormDiv w-full w-1/2 px-3 mb-6 md:mb-0">
            <input id="animalsCheckbox2" type="checkbox" value="2" name="chiens">
            <label class="checkboxAnimalsForm" for="animalsCheckbox2">
                <small class="italic">Chiens</small> 
                <img class="rounded-lg" src="{{ Vite::asset('public/storage/site_photos/Chiens.jpg') }}" alt="">
            </label>
        </div>
        <div class="checkboxAnimalsFormDiv w-full w-1/2 px-3 mb-6 md:mb-0">
            <input id="animalsCheckbox3" type="checkbox" value="3" name="poissons">
            <label class="checkboxAnimalsForm" for="animalsCheckbox3">
                <small class="italic">Poissons</small> 
                <img class="rounded-lg" src="{{ Vite::asset('public/storage/site_photos/Poissons.jpg') }}" alt="">
            </label>
        </div>
        <div class="checkboxAnimalsFormDiv w-full w-1/2 px-3 mb-6 md:mb-0">
            <input id="animalsCheckbox4" type="checkbox" value="4" name="rongeurs">
            <label class="checkboxAnimalsForm" for="animalsCheckbox4">
                <small class="italic">Rongeurs</small> 
                <img class="rounded-lg" src="{{ Vite::asset('public/storage/site_photos/Lapins.jpg') }}" alt="">
            </label>
        </div>
        <div class="checkboxAnimalsFormDiv w-full w-1/2 px-3 mb-6 md:mb-0">
            <input id="animalsCheckbox5" type="checkbox" value="5" name="oiseaux">
            <label class="checkboxAnimalsForm" for="animalsCheckbox5">
                <small class="italic">Oiseaux</small> 
                <img class="rounded-lg" src="{{ Vite::asset('public/storage/site_photos/Oiseaux.jpg') }}" alt="">
            </label>
        </div>
        <div class="checkboxAnimalsFormDiv w-full w-1/2 px-3 mb-6 md:mb-0">
            <input id="animalsCheckbox6" type="checkbox" value="6" name="reptiles">
            <label class="checkboxAnimalsForm" for="animalsCheckbox6" >
                <small class="italic">Reptiles</small> 
                <img class="rounded-lg" src="{{ Vite::asset('public/storage/site_photos/Reptiles.jpg') }}" alt="">
            </label>
        </div>  
        <div class="checkboxAnimalsFormDiv w-full w-1/2 px-3 mb-6 md:mb-0">
            <input id="animalsCheckbox7" type="checkbox" value="7"  name="ferme">
            <label class="checkboxAnimalsForm" for="animalsCheckbox7">
                <small class="italic">Animaux de la ferme</small> 
                <img class="rounded-lg" src="{{ Vite::asset('public/storage/site_photos/Chevaux.jpg') }}" alt="">
            </label>
        </div> 
        <div class="checkboxAnimalsFormDiv w-full w-1/2 px-3 mb-6 md:mb-0">
            <input id="animalsCheckbox8" type="checkbox" value="8" name="autre">
            <label class="checkboxAnimalsForm" for="animalsCheckbox8">
                <small class="italic">Autre</small> 
                <img class="rounded-lg" src="{{ Vite::asset('public/storage/site_photos/Reptiles.jpg') }}" alt="">
            </label>
        </div>  
    </div>
    <hr>
    <!-- Description / Photo -->
    <h2 class="uppercase tracking-wide text-gray-700 text-md font-bold mt-4 mb-2">
       Votre profil
    </h2>
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="photo">
                Votre photo
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            i name="photo" type="file">
        </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">
                Description
            </label>
            <textarea name="description" id="description" cols="30" rows="10"
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            </textarea>
            <p class="text-gray-600 text-xs italic">Mettez quelques mots vous concernant, cela permet aux propriétaires des animaux d'avoir confiance en leur Pet-Sitter</p>
        </div>
    </div>
    <hr>
    <!-- Prix -->
    <h2 class="uppercase tracking-wide text-gray-700 text-md font-bold mt-4 mb-2">
       Votre tarif
    </h2>
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="price">
                Prix de votre garde (par jour)
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
             id="price" type="text" name="price">
            <p class="text-gray-600 text-xs italic"></p>
        </div>
    </div>
    <button type="submit" class="button-perso inline-block md:px-6 py-2.5 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out w-full mb-3">
       Enregistrer
    </button>
</form>
</x-app-layout>