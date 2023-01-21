const form = document.getElementById('search-form');

form.addEventListener('submit', function (e) {
    e.preventDefault();

    const token = document.querySelector('meta[name="csrf-token"]').content;
    const url = this.getAttribute('action');
    const q = document.getElementById('q').value;
    const ville = document.getElementById('ville').value;

    // Recupère toujours la checkbox checked
    const chat = document.getElementById('chat').value; 
    // var chats = 1;
    
    if (chat.checked) {
        chat= '1';
        // chats= "1";
    } else {
        chat = 'NULL';
        // chats = 'NULL';
    }
    // console.log(chats);
    
    fetch(url, {
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token 
        },
        method: 'post',
        body: JSON.stringify({
            q: q,
            chat: chat,
            ville: ville,
        })
    }).then(response => {
        response.json().then( data => {

            const annonces = document.getElementById('annonces');
            annonces.innerHTML = '';

      
            Object.entries(data)[0][1].forEach(element => {
                annonces.innerHTML += `<h2 class="text-blue-500 font-bold">${element.name}</h2>`

            });
        })
    }).catch(error => {
        console.log(error);
    })
});