//Sweet Alert 2 Confirmation Delete Annonce
    window.addEventListener('show-delete-confirmation', event => {
        Swal.fire({
            title: 'Supprimer cette annonce ?',
            text: "Cette action est irreversible !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Non',
            confirmButtonText: 'Confirmer !'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteConfirmed')
                }
        })
    });
                
//Fin Sweet Alert 2 Confirmation Delete Annonce
        
// Sweet Alert 2 Confirmation Delete Animal
    window.addEventListener('show-delete-confirmation-animal', event => {
        Swal.fire({
            title: 'Supprimer cette fiche ?',
            text: "Cette action est irreversible !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Non',
            confirmButtonText: 'Confirmer !'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteAnimalConfirmed')
                }
        })
    });
                
// Fin Sweet Alert 2 Confirmation Delete Animal