<x-app-layout>
<x-slot name="header">
    <h1 class="font-semibold text-xl text-gray-200 leading-tight text-center">
        {{ __('Editer mon annonce') }}
    </h1>
</x-slot>
<form action="{{ route('a.update', $annonce ) }}" method="post" id="apiform" 
    class="bg-white space-y-6 w-full max-w-full md:max-w-3xl mx-auto mb-12 px-4 py-10 rounded shadow-lg" enctype="multipart/form-data">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <p>Les champs obligatoires sont marqués par *</p>
    @csrf
    @method('PATCH')
    <!-- Dates -->
    <h2 class="uppercase tracking-wide text-gray-700 text-md font-bold mt-4 mb-2">
       Vos disponibilités
    </h2>
    <div class="flex flex-wrap -mx-3 mb-2">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="start_watch" >
                Date de début
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="start_watch" type="date" value="{{ $annonce->start_watch }}">
            @error('start_watch') <small class="text-red-600 italic"> {{ $errors->first('start_watch') }}</small>@enderror
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="end_watch">
                Date de fin
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
            name="end_watch" type="date" value="{{ $annonce->end_watch }}">
            @error('end_watch') <small class="text-red-600 italic"> {{ $errors->first('end_watch') }}</small>@enderror
        </div>
    </div>
    <hr>
    <!-- Conditions -->
    <h2 class="uppercase tracking-wide text-gray-700 text-md font-bold mt-4 mb-2">
       Les conditions de garde *
    </h2>
    <div class="flex flex-wrap -mx-3 mb-2">
        <div class="w-full px-3 pb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="garde_id">
                Type de garde
            </label>
            <div class="relative">
                <select name="garde_id" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option  value="1" {{($annonce->garde_id === 1) ? 'Selected' : ''}}>Chez le Pet-Sitter</option>
                    <option value="2" {{($annonce->garde_id === 2) ? 'Selected' : ''}} >Visite à domicile </option>
                    <option value="3" {{($annonce->garde_id === 3) ? 'Selected' : ''}} >Chez le Pet-Sitter / A domicile</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
            @error('garde_id') <small class="text-red-600 italic"> {{ $errors->first('garde_id') }}</small>@enderror
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="habitation_id">
                Type d'habitation
            </label>
            <div class="relative">
                <select name="habitation_id" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option  value="1" {{($annonce->habitation_id === 1) ? 'Selected' : ''}}>Appartement</option>
                    <option  value="2" {{($annonce->habitation_id === 2) ? 'Selected' : ''}}>Maison</option>
                    <option  value="3" {{($annonce->habitation_id === 3) ? 'Selected' : ''}}>Non concerné</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
            @error('habitation_id') <small class="text-red-600 italic"> {{ $errors->first('habitation_id') }}</small>@enderror
        </div>
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
            for="exterieur_id">
                Exterieur
            </label>
            <div class="relative">
                <select name="exterieur_id" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option  value="1" {{($annonce->exterieur_id === 1) ? 'Selected' : ''}}>Avec jardin/cour</option>
                    <option  value="2" {{($annonce->exterieur_id === 2) ? 'Selected' : ''}}>Sans exterieur</option>
                    <option  value="3" {{($annonce->exterieur_id === 3) ? 'Selected' : ''}}>Non concerné</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
            @error('exterieur_id') <small class="text-red-600 italic"> {{ $errors->first('exterieur_id') }}</small>@enderror
        </div>
    </div>
    <hr>
    <!-- Commune -->
    <h2 class="uppercase tracking-wide text-gray-700 text-md font-bold mt-4 mb-2">
       Localisation *
    </h2>
    <div class="flex flex-wrap -mx-3 mb-2">
        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="zipcode">
            Code Postal
        </label>
        <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
        name="zipcode" id="zipcode"type="text" value={{ $annonce->code_postal }}>
        <small class="text-red-600 italic" id="error-message"></small>
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
        @error('city_code') <small class="text-red-600 italic"> {{ $errors->first('city_code') }}</small>@enderror
    </div>
    <hr>
    <!-- Checkbox -->
    <h2 class="uppercase tracking-wide text-gray-700 text-md font-bold mt-4 mb-2">
        Les animaux que vous pouvez garder
    </h2>
    <small class="italic">Faites votre choix en cliquant sur les images</small>
    <div class="flex flex-wrap -mx-3 mb-2">
        <div class="checkboxAnimalsFormDiv w-full w-1/2 px-3 mb-6 md:mb-0">
            <input id="animalsCheckbox1" type="checkbox" value="1" name="chats"
            {{($annonce->chats=== 1) ? 'checked' : ''}}>
            <label class="checkboxAnimalsForm" for="animalsCheckbox1">
                <small class="italic">Chats</small> 
                <img class="rounded-lg h-32 w-full" src="{{ Vite::asset('public/storage/site_photos/Chats.jpg') }}" alt="">
            </label>
        </div>
        <div class="checkboxAnimalsFormDiv w-full w-1/2 px-3 mb-6 md:mb-0">
            <input id="animalsCheckbox2" type="checkbox" value="2" name="chiens"
            {{($annonce->chiens === 2) ? 'checked' : ''}}>
            <label class="checkboxAnimalsForm" for="animalsCheckbox2">
                <small class="italic">Chiens</small> 
                <img class="rounded-lg" src="{{ Vite::asset('public/storage/site_photos/Chiens.jpg') }}" alt="">
            </label>
        </div>
        <div class="checkboxAnimalsFormDiv w-full w-1/2 px-3 mb-6 md:mb-0">
            <input id="animalsCheckbox3" type="checkbox" value="3" name="poissons"
            {{($annonce->poissons === 3) ? 'checked' : ''}}>
            <label class="checkboxAnimalsForm" for="animalsCheckbox3">
                <small class="italic">Poissons</small> 
                <img class="rounded-lg" src="{{ Vite::asset('public/storage/site_photos/Poissons.jpg') }}" alt="">
            </label>
        </div>
        <div class="checkboxAnimalsFormDiv w-full w-1/2 px-3 mb-6 md:mb-0">
            <input id="animalsCheckbox4" type="checkbox" value="4" name="rongeurs"
            {{($annonce->rongeurs === 4) ? 'checked' : ''}}>
            <label class="checkboxAnimalsForm" for="animalsCheckbox4">
                <small class="italic">Rongeurs</small> 
                <img class="rounded-lg" src="{{ Vite::asset('public/storage/site_photos/Lapins.jpg') }}" alt="">
            </label>
        </div>
        <div class="checkboxAnimalsFormDiv w-full w-1/2 px-3 mb-6 md:mb-0">
            <input id="animalsCheckbox5" type="checkbox" value="5" name="oiseaux"
            {{($annonce->oiseaux === 5) ? 'checked' : ''}}>
            <label class="checkboxAnimalsForm" for="animalsCheckbox5">
                <small class="italic">Oiseaux</small> 
                <img class="rounded-lg" src="{{ Vite::asset('public/storage/site_photos/Oiseaux.jpg') }}" alt="">
            </label>
        </div>
        <div class="checkboxAnimalsFormDiv w-full w-1/2 px-3 mb-6 md:mb-0">
            <input id="animalsCheckbox6" type="checkbox" value="6" name="reptiles"
            {{($annonce->reptiles === 6) ? 'checked' : ''}}>
            <label class="checkboxAnimalsForm" for="animalsCheckbox6">
                <small class="italic">Reptiles</small> 
                <img class="rounded-lg" src="{{ Vite::asset('public/storage/site_photos/Reptiles.jpg') }}" alt="">
            </label>
        </div>  
        <div class="checkboxAnimalsFormDiv w-full w-1/2 px-3 mb-6 md:mb-0">
            <input id="animalsCheckbox7" type="checkbox" value="7"  name="ferme"
            {{($annonce->ferme === 7) ? 'checked' : ''}}>
            <label class="checkboxAnimalsForm" for="animalsCheckbox7">
                <small class="italic">Animaux de la ferme</small> 
                <img class="rounded-lg" src="{{ Vite::asset('public/storage/site_photos/Chevaux.jpg') }}" alt="">
            </label>
        </div> 
        <div class="checkboxAnimalsFormDiv w-full w-1/2 px-3 mb-6 md:mb-0">
            <input id="animalsCheckbox8" type="checkbox" value="8" name="autre"
            {{($annonce->autre === 8) ? 'checked' : ''}}>
            <label class="checkboxAnimalsForm" for="animalsCheckbox8">
                <small class="italic">Autre</small> 
                <img class="rounded-lg" src="{{ Vite::asset('public/storage/site_photos/Reptiles.jpg') }}" alt="">
            </label>
        </div>  
    </div>
    <hr>
    <!-- Description / Photo -->
    <h2 class="uppercase tracking-wide text-gray-700 text-md font-bold mt-4 mb-2">
       Votre profil *
    </h2>
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="photo">
                Votre photo
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
             name="photo" type="file">
            @error('photo') <small class="text-red-600 italic"> {{ $errors->first('photo') }}</small>@enderror
        </div>
    </div>
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="description">
                Description
            </label>
            <textarea name="description" id="description" cols="30" rows="10"
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            {{ $annonce->description }}
            </textarea>
            <p class="text-gray-600 text-xs italic">Mettez quelques mots vous concernant, cela permet aux propriétaires des animaux d'avoir confiance en leur Pet-Sitter</p>
            @error('description') <small class="text-red-600 italic"> {{ $errors->first('description') }}</small>@enderror
        </div>
    </div>
    <hr>
    <!-- Prix -->
    <h2 class="uppercase tracking-wide text-gray-700 text-md font-bold mt-4 mb-2">
       Votre tarif *
    </h2>
    <div class="flex flex-wrap -mx-3 mb-6">
        <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="price">
                Prix de votre garde (par jour)
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
             id="price" type="text" name="price" value={{ $price }}>
             @error('price') <small class="text-red-600 italic"> {{ $errors->first('price') }}</small>@enderror
            <p class="text-gray-600 text-xs italic"></p>
        </div>
    </div>
    <button type="submit" class="button-perso inline-block md:px-6 py-2.5 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out w-full mb-3">
       Enregistrer les modifications
    </button>
</form>
</x-app-layout>