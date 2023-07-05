
<script>
import axios from "axios";
export default {
    name: "HomeView",
    data() {
        return {
            apartments: [],
        }
    },
    methods: {

    },
    mounted() {
        axios
            .get("http://127.0.0.1:8000/api/apartments")
            .then(response => {
                console.log(response);
                this.apartments = response.data.apartments.data;
            })
            .catch(error => {
                console.error(error.message);
            })
    }
}
</script>

<template>
    <div class="container">
        <!-- Modal trigger button -->
        <button type="button" class="btn btn-outline-dark my-3" data-bs-toggle="modal" data-bs-target="#modalId">
            Filtri (icona)
        </button>

        <!-- Modal Body -->
        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
        <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
            aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close m-0 position-absolute" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                        <h5 class="modal-title m-auto" id="modalTitleId">Filtri</h5>
                        <!-- <div class="space"></div> -->
                    </div>
                    <div class="modal-body">
                        <h5>Tipo di alloggio?</h5>
                        <!-- TODO aggiungere form per invio -->
                        <div class="btn-group my-3" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                            <label class="btn btn-outline-dark btn-lg" for="btnradio1">Tutti</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                            <label class="btn btn-outline-dark btn-lg" for="btnradio2">Stanze</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                            <label class="btn btn-outline-dark btn-lg" for="btnradio3">Alloggi</label>
                        </div>
                        <h5>Fascia di prezzo</h5>
                        <input type="range" class="form-range" min="0" id="range">
                    </div>
                    <div class="modal-footer">
                        <b class="me-auto">
                            <a type="reset" class="text-dark">Cancella filtri</a>
                        </b>
                        <button type="button" class="btn btn-dark">Mostra (n) (risultato filtro)</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-cols-3">
            <div class="col" v-for="apartment in apartments">
                <div class="card">
                    {{ apartment.name }}
                    {{ apartment.id }}
                    {{ apartment.slug }}
                    <router-link :to="{ name: 'singleApartment', params: { slug: apartment.slug } }">DETTAGLI</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>