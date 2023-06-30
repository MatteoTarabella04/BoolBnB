
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
                image: null

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
        },
        handleImageChange(event) {
            const file = event.target.files[0];
            this.apartment.image = file;
        }
    }

}
</script>


<template>
    <div class="card">
        <h4 class="card-header">Inserisci un annuncio!</h4>
        <form @submit.prevent="addApartment()">
            <div class="form-group card-image">
                <label for="image">Aggiungi un'immagine:</label>
                <input type="file" id="image" accept="image/*" @change="handleImageChange" required>
            </div>

            <div class="card-body">
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" id="name" v-model="apartment.name" required>
                </div>
                <div class="form-group">
                    <label for="description">Descrizione:</label>
                    <textarea id="description" v-model="apartment.description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="price_per_night">Prezzo a notte:</label>
                    <input type="number" id="price_per_night" v-model="apartment.price_per_night" required>
                </div>
                <div class="form-group">
                    <label for="rooms">Numero di Stanze:</label>
                    <input type="number" id="rooms" v-model="apartment.rooms" required>
                </div>
                <div class="form-group">
                    <label for="beds">Numero di letti:</label>
                    <input type="number" id="beds" v-model="apartment.beds" required>
                </div>
                <div class="form-group">
                    <label for="bathrooms">Bagni:</label>
                    <input type="number" id="bathrooms" v-model="apartment.bathrooms" required>
                </div>
                <div class="form-group">
                    <label for="square_meters">Dimensione:</label>
                    <input type="number" id="square_meters" v-model="apartment.square_meters" required>
                </div>
                <div class="form-group">
                    <label for="address">Indirizzo:</label>
                    <input type="text" id="address" v-model="apartment.address" required>
                </div>
                <div class="form-group">
                    <label for="visible">Quest'appartamento è disponibile al pernottamento?:</label>
                    <input type="number" id="visible" v-model="apartment.visible" required>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit">Aggiungi appartamento</button>
            </div>


        </form>
    </div>
    <!--  <div>
        <h4>Inserisci un annuncio!</h4>
        <form @submit.prevent="addApartment()">
            <div>
                <label for="image">Aggiungi un immagine:</label>
                <input type="file" id="image" accept="image/*" @change="handleImageChange" required>
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
                <label for="visible">Quest'appartamento è disponibile al pernottamento?:</label>
                <input type="number" id="visible" v-model="apartment.visible" required>
            </div>
            <button type="submit">Aggiungi appartamento</button>
        </form>
    </div> -->
</template>



<style lang="scss" scoped></style>

