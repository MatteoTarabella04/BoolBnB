
<script>
import axios from "axios";
export default {
    data() {
        return {
            apartment: {
                name: "",
                description: "",
                price_per_night: 0,
                rooms: 0,
                beds: 0,
                bathrooms: 0,
                square_meters: 0,
                address: "",
                image: null

            }
        };
    },
    created() {
        // Recuperiamo l'appartamento dall'API e inizializziamo i dati del componente

        // chiamata API per ottenere l'appartamento dal backend
        axios.get(`/api/apartments/${this.$route.params.id}`)
            .then(response => {
                // Inizializza i dati dell'appartamento nel componente
                this.apartment = response.data;
            })
            .catch(error => {
                console.error('Errore durante il recupero dell\'appartamento:', error);
            });
    },
    methods: {
        editApartment() {
            // Esegui la chiamata API per aggiornare l'appartamento sul backend
            // Utilizza Axios o un'altra libreria per le chiamate API

            // Esempio di chiamata API fittizia per l'aggiornamento dell'appartamento
            axios.put(`/api/apartments/${this.$route.params.id}`, this.apartment)
                .then(response => {
                    // Aggiorna l'interfaccia utente 
                    console.log('Appartamento aggiornato con successo:', response.data);
                    // Reindirizza l'utente alla pagina degli appartamenti
                    this.$router.push('/apartments');
                })
                .catch(error => {
                    console.error('Errore durante l\'aggiornamento dell\'appartamento:', error);
                });
        },
        handleImageChange(event) {
            const file = event.target.files[0];
            this.apartment.image = file;
        },
        removeImage() {
            this.apartment.image = null;
        }
    }
}
</script>

<template>
    <div>
        <h2>Modifica annuncio</h2>
        <form @submit.prevent="editApartment()">
            <div>
                <label for="image">Aggiungi o modifica un immagine:</label>
                <input type="file" id="image" accept="image/*" @change="handleImageChange">
                <button type="button" @click="removeImage" v-if="apartment.image">Rimuovi immagine</button>
            </div>
            <div>
                <label for="name">Nome:</label>
                <input type="text" id="title" v-model="apartment.title" required>
            </div>
            <div>
                <label for="description">Descrizione:</label>
                <textarea id="description" v-model="apartment.description" required></textarea>
            </div>
            <div>
                <label for="price_per_night">Prezzo a notte:</label>
                <input type="number" id="price_per_night" v-model="apartment.price_per_night" required>
            </div>
            <div>
                <label for="rooms">Numero di Stanze:</label>
                <input type="number" id="rooms" v-model="apartment.rooms" required>
            </div>
            <div>
                <label for="beds">Numero di letti:</label>
                <input type="number" id="beds" v-model="apartment.beds" required>
            </div>
            <div>
                <label for="bathrooms">Bagni:</label>
                <input type="number" id="bathrooms" v-model="apartment.bathrooms" required>
            </div>
            <div>
                <label for="square_meters">Dimensione:</label>
                <input type="number" id="square_meters" v-model="apartment.square_meters" required>
            </div>
            <div>
                <label for="address">Indirizzo:</label>
                <input type="text" id="address" v-model="apartment.address" required>
            </div>

            <div>
                <label for="visible">Quest'appartamento è ancora disponibile al pernottamento?:</label>
                <input type="number" id="visible" v-model="apartment.visible" required>
            </div>
            <button type="submit">Salva modifiche</button>
        </form>
    </div>
</template>

  
<style lang="scss" scoped></style>
  
  

