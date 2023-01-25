// const form = document.getElementById('search-form');

// form.addEventListener('submit', function (e) {
//     e.preventDefault();

//     const token = document.querySelector('meta[name="csrf-token"]').content;
//     const url = this.getAttribute('action');
//     const q = document.getElementById('q').value;
//     const ville = document.getElementById('ville').value;

//     // Recupère toujours la checkbox checked
//     var chat = document.getElementById('chat'); 
//     // var chats = 1;
    
//     if (chat.checked) {
//         chat= '1';
//         // chats= "1";
//     } else {
//         chat = 'NULL';
//         // chats = 'NULL';
//     }
//     // console.log(chats);
    
//     fetch(url, {
//         headers: {
//             'Content-Type': 'application/json',
//             'X-CSRF-TOKEN': token 
//         },
//         method: 'post',
//         body: JSON.stringify({
//             q: q,
//             chat: chat,
//             ville: ville,
//         })
//     }).then(response => {
//         response.json().then( data => {

//             const annonces = document.getElementById('annonces');
//             annonces.innerHTML = '';

      
//             Object.entries(data)[0][1].forEach(element => {
//                 annonces.innerHTML += `
//                 <img src="/storage/annonces_photos/${element.photo}"/>
//                 <p>${element.ville_id}</p>
//                 <div class="w-full md:px-4 max-h-62 lg:px-0">
//                 <div class="p-3 bg-white rounded shadow-md hover:shadow-2xl">
//                     <div id="img">
//                         <div class="rounded aspect-w-1 aspect-h-1  overflow-hidden xl:aspect-w-7 xl:aspect-h-8">
//                         <!--if(isset($annonce->photo))-->
//                         <img src="/storage/annonces_photos/${element.photo}" alt="Photo de l'annonce" 
//                         class="mx-auto w-full h-full rounded  rounded-lg object-cover object-center group-hover:opacity-75">
//                         <!--@else-->
//                         <img src="https://cdn.pixabay.com/photo/2018/02/25/07/15/food-3179853__340.jpg" alt="Butter photo"
//                             class="object-fill w-full h-full rounded">
//                         <!--@endif-->
//                     </div>
//                         <div class="flex-auto p-2 justify-evenly">
//                             <div class="flex flex-wrap">
//                                 <div class="flex items-center justify-between w-full min-w-0 ">
//                                     <h2 class="mr-auto text-lg cursor-pointer hover:text-gray-900" id="name">${element.name}</h2>
//                                     <!--@auth-->
//                                         <!--@if($annonce->user_id !== auth()->user()->id)-->
//                                             <livewire:ad-fav>
//                                             <!--@if($annonce->fav->count() > 0)
//                                                 <div>
//                                                     ({{ $annonce->fav_count() }})
//                                                 </div>
//                                             @endif
//                                         @endif
//                                     @endauth-->
//                                     <!--@guest-->
//                                         <livewire:ad-fav>
//                                     <!--@endguest-->
//                                 </div>
//                                 <div class="mb-4">
//                                     <!-- Prix -->
//                                         <p class="my-1 text-lg font-medium text-gray-900 pb-3">
//                                             @auth
//                                                 @if($annonce->user_id !== auth()->user()->id)
//                                                     {{ $annonce->getRealPrice() }} / jour
//                                                 @else
//                                                     {{ $annonce->getPrice() }} / jour
//                                                 @endif
//                                             @endauth    
//                                             @guest
//                                                 {{ $annonce->getRealPrice() }} / jour
//                                             @endguest
//                                         </p>
//                                     <!-- Fin prix-->
    
//                                     <!-- Dispo -->
//                                     @if($annonce->start_watch && $annonce->end_watch !== null)
//                                     <div class="flex">
//                                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="w-4 h-4">
//                                             <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5m-9-6h.008v.008H12v-.008zM12 15h.008v.008H12V15zm0 2.25h.008v.008H12v-.008zM9.75 15h.008v.008H9.75V15zm0 2.25h.008v.008H9.75v-.008zM7.5 15h.008v.008H7.5V15zm0 2.25h.008v.008H7.5v-.008zm6.75-4.5h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V15zm0 2.25h.008v.008h-.008v-.008zm2.25-4.5h.008v.008H16.5v-.008zm0 2.25h.008v.008H16.5V15z" />
//                                         </svg>
//                                         <p class="text-sm text-gray-600 pb-3 pl-1">
//                                             Disponible du : <span class="text-md text-gray-800">{{ $annonce->start_date_fr() }}</span>  
//                                             au : <span class="text-md text-gray-800">{{ $annonce->end_date_fr() }}</span>
//                                         </p>
//                                     </div>
//                                     @endif
//                                     <!-- Fin dispo --> 
//                                     <!-- Ville -->
//                                     @if($annonce->ville_id !== null)
//                                     <div class="flex">
//                                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="blue" class="w-4 h-4">
//                                             <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
//                                         </svg>
//                                         <p class="text-sm text-gray-600 pl-1 pb-3"><span class="text-md text-gray-800"> Ville : {{ $annonce->ville->ville_nom_reel }}</span></p>    
//                                     </div>
//                                     @endif
//                                     <!--Fin ville -->
//                                     <!-- Type de garde -->
//                                     <p class="text-sm text-gray-600 pb-3">Type de garde :               
//                                         <span class="text-sm text-gray-800">{{$annonce->garde->garde}}</span>       
//                                     </p>
//                                     <!-- Fin type de garde -->
                                            
//                                     <p class="text-sm text-gray-600 pb-2">Animaux gardés :
                                            
//                                         <p class="text-sm text-gray-800">{{ $annonce->chats ? 'Chats' : ''}}
//                                             {{ $annonce->chiens ? ' Chiens' : ''}} 
//                                             {{ $annonce->poissons ? ' Poissons' : ''}}
//                                             {{ $annonce->rongeurs ? ' Rongeurs' : ''}} 
//                                             {{ $annonce->oiseaux ? ' Oiseaux' : ''}} 
//                                             {{ $annonce->reptiles ? ' Reptiles' : ''}} 
//                                             {{ $annonce->ferme ? ' Animaux de la ferme' : ''}}
    
//                                         </p>
//                                     </p>   
//                                 </div>
//                             </div>
//                             <button class="button-perso inline-block md:px-6 py-2.5 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out w-full mb-3">
//                                 <a class="py-2 px-20" href="{{ route('annonces.show', $annonce) }}">Voir l'annonce</a> 
//                             </button>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//                 `

//             });
//         })
//     }).catch(error => {
//         console.log(error);
//     })
// });




$(document).ready(function(){
    
    // FIND REGION WITH API
    let regionName = $('#regionName'); let regionCode = $('#regionCode'); let errorMessageRegionName = $('#error-message-region-name'); 
    
    const regionUrl = 'https://geo.api.gouv.fr/regions?nom=';
    const regionUrlEnd = '&fields=nom,code';
    $(regionName).on('blur', function(){
        let code = $(this).val();
        //console.log(code);
        let url = regionUrl + code + regionUrlEnd;
        //console.log(url);

        fetch(url,{method: 'get'}).then(response => response.json()).then(results =>{
            // console.log(results);
            $(regionCode).find('option').remove();
            if(results.length){
                //console.log(results);
                //console.log(results[0]['code']);
                 $(errorMessageRegionName).text('').hide();
                $.each(results, function(key, value){
                    // console.log(value);
                    $(regionCode).append('<option value="'+results[0]['code']+'">'+results[0]['code']+'</option>')
                    let r = document.getElementById('regionCode').value;
                    //console.log(r);
                });
            }
            else{
                if($(regionName).val()){
                    console.log('Ce nom ne correspond à aucune région.');
                    $(errorMessageRegionName).text('Ce nom ne correspond à aucune région.').show();
                }
                else{
                    $(errorMessageRegionName).text('').hide();
                }
            }
        }).catch(err => {
            console.log(err);
            $(city_code).find('option').remove();
        });
    });


    // FIND DEPARTEMENT WITH API
    const apiUrlDepartement = 'https://geo.api.gouv.fr/departements?code=';
    const formatDepartement = '&fields=nom,code,codeRegion&format=json';
    let departementCode = $('#departementcode'); let errorMessageDepartement = $('#error-message-departement'); 

    $(departementCode).on('blur', function(){
        let code = $(this).val();
        //console.log(code);
        let url = apiUrlDepartement + code + formatDepartement;
        //console.log(url);

        fetch(url,{method: 'get'}).then(response => response.json()).then(results =>{
            //console.log(results);
            //$(city_code).find('option').remove();
            if(results.length){
                $(errorMessageDepartement).text('').hide();
                //$.each(results, function(key, value){
                   // console.log(value);
                    //console.log(value.nom);
                    // $(city_code).append('<option value="'+value.code+'">'+value.nom+'</option>')
                    // let q = document.getElementById('city_code').value;
                    // console.log(q);
                //});
            }
            else{
                if($(departementcode).val()){
                    console.log('Aucun département correspondant.');
                    $(errorMessageDepartement).text('Aucun département correspondant.').show();
                }
                else{
                    $(errorMessageDepartement).text('').hide();
                }
            }
        }).catch(err => {
            console.log(err);
            $(departementcode).find('option').remove();
        });
    });


    //FIND COMMUNE WITH API
    const apiUrl = 'https://geo.api.gouv.fr/communes?codePostal=';
    const format = '&format=json';
    let zipcode = $('#zipcode'); let city_code = $('#city_code'); let errorMessage = $('#error-message');

    $(zipcode).on('blur', function(){
        let code = $(this).val();
        //console.log(code);
        let url = apiUrl + code + format;
        //console.log(url);

        fetch(url,{method: 'get'}).then(response => response.json()).then(results =>{
            //console.log(results);
            $(city_code).find('option').remove();
            if(results.length){
                $(errorMessage).text('').hide();
                $.each(results, function(key, value){
                   // console.log(value);
                    //console.log(value.nom);
                    $(city_code).append('<option value="'+value.code+'">'+value.nom+'</option>')
                    let q = document.getElementById('city_code').value;
                    console.log(q);
                });
            }
            else{
                if($(zipcode).val()){
                    console.log('Erreur de code postal.');
                    $(errorMessage).text('Aucune commune avec ce code postal.').show();
                }
                else{
                    $(errorMessage).text('').hide();
                }
            }
        }).catch(err => {
            console.log(err);
            $(city_code).find('option').remove();
        });
    });
});


const form = document.getElementById('searchForm');
form.addEventListener('submit', function (e) {
   
    const token = document.querySelector('meta[name="csrf-token"]').content;
    const url = this.getAttribute('action');
    let city_code = document.getElementById('city_code').value;
    console.log(url);
    console.log(regionCode);
    
    fetch(url, {
        headers: {
            'X-CSRF-TOKEN': token 
        },
        method: 'post',
        body: {
            regionCode: regionCode,
            city_code: city_code }
        
    });

});