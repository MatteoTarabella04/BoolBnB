<script>
export default {
    data() {
        return {
            apartment: {}
        };
    },
    created() {
        // Recupera i dettagli dell'appartamento dall'API e inizializza i dati del componente

        // chiamata API per ottenere i dettagli dell'appartamento dal backend
        axios.get(`/api/apartments/${this.$route.params.id}`)
            .then(response => {
                // Inizializza i dati dell'appartamento nel componente
                this.apartment = response.data;
            })
            .catch(error => {
                console.error('Errore durante il recupero dei dettagli dell\'appartamento:', error);
            });
    },
    methods: {
        deleteApartment(apartmentId) {


            // chiamata API per l'eliminazione dell'appartamento
            axios.delete(`/api/apartments/${apartmentId}`)
                .then(response => {
                    // Aggiorna l'interfaccia utente o esegui altre azioni necessarie
                    console.log('Appartamento eliminato con successo:', response.data);
                    // Esempio: Reindirizza l'utente alla pagina degli appartamenti
                    this.$router.push('/apartments');
                })
                .catch(error => {
                    console.error('Errore durante l\'eliminazione dell\'appartamento:', error);
                });
        }
    }
};
</script>

<template>
    <div>
        <h2>{{ apartment.name }}</h2>
        <div class="image">
            <img :src="apartment.image" alt="Immagine appartamento">
        </div>
        <div>
            <p><strong>Descrizione:</strong> {{ apartment.description }}</p>
            <p><strong>Prezzo per notte:</strong> {{ apartment.price_per_night }}</p>
            <p>Numero di stanze: {{ apartment.rooms }}</p>
            <p>Numero di letti: {{ apartment.beds }}</p>
            <p>Bagni: {{ apartment.bathrooms }}</p>
            <p>Grandezza dell'appartamento: {{ apartment.square_meters }}</p>
            <p>Indirizzo:{{ apartment.address }}</p>
            <p>Quest' appartamento è disponibile?{{ apartment.visible }}</p>
            <p>Quest'appartamento è ancora disponibile?: {{ apartment.visible }}</p>
        </div>
        <div>
            <router-link to="/apartments">Torna all'elenco degli appartamenti</router-link>
            <router-link :to="`/apartments/${apartment.id}/edit`">Modifica</router-link>
            <button @click="deleteApartment(apartment.id)">Elimina</button>
        </div>
    </div>
</template>
  
