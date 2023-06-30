<script>
export default {
    data() {
        return {
            apartments: []
        };
    },
    created() {

        // chiamata API dal backend
        axios.get('/api/apartments')
            .then(response => {
                // elenco degli appartamenti nel componente
                this.apartments = response.data;
            })
            .catch(error => {
                console.error('Errore durante il recupero degli appartamenti:', error);
            });
    },
    methods: {
        editApartment(apartmentId) {
            // Reindirizza l'utente alla pagina di modifica dell'appartamento con l'ID specificato
            this.$router.push(`/apartments/${apartmentId}/edit`);
        },
        deleteApartment(apartmentId) {
            // chiamata API per eliminare l'appartamento dal backend

            axios.delete(`/api/apartments/${apartmentId}`)
                .then(response => {

                    console.log('Appartamento eliminato con successo:', response.data);
                    // Aggiorna l'elenco degli appartamenti nel componente dopo l'eliminazione
                    this.apartments = this.apartments.filter(apartment => apartment.id !== apartmentId);
                })
                .catch(error => {
                    //errore nel aggiornamento degli appartamenti
                    console.error('Errore durante l\'eliminazione dell\'appartamento:', error);
                });
        }
    }
};
</script>

<template>
    <section>
        <h2>Elenco degli appartamenti</h2>
        <div class="container">
            <div class="row">
                <div class="col" v-for="apartment in apartments" :key="apartment.id">
                    <div class="card">
                        <div class="card-header">{{ apartment.name }}</div>
                        <div class="card-image">
                            <img :src="apartment.image" alt="Immagine appartamento">
                        </div>
                        <div class="card-body">
                            <h5><strong>Descrizione </strong></h5>
                            <p>{{ apartment.description }}</p>
                            <p><strong>Prezzo per notte:</strong> {{ apartment.price_per_night }}</p>
                            <p>Quest'appartamento è ancora disponibile?: {{ apartment.visible }}</p>
                        </div>
                        <div class="card-footer">
                            <router-link :to="`/apartments/${apartment.id}`">Dettagli</router-link>
                            <button @click="editApartment(apartment.id)">Modifica</button>
                            <button @click="deleteApartment(apartment.id)">Elimina</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <router-link to="/apartmentsViews/AddApartmentView">Aggiungi appartamento</router-link>
    </section>
</template>



<style lang="scss" scoped></style>
