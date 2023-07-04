
// Funzione per visualizzare l'anteprima dell'immagine
function showImagePreview(input) {
    if (input.files && input.files[0]) {
        let reader = new FileReader();

        reader.onload = function (e) {
            // Mostra l'anteprima dell'immagine
            const imagePreview = document.getElementById('image-preview');
            imagePreview.src = e.target.result;
            document.getElementById('image-preview-container').classList.remove('d-none'); // Rimuovi la classe 'd-none' per visualizzare l'anteprima
        }

        reader.readAsDataURL(input.files[0]);
    }
}

// Aggiungi un gestore di eventi all'input file per chiamare la funzione di visualizzazione
document.addEventListener('DOMContentLoaded', function () {
    const imageInput = document.getElementById('image');
    imageInput.addEventListener('change', function () {
        showImagePreview(this);
    });
});
