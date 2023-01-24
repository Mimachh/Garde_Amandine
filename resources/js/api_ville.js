$(document).ready(function(){
    const apiUrl = 'https://geo.api.gouv.fr/communes?codePostal=';
    const format = '&format=json';
    // const apiUrl2 = 'https://geo.api.gouv.fr/departements?nom=';
    // const formatDepart = "&fields=nom,code,codeRegion";

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



const form = document.getElementById('apiform');
form.addEventListener('submit', function (e) {
   

    const token = document.querySelector('meta[name="csrf-token"]').content;
    const url = this.getAttribute('action');
    console.log(url);
    let city_code = document.getElementById('city_code').value;
    console.log(city);
    
    
    fetch(url, {
        headers: {
            'X-CSRF-TOKEN': token 
        },
        method: 'post',
        body: {
            city_code: city_code}
        
    });

});