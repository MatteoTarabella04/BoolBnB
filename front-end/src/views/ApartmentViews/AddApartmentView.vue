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
                image: "",
                visible: true

            }
        }
    },
    methods: {
        addApartment() {
            // Eseguo la chiamata API per aggiungere l'appartamento al backend

            // chiamata API 
            axios.post('apartments', this.apartment)
                .then(response => {
                    // Aggiorna l'interfaccia utente o esegui altre azioni necessarie
                    console.log('Appartamento aggiunto con successo:', response.data);
                    // Reindirizza l'utente alla pagina degli appartamenti
                    this.$router.push('/apartments');
                })
                .catch(error => {
                    // Gestisci eventuali errori durante la chiamata API
                    console.error('Errore durante l\'aggiunta dell\'appartamento:', error);
                });
        }
    }
}
</script>


<template>
    <div>
        <h4>Aggiungi un appartamento</h4>
        <form @submit.prevent="addApartment">
            <div>
                <label for="title">Titolo:</label>
                <input type="text" id="title" v-model="apartment.title" required>
            </div>
            <div>
                <label for="description">Descrizione:</label>
                <textarea id="description" v-model="apartment.description" required></textarea>
            </div>
            <div>
                <label for="price">Prezzo:</label>
                <input type="number" id="price" v-model="apartment.price" required>
            </div>
            <button type="submit">Aggiungi appartamento</button>
        </form>
    </div>
</template>



<style lang="scss" scoped></style>