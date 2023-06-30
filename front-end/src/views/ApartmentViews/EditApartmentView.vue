
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
                image: ""

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
        }
    }
};
</script>

<template>
    <div>
        <h2>Modifica annuncio</h2>
        <form @submit.prevent="editApartment()">
            <div>
                <label for="title">Nome:</label>
                <input type="text" id="title" v-model="apartment.title" required>
            </div>
            <div>
                <label for="description">Descrizione:</label>
                <textarea id="description" v-model="apartment.description" required></textarea>
            </div>
            <div>
                <label for="price">Prezzo a notte:</label>
                <input type="number" id="price" v-model="apartment.price_per_night" required>
            </div>
            <div>
                <label for="price">Stanze:</label>
                <input type="number" id="price" v-model="apartment.rooms" required>
            </div>
            <div>
                <label for="price">Numero di letti:</label>
                <input type="number" id="price" v-model="apartment.beds" required>
            </div>
            <div>
                <label for="price">Bagni:</label>
                <input type="number" id="price" v-model="apartment.bathrooms" required>
            </div>
            <div>
                <label for="price">Dimensione:</label>
                <input type="number" id="price" v-model="apartment.square_meters" required>
            </div>
            <div>
                <label for="price">Indirizzo:</label>
                <input type="number" id="price" v-model="apartment.address" required>
            </div>
            <div>
                <label for="price">Immagine:</label>
                <input type="number" id="price" v-model="apartment.image" required>
            </div>
            <button type="submit">Salva modifiche</button>
        </form>
    </div>
</template>

  
<style lang="scss" scoped></style>
  
  

