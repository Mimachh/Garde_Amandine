<x-app-layout>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
     integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
     crossorigin=""/>

    
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-200 leading-tight text-center">
            Annonce de {{$annonce->user->name}}
        </h1>
    </x-slot>
    
    <x-slot name="buttonBack">
        @livewire('previous-page')
    </x-slot>

    <section class="mb-24 md:mb-8">
        <!-- Annonce -->
        <div class="md:grid md:grid-cols-3 md:gap-4 relative">
            <div class="col-span-2 md:ml-24 space-y-4">
                <div class="aspect-w-1 aspect-h-1">
                    <img class="rounded-md  w-full h-80 md:w-3/4 object-cover object-center group-hover:opacity-75 " src="{{ asset('storage/annonces_photos/' . $annonce->photo) }}">
                </div>
                <div class="space-y-4 ml-2 md:ml-0">
                    <hr>
                    <!-- Name and Price -->
                    <div>
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg md:text-xl font-bold">Je m'appelle {{ $annonce->user->name }}</h2>
                            @if($annonce->user_id !== auth()->user()->id)
                                <div class="flex items-end mr-8">
                                    <livewire:ad-fav :annonce="$annonce">
                                    @if($annonce->fav->count() > 0)
                                        <div>
                                            ({{$annonce->fav->count()}})
                                        </div>
                                    @endif
                                </div>
                            @endif
                            @if($annonce->user_id === auth()->user()->id)
                                <div class="flex mr-8 space-x-4">
                                    @can('update', $annonce)
                                    <a href="{{ route('annonces.edit', $annonce) }}">
                                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M11 4.00023H6.8C5.11984 4.00023 4.27976 4.00023 3.63803 4.32721C3.07354 4.61483 2.6146 5.07377 2.32698 5.63826C2 6.27999 2 7.12007 2 8.80023V17.2002C2 18.8804 2 19.7205 2.32698 20.3622C2.6146 20.9267 3.07354 21.3856 3.63803 21.6732C4.27976 22.0002 5.11984 22.0002 6.8 22.0002H15.2C16.8802 22.0002 17.7202 22.0002 18.362 21.6732C18.9265 21.3856 19.3854 20.9267 19.673 20.3622C20 19.7205 20 18.8804 20 17.2002V13.0002M7.99997 16.0002H9.67452C10.1637 16.0002 10.4083 16.0002 10.6385 15.945C10.8425 15.896 11.0376 15.8152 11.2166 15.7055C11.4184 15.5818 11.5914 15.4089 11.9373 15.063L21.5 5.50023C22.3284 4.6718 22.3284 3.32865 21.5 2.50023C20.6716 1.6718 19.3284 1.6718 18.5 2.50022L8.93723 12.063C8.59133 12.4089 8.41838 12.5818 8.29469 12.7837C8.18504 12.9626 8.10423 13.1577 8.05523 13.3618C7.99997 13.5919 7.99997 13.8365 7.99997 14.3257V16.0002Z" stroke="#ff9200" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                    </a>
                                    @endcan
                                    @can('delete', $annonce)
                                    <a href="">
                                        <livewire:annonces.delete-annonce-comp :annonce="$annonce">
                                    </a>
                                    @endcan                    
                                </div>
                            @endif
                        </div>
                        <p class="font-medium">Prix : 
                            @auth
                                {{ $annonce->getPrice() }} / jour
                            @endauth    
                            @guest
                                {{ $annonce->getRealPrice() }} / jour
                            @endguest
                        </p>
                    </div>
                    <hr>
                    <!-- Dispo -->
                    <div>
                        <!-- Dispo -->
                            @if($annonce->start_watch && $annonce->end_watch !== null)
                                <div class="flex">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
                                    </svg>
                                    <p class="font-medium">
                                        Disponible du <span class="font-normal">{{ $annonce->start_date_fr() }}</span>  
                                        au <span class="font-normal">{{ $annonce->end_date_fr() }}</span>
                                    </p>
                                </div>
                            @endif
                        <!-- Fin dispo -->
                    </div>
                    <hr>
                    <!-- Localisation -->
                    <div>
                        <div class="flex">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="blue" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                            </svg>
                            <p class="font-medium">Localisation : <span class="font-normal"> {{ $annonce->ville_name }}</span></p>    
                        </div>
                    </div>
                    <hr>
                    <!-- Conditions -->
                    <div>
                        <div class="flex">
                            <p class="font-medium">Type de garde : <span class="font-normal">{{$annonce->garde->garde}}</span></p>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>    
                        @if($annonce->habitation_id !== 3)
                            <div class="flex">
                                <p class="">{{$annonce->habitation->hab}}</p>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        @endif
                        @if($annonce->exterieur_id !== 3)
                            <div class="flex">
                                <p>{{$annonce->exterieur->ext}}</p>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        @endif       
                    </div>
                    <hr>
                    <!-- Animals -->
                    <div>
                        <p class="font-medium">Animaux acceptés :</p>
                        @if(isset($watches[0]))
                            @foreach($watches as $watch)
                                @if(isset($watch[0]))
                                    <div class="flex">
                                        <p class="mr-2">{{$watch[0]['espece']}}</p>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>         
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <hr>
                    <!-- Description -->
                    <div>
                        <h3 class="font-medium">Description :</h3>
                        <p>{{ $annonce->description }}</p>
                        <hr>
                    </div>   
                </div>
                <small>Pour des raisons évidentes de sécurité et de confidentialité le point indiqué sur la carte 
                    représente le centre géographique de la ville/commune.
                </small>
                <div id="adMap" class="mx-2"></div>
            </div>
            <div>
                <!-- Button card -->
                @if($annonce->user_id !== auth()->user()->id)
                <div class="fixed bottom-0 left-0 right-0 md:static">
                    <div class="bg-gray-200 shadow shadow-gray-800 hover:shadow-xl py-6 md:py-0 rounded-md text-center md:mr-4">
                        <h4 class="font-medium text-md mb-4 pt-4">Contacter le Pet-Sitter</h4>
                        <div class="mr-24">
                        <a href="{{route('demandes.create', $annonce->id)}}" class="ml-12">
                            <button type="button" 
                                class="hover:bg-orange-700 w-full rounded-md bg-orange-500 font-medium text-white py-2 mb-4">
                                Contacter
                            </button>
                        </a> 
                        </div>    
                    </div>
                </div>
                @endif
                <div>
                    PUB
                </div>
            </div>
        </div>

        <!-- Animals -->
        <div class="col-span-3 text-center">
            <h3 class="text-green-700 font-bold text-3xl pb-2">Je vous présente mes animaux </h3>
        </div>
        @if(auth()->user()->id === $annonce->user_id)
            <p class="ml-10 mt-2">Ajouter un animal en cliquant <a class="text-blue-600" href="{{ route('animals.create') }}">ici.</a></p> 
        @endif

        <div class="mt-8 md:grid md:grid-cols-3 md:gap-4">
            @forelse($animals as $animal)
            <div class="grid-col-span-1 md:ml-24 bg-green-400">
                <div>
                    PUB
                </div>
            </div>
            <div class="md:ml-24 col-span-2 space-y-4">
                <div class="aspect-w-1 aspect-h-1">
                    <img class="rounded-md  w-full h-80 md:w-3/4 object-cover object-center group-hover:opacity-75 " src="{{ asset('storage/animals_photos/' . $animal->photo) }}">
                </div>
                <div class="space-y-4 ml-2 md:ml-0">
                    <hr>
                    <!-- Name -->
                    <div>
                        <div class="flex items-center justify-between">
                            <h2 class="text-lg md:text-xl font-bold">{{ $animal->animal_name }}</h2>
                            @if($animal->user_id === auth()->user()->id)
                                <div class="flex mr-8 space-x-4">
                                    @can('update', $animal)
                                    <a href="{{ route('animals.edit', $animal) }}">
                                        <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M11 4.00023H6.8C5.11984 4.00023 4.27976 4.00023 3.63803 4.32721C3.07354 4.61483 2.6146 5.07377 2.32698 5.63826C2 6.27999 2 7.12007 2 8.80023V17.2002C2 18.8804 2 19.7205 2.32698 20.3622C2.6146 20.9267 3.07354 21.3856 3.63803 21.6732C4.27976 22.0002 5.11984 22.0002 6.8 22.0002H15.2C16.8802 22.0002 17.7202 22.0002 18.362 21.6732C18.9265 21.3856 19.3854 20.9267 19.673 20.3622C20 19.7205 20 18.8804 20 17.2002V13.0002M7.99997 16.0002H9.67452C10.1637 16.0002 10.4083 16.0002 10.6385 15.945C10.8425 15.896 11.0376 15.8152 11.2166 15.7055C11.4184 15.5818 11.5914 15.4089 11.9373 15.063L21.5 5.50023C22.3284 4.6718 22.3284 3.32865 21.5 2.50023C20.6716 1.6718 19.3284 1.6718 18.5 2.50022L8.93723 12.063C8.59133 12.4089 8.41838 12.5818 8.29469 12.7837C8.18504 12.9626 8.10423 13.1577 8.05523 13.3618C7.99997 13.5919 7.99997 13.8365 7.99997 14.3257V16.0002Z" stroke="#ff9200" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                    </a>
                                    @endcan
                                    @can('delete', $animal)
                                    <a href="">
                                        <livewire:animals.delete-animal-comp :animal="$animal">
                                    </a>
                                    @endcan                    
                                </div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <!-- Type -->
                    <div class="font-medium">
                        <p class="">{{$animal->espece->espece}}</p>
                        <p class="">{{$animal->race->race_animal}}</p>
                    </div>
                    <hr>
                    <!-- Personnality -->
                    <div>
                        <div>
                            <p class="font-medium">Sa personnalité : <span class="font-normal"> {{ $animal->personnality }}</span></p>    
                        </div>
                    </div>
                    <hr>
                    <!-- Age -->
                    <div>
                        <div class="flex">
                            <svg class="h-6 w-6" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--emojione-monotone" preserveAspectRatio="xMidYMid meet" fill="#000000" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M38.026 30.765a35.948 35.948 0 0 0 2.005-.265v-4.701c-1.024.489-2.092.791-3.154 1.025c-2.693.563-5.432.629-8.146.345c-1.368-.173-2.685-.399-4.049-.884c-.27-.102-.538-.216-.805-.344v4.226c4.682.767 9.443 1.092 14.149.598" fill="#ff40ff"></path><path d="M56.299 41.987V24.841c0-1.988-1.366-3.839-3.703-5.407v-7.509c0-.735-.583-1.343-1.342-1.458c.557-.236.951-.723.951-1.309c0-.813-1.652-3.437-1.652-3.437s-1.654 2.623-1.654 3.437c0 .578.385 1.061.931 1.301c-.802.08-1.431.703-1.431 1.466v5.385a35.157 35.157 0 0 0-4.49-1.377a1.6 1.6 0 0 0 .123-.596c0-.983-2-4.154-2-4.154s-1.83 2.904-1.984 4.014c-1.959-.289-4.044-.457-6.195-.525V7.467c0-.661-.512-1.213-1.188-1.334c.461-.215.783-.631.783-1.126C33.447 4.295 32 2 32 2s-1.447 2.295-1.447 3.007c0 .489.314.901.766 1.118c-.713.092-1.266.655-1.266 1.342v7.206c-2.103.07-4.142.236-6.06.518c-.188-1.135-1.981-3.979-1.981-3.979s-2 3.17-2 4.154c0 .197.045.383.111.56a34.638 34.638 0 0 0-4.633 1.429V11.94c0-.734-.584-1.342-1.344-1.457c.557-.236.953-.724.953-1.31c0-.813-1.654-3.437-1.654-3.437s-1.654 2.623-1.654 3.437c0 .578.386 1.061.932 1.301c-.803.081-1.432.704-1.432 1.466v7.574c-2.267 1.552-3.592 3.374-3.592 5.328V41.99C4.117 44.066 2 46.62 2 49.383C2 56.352 15.432 62 32 62s30-5.648 30-12.617c0-2.764-2.118-5.318-5.701-7.396M49.725 9.943c0-.407.828-1.719.828-1.719s.828 1.312.828 1.719a.677.677 0 0 1-.249.512c-.046-.004-.091-.013-.138-.013h-.992c-.013 0-.024.003-.037.003a.67.67 0 0 1-.24-.502m-.327 1.982c0-.262.276-.482.604-.482h.992c.326 0 .602.221.602.482v10.797a.422.422 0 0 1-.116.284l-.368.188a.708.708 0 0 1-.117.011h-.992c-.327 0-.604-.222-.604-.483V11.925zm-7.367 2.284s1.002 1.585 1.002 2.077c0 .491-.449.89-1.002.89s-1-.398-1-.89s1-2.077 1-2.077M31.277 5.693c0-.355.723-1.502.723-1.502s.725 1.146.725 1.502a.59.59 0 0 1-.197.427c-.048-.005-.094-.014-.143-.014h-.867c-.018 0-.034.004-.052.005a.583.583 0 0 1-.189-.418m-.224 1.774c0-.195.213-.36.465-.36h.867c.253 0 .467.165.467.36v9.448a.294.294 0 0 1-.078.195l-.305.157a.583.583 0 0 1-.084.006h-.867c-.252 0-.465-.164-.465-.358V7.467m-9.041 6.769s1 1.586 1 2.078c0 .49-.447.89-1 .89s-1-.399-1-.89c0-.492 1-2.078 1-2.078m-9.393-4.28c0-.405.826-1.717.826-1.717s.828 1.312.828 1.717a.677.677 0 0 1-.25.514c-.046-.004-.09-.013-.137-.013h-.992c-.012 0-.023.003-.035.003a.677.677 0 0 1-.24-.504m-.328 1.982c0-.261.276-.481.604-.481h.992c.327 0 .604.221.604.481v10.798a.417.417 0 0 1-.117.282l-.368.189a.72.72 0 0 1-.118.011h-.992c-.327 0-.604-.221-.604-.482V11.938zm-1.104 11.643c.033-.17.099-.325.158-.483c.066.242.196.459.373.638c-.078.571.062 1.15.367 1.651c.649 1.043 1.76 1.773 2.892 2.353c1.585.789 3.291 1.292 5.035 1.688V19.249c0-.265.127-.497.313-.688c-.288.056-.578.098-.864.162c-1.345.306-2.713.711-3.971 1.296v-.529c.015-.007.029-.015.044-.021c1.228-.549 2.509-.952 3.808-1.26a41.605 41.605 0 0 1 7.928-1.046c.935-.035 1.872-.03 2.81-.007c.097.492.479.886.98 1.041a40.685 40.685 0 0 0-3.778-.213a43.034 43.034 0 0 0-4.439.208c.589.114 1.035.532 1.035 1.057v1.832l.053-.026c.686-.298 1.365-.47 2.051-.6c1.369-.252 2.74-.307 4.105-.229c1.372.095 2.712.285 4.052.856c.33.15.659.333.964.609c.289.253.628.744.492 1.306c-.145.524-.506.79-.814.994a4.03 4.03 0 0 1-1.002.44c-1.357.393-2.73.389-4.073.218c-.673-.107-1.329-.231-1.969-.54c-.297-.162-.649-.359-.753-.777c-.057-.461.34-.701.616-.847l.072.131c-.264.16-.526.422-.45.664s.375.41.653.527c.573.229 1.245.312 1.88.36c1.285.069 2.612-.053 3.784-.456c.526-.169 1.18-.601 1.206-.9c.082-.214-.438-.64-.99-.827c-1.125-.414-2.458-.54-3.719-.587c-1.276-.029-2.566.069-3.794.34c-.609.136-1.213.318-1.734.567a4.123 4.123 0 0 0-.63.375v1.517c.372.258.839.472 1.323.642c1.137.389 2.449.607 3.705.741c2.545.269 5.159.183 7.659-.286c1.229-.242 2.446-.587 3.467-1.171V20.52c-.402-.24-.827-.46-1.276-.648c-1.157-.485-2.412-.806-3.689-1.075a42.754 42.754 0 0 0-3.36-.522h.68c.125 0 .249-.015.37-.045l.544-.264l.104-.071c.153-.138.268-.301.344-.479c.514.063 1.027.125 1.539.213c1.319.231 2.652.521 3.958 1.015c.283.106.563.229.841.361c.126-.501.638-.887 1.28-.887h1.199c.736 0 1.334.496 1.334 1.106V29.63c3.086-.913 6.008-2.354 8.468-4.521l.104.107c-1.798 1.965-4.084 3.494-6.544 4.568c-.665.287-1.342.544-2.027.779v.837c0 .304-.148.581-.389.78l-.6.288a1.69 1.69 0 0 1-.346.039h-1.199c-.653 0-1.172-.397-1.287-.913c-.633.127-1.27.236-1.908.324c-4.763.653-9.605.425-14.306-.44a1.03 1.03 0 0 1-.374.729l-.6.287c-.109.024-.227.04-.346.04h-1.199c-.738 0-1.334-.496-1.334-1.107v-.821c-1.87-.511-3.719-1.16-5.432-2.131c-1.165-.685-2.331-1.519-3.032-2.784c-.342-.628-.511-1.39-.362-2.11m43.112 23.756c0 3.881-9.536 8.221-22.299 8.221c-12.764 0-22.301-4.34-22.301-8.221v-3.974c.984-.053 1.77-.766 1.77-1.645v-3.855c0-1.214 1.119-2.198 2.5-2.198s2.502.984 2.502 2.198v4.756c0 1.412 1.303 2.558 2.908 2.558c1.607 0 2.91-1.146 2.91-2.558V37.76c0-1.271 1.172-2.3 2.617-2.3c1.447 0 2.619 1.029 2.619 2.3v3.098c0 .707.65 1.279 1.455 1.279c.803 0 1.453-.572 1.453-1.279V38.4c0-.918.848-1.662 1.893-1.662c1.043 0 1.889.744 1.889 1.662v4.22c0 1.412 1.305 2.558 2.91 2.558c1.607 0 2.91-1.146 2.91-2.558v-4.73c0-1.2 1.107-2.174 2.473-2.174s2.473.974 2.473 2.174v3.452c0 .706.65 1.278 1.455 1.278c.803 0 1.455-.572 1.455-1.278v-2.417c0-.629.578-1.139 1.293-1.139c.717 0 1.297.51 1.297 1.139v3.695c0 1.412 1.301 2.558 2.908 2.558c.32 0 .622-.057.91-.141v2.3" fill="#ff40ff"></path></g></svg>
                            <label for="age" class="ml-2 my-1 font-medium">Son âge : <span class="font-normal">{{ $animal->age->age}}</span></label>   
                        </div>      
                    </div>
                    <hr>
                    @if($animal->sexe)
                    <!-- Sexe -->
                    <div>
                        <div class="flex">
                            @if($animal->sexe_id === 1 )
                                <svg class="h-6 w-6" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--noto" preserveAspectRatio="xMidYMid meet" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M106.7 6.9H76.53c-2.23 0-4.06 1.83-4.06 4.06v8.13c0 2.23 1.83 4.06 4.06 4.06h16.26c.91 0 1.32 1.12.71 1.73L71.25 46.03c-17.06-11.58-40.83-9.34-55.35 6.6c-15.03 16.36-14.83 41.85.3 58c16.56 17.57 44.28 17.88 61.24.91c14.73-14.73 16.45-37.48 5.18-54.03l22.25-21.15c.61-.61 1.73-.2 1.73.71v16.26c0 2.23 1.83 4.06 4.06 4.06h8.13c2.23 0 4.06-1.83 4.06-4.06V10.96c0-2.23-1.83-4.06-4.06-4.06H106.7zM65.46 99.45c-9.95 9.95-26.2 9.95-36.26 0s-9.95-26.2 0-36.16s26.2-9.95 36.26 0s9.95 26.21 0 36.16z" fill="#171879"></path><linearGradient id="IconifyId17ecdb2904d178eab10096" gradientUnits="userSpaceOnUse" x1="63.803" y1="-1538.156" x2="63.803" y2="-1653.779" gradientTransform="matrix(1 0 0 -1 0 -1534)"><stop offset="0" stop-color="#bf6e26"></stop><stop offset=".705" stop-color="#00b29a"></stop><stop offset="1" stop-color="#00ab94"></stop></linearGradient><path d="M106.71 3.87H76.54c-2.23 0-4.06 1.83-4.06 4.06v7.09c0 2.23 1.83 4.06 4.06 4.06H92.8c.91 0 2.27 1.28.71 2.76L71.26 43c-17.06-11.58-40.83-9.34-55.35 6.6c-15.03 16.35-14.83 40.81.3 56.96c16.56 17.57 44.28 17.88 61.24.91c14.73-14.73 15.58-37.54 4.31-54.1l22.49-21.24c1.35-1.2 2.56.62 2.36 1.9v15.22c0 2.23 1.83 4.06 4.06 4.06h8.13c2.23 0 4.06-1.83 4.06-4.06V7.94c0-2.23-1.83-4.06-4.06-4.06c.1-.01-12.09-.01-12.09-.01zM65.47 96.43c-9.95 9.95-26.2 9.95-36.26 0s-9.95-27.24 0-37.19s26.2-9.95 36.26 0s9.95 27.23 0 37.19z" fill="url(#IconifyId17ecdb2904d178eab10096)"></path><path d="M86.19 7.33c0-.91-.61-1.22-4.27-1.02c-3.05.1-4.47.51-5.38 1.52s-1.12 3.35-1.22 5.99c0 1.93 0 3.66 1.02 3.66c1.42 0 1.42-3.15 2.44-4.88c2.03-3.34 7.41-4.05 7.41-5.27z" opacity=".3" fill="#ffffff"></path><path d="M109.1 40.59c-.91 0-1.22.61-1.02 4.27c.1 3.05.51 4.47 1.52 5.38s3.35 1.12 5.99 1.22c1.93 0 3.66 0 3.66-1.02c0-1.42-3.15-1.42-4.88-2.44c-3.34-2.02-4.05-7.41-5.27-7.41z" opacity=".3" fill="#ffffff"></path><path d="M17.07 53.61c3.82-5.8 11.93-11.96 20.77-13.45c2.19-.4 4.37-.5 6.26.2c1.39.5 2.58 1.89 1.79 3.38c-.6 1.19-4.23 1.07-5.53 1.46c-4.54 1.16-8.26 2.51-11.22 4.41c-3.94 2.53-7.68 7.07-9.36 10.04c-3.19 5.63-4.27 10.71-6.85 8.82c-2.48-1.7.32-9.05 4.14-14.86z" opacity=".3" fill="#ffffff"></path></g></svg>
                            @elseif($animal->sexe_id === 2)
                                <svg class="h-6 w-6" viewBox="0 0 128 128" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--noto" preserveAspectRatio="xMidYMid meet" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M101.49 44.51c0-21.5-17.87-38.91-39.55-38.1c-19.68.82-35.73 16.69-36.64 36.38c-.91 19.32 12.7 35.65 30.84 39.18v11.64H40.36c-2 0-3.63 1.63-3.63 3.63v7.26c0 2 1.63 3.63 3.63 3.63h15.78v12.85c0 2 1.63 3.63 3.63 3.63h7.26c2 0 3.63-1.63 3.63-3.63v-12.85h15.78c2 0 3.63-1.63 3.63-3.63v-7.26c0-2-1.63-3.63-3.63-3.63H70.65V81.88c17.6-3.35 30.84-18.77 30.84-37.37zm-61.22-.41c.19-16.02 12.77-22.66 23.13-22.45c12.77.26 23.09 9.27 22.86 22.86c-.22 12.61-10.25 22.86-22.86 22.86S40.1 58.25 40.27 44.1z" fill="#1070c4"></path><path d="M101.5 41.24c0-21.5-17.87-38.91-39.55-38.1c-19.68.82-35.74 16.7-36.64 36.38C24.4 58.84 38 73.17 56.15 76.71v13.64H40.37c-2 0-3.63 1.63-3.63 3.63v6.26c0 2 1.71 3.15 3.7 3.15h15.78l-.07 13.33c0 2 1.63 3.63 3.63 3.63h7.26c2 0 3.63-1.63 3.63-3.63l.07-13.33h15.78c2 0 3.56-1.16 3.56-3.15v-6.26c0-2-1.63-3.63-3.63-3.63H70.66V76.61c17.6-3.35 30.84-16.77 30.84-35.37zm-61.23-.41c-.01-14.91 10-23.9 23.02-23.9c14.73 0 23.34 11.57 23.07 24.97c-.24 12.61-10.35 22.2-22.96 22.2s-23.12-9.12-23.13-23.27z" fill="#fe70ff"></path><path d="M36.99 18.34c4.03-4.9 11.42-10.36 19.56-11.31c2.01-.26 4.01-.25 5.7.47c1.25.52 2.27 1.84 1.48 3.16c-.6 1.06-3.14 1.72-4.33 2.03c-4.19.85-7.65 1.91-10.44 3.5c-3.71 2.12-7.33 6.09-8.99 8.72c-3.16 4.99-5.16 8.63-7.42 6.78c-2.2-1.66.32-8.35 4.44-13.35z" opacity=".3" fill="#ffffff"></path><path d="M48.37 92.81c0-.74-.45-.99-3.13-.82c-2.23.08-4.83.41-5.5 1.24c-.67.91-.82 2.72-.89 4.86c0 1.57 0 2.97.74 2.97c1.04 0 1.04-2.55 1.79-3.95c1.49-2.65 6.99-3.31 6.99-4.3z" opacity=".3" fill="#ffffff"></path><path d="M58.64 109.25c-.82 0-1.09.46-.91 3.25c.09 2.32.27 4.25 1.18 4.95c1 .7 3.18.81 5.53.89c1.72 0 2.52.04 2.52-.73c0-1.08-1.51-.26-4.23-2.44c-2.71-2.17-3.09-5.92-4.09-5.92z" opacity=".3" fill="#ffffff"></path></g></svg>
                            @endif
                            <label for="sexe" class="ml-2 my-1 font-medium">Son sexe : <span class="font-normal">{{ $animal->sexe->sexe}}</span></label>   
                        </div>      
                    </div>
                    <hr>
                    @endif
                    <!-- Animals -->
                    <div>
                        <p class="font-medium">S'entend bien avec :
                            @if($animal->male_dogs === 1)
                                <div class="flex">
                                    <p class="text-gray-800 mr-2">Chiens mâles</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @endif

                            @if($animal->female_dogs === 1)
                                <div class="flex">
                                    <p class="text-gray-800 mr-2">Chiens femelles</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @endif

                            @if($animal->male_cats  === 1)
                                <div class="flex">
                                    <p class="text-gray-800 mr-2">Chats mâles</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @endif

                            @if($animal->female_cats  === 1)
                                <div class="flex">
                                    <p class="text-gray-800 mr-2">Chats femelles</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @endif

                            @if($animal->male_rongeurs  === 1)
                                <div class="flex">
                                    <p class="text-gray-800 mr-2">Rongeurs mâles</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @endif

                            @if($animal->female_rongeurs === 1)
                                <div class="flex">
                                    <p class="text-gray-800 mr-2">Rongeurs femelles</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @endif

                            @if($animal->birds === 1)
                                <div class="flex">
                                    <p class="text-gray-800 mr-2">Oiseaux</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @endif

                            @if($animal->reptiles === 1)
                                <div class="flex">
                                    <p class="text-gray-800 mr-2">Reptiles</p>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="green" class="w-5 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            @endif
                        </p>
                    </div>
                    <hr> 
                </div>
            </div>
            @empty
                <div class="text-center">
                    <small class="text-lg text-blue-900">Aucun animal renseigné.
                    </small>       
                </div>
            @endforelse
        </div>
    </section>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
        crossorigin="">
    </script>

    <script src="http://unpkg.com/leaflet@latest/dist/leaflet.js"></script>
    <script src="js/leaflet-providers.js"></script>

    <script>

        const apiUrl = 'https://geo.api.gouv.fr/communes?code=';
        const format = '&fields=nom,centre,contour&format=json';
        
            let code = {{$ville_code}};
            //console.log(code);
            let url = apiUrl + code + format;
            //console.log(url);

            fetch(url,{method: 'get'}).then(response => response.json()).then(results =>{


                //console.log(results);

                // Get the coordinates of the polygon and the center
                if(results.length){
                    $.each(results, function(key, value){
                        //console.log(value);
                        //console.log(value.centre.coordinates[0])
                        //console.log(value.contour.coordinates[0]);
                        var name = value.nom;
                        var coordinatesArray = value.contour.coordinates[0];
                        var coordinatesCenter = value.centre.coordinates;
                        var centerCoordinate0 = value.centre.coordinates[0];
                        var centerCoordinate1 = value.centre.coordinates[1];

                        var carte = L.map('adMap').setView([centerCoordinate1, centerCoordinate0], 12);
                        var Stadia_OSMBright = L.tileLayer('https://tiles.stadiamaps.com/tiles/osm_bright/{z}/{x}/{y}{r}.png', {
                            maxZoom: 20,
                            attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a>, &copy; <a href="https://openmaptiles.org/">OpenMapTiles</a> &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors'
                        }).addTo(carte);
                

                        var marker = L.marker([centerCoordinate1, centerCoordinate0]).addTo(carte);
                        marker.bindPopup("<h1 class='font-medium'>"+name+"</h1>");
                        var circle = L.circle([centerCoordinate1, centerCoordinate0], {
                            color: 'red',
                            fillColor: '#f03',
                            fillOpacity: 0.5,
                            radius: 500
                        }).addTo(carte);
                        
                        coordinatesArray.forEach((coordinates) => {
                            //console.log(coordinates);
                            var one = coordinates[0];
                            var two = coordinates[1]; 
                            var polygon = L.polygon([
                            [two, one]], {
                            color: 'green',
                            fillColor: '#f03',
                            fillOpacity: 0.5,
                            }).addTo(carte);
                        });
                    });
                }
            });
    </script>

</x-app-layout>