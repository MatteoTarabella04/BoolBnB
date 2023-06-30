<script>
import axios from "axios";
export default {
    setup() {


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
        }
    },
    methods: {
        addApartment() {
            // Eseguo la chiamata API per aggiungere l'appartamento al backend

            // chiamata API 
            axios.post('apartments', this.apartment)
                .then(response => {

                    console.log('Appartamento aggiunto con successo:', response.data);

                    this.$router.push('/apartments');
                })
                .catch(error => {

                    console.error('Errore durante l\'aggiunta dell\'appartamento:', error);
                });
        }
    }
}
</script>


<template>
    <div>
        <h4>Inserisci un annuncio!</h4>
        <form @submit.prevent="addApartment()">
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
            <button type="submit">Aggiungi appartamento</button>
        </form>
    </div>
</template>



<style lang="scss" scoped></style>