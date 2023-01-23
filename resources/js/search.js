// FORM SEARCH JS
// const form = document.getElementById('search-form');

import { method } from "lodash";

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
//                 `

//             });
//         })
//     }).catch(error => {
//         console.log(error);
//     })
// });



// $(document).ready(function(){
//     const apiUrl = 'https://geo.api.gouv.fr/communes?codePostal=';
//     const format = '&format=json';
//     // const apiUrl2 = 'https://geo.api.gouv.fr/departements?nom=';
//     // const formatDepart = "&fields=nom,code,codeRegion";

//     let zipcode = $('#zipcode'); let city = $('#city'); let errorMessage = $('#error-message');

//     $(zipcode).on('blur', function(){
//         let code = $(this).val();
//         //console.log(code);
//         let url = apiUrl + code + format;
//         //console.log(url);

//         fetch(url,{method: 'get'}).then(response => response.json()).then(results =>{
//             //console.log(results);
//             $(city).find('option').remove();
//             if(results.length){
//                 $(errorMessage).text('').hide();
//                 $.each(results, function(key, value){
//                    // console.log(value);
//                     //console.log(value.nom);
//                     $(city).append('<option value="'+value.nom+ '-' +value.code+ '-' +value.codeDepartement+ '-' +value.codeRegion+'">'+value.nom+'</option>')
//                     let q = document.getElementById('city').value;
//                     console.log(q);

//                 });
//             }
//             else{
//                 if($(zipcode).val()){
//                     console.log('Erreur de code postal.');
//                     $(errorMessage).text('Aucune commune avec ce code postal.').show();
//                 }
//                 else{
//                     $(errorMessage).text('').hide();
//                 }
//             }
//         }).catch(err => {
//             console.log(err);
//             $(city).find('option').remove();
//         });
//     });
// });



// const form = document.getElementById('apiform');
// form.addEventListener('submit', function (e) {
   

//     const token = document.querySelector('meta[name="csrf-token"]').content;
//     const url = this.getAttribute('action');
//     console.log(url);
//     let city = document.getElementById('city').value;
//     console.log(city);
    
    
//     fetch(url, {
//         headers: {
//             'X-CSRF-TOKEN': token 
//         },
//         method: 'post',
//         body: {
//             city: city}
        
//     });

// });

