<script>
import axios from "axios";
import { store } from "../store.js";
export default {
    name: "HomeView",
    data() {
        return {
            store,
            base_URL: 'http://127.0.0.1:8000/'
        }
    },
    methods: {
        getAllApartments(address = null) {
            store.filteringApartments = [];
            if (!store.filtering) {
                axios
                    .get("http://127.0.0.1:8000/api/apartments-types-services")
                    .then(response => {
                        store.apartments = response.data.apartments;
                        store.services = response.data.services;
                        store.apartmentTypes = response.data.apartment_types;
                        if (address != null) {
                            store.filtering = true;
                        }
                        if (store.filtering) {
                            this.setCoordinates(address);
                        }
                    })
                    .catch(error => {
                        console.error(error.message);
                    })
            } else {
                axios
                    .get("http://127.0.0.1:8000/api/apartments")
                    .then(response => {
                        store.apartments = response.data.apartments;
                        if (address != null) {
                            store.filtering = true;
                        }
                        if (store.filtering) {
                            this.setCoordinates(address);
                        }
                    })
                    .catch(error => {
                        console.error(error.message);
                    })
            }
        },
        getRealtimeResults() {
            axios
                .get(`https://api.tomtom.com/search/2/search/${store.inputAddress}.json?key=1tCQiScG72uLCOIZ32Xx2BG2eB07fCTm&typeahead=true&language=it-IT&limit=10&idxSet=PAD,Addr,Str,XStr`)
                .then(response => {
                    store.results = response.data.results
                })
                .catch(error => {
                    console.error(error.message);
                })
        },
        setCoordinates(address) {
            store.selectedAddress = address.address.freeformAddress;
            store.selectedLat = address.position.lat;
            store.selectedLon = address.position.lon;
            store.filteringApartments = store.apartments;
            this.checkOtherFilters();
            store.apartments = store.filteringApartments.filter(apartment => {
                const lat1 = store.selectedLat;
                const lon1 = store.selectedLon;
                const lat2 = apartment.latitude;
                const lon2 = apartment.longitude;
                const distance = this.calculateDistance(lat1, lat2, lon1, lon2);
                if (distance <= store.radius) {
                    apartment.distance_from_point = distance;
                    return true;
                }
                return false;
            });
            store.apartments.sort((a, b) => a.distance_from_point - b.distance_from_point);
        },
        calculateDistance(lat1, lat2, lon1, lon2) {

            // The math module contains a function named toRadians which converts from degrees to radians.
            lon1 = lon1 * Math.PI / 180;
            lon2 = lon2 * Math.PI / 180;
            lat1 = lat1 * Math.PI / 180;
            lat2 = lat2 * Math.PI / 180;

            // Haversine formula
            let diffLon = lon2 - lon1;
            let diffLat = lat2 - lat1;
            let a = Math.pow(Math.sin(diffLat / 2), 2) + Math.cos(lat1) * Math.cos(lat2) * Math.pow(Math.sin(diffLon / 2), 2);
            let c = 2 * Math.asin(Math.sqrt(a));

            // Radius of earth in kilometers. Use 3956 for miles
            let r = 6371;

            // calculate the result
            return (c * r);
        },
        checkOtherFilters() {
            let stepFilteringApartments = [];
            if (store.rooms > 0) {
                stepFilteringApartments = store.filteringApartments.filter(apartment => apartment.rooms >= store.rooms ? true : false);
                store.filteringApartments = stepFilteringApartments;
            }
            if (store.beds > 0) {
                stepFilteringApartments = store.filteringApartments.filter(apartment => apartment.beds >= store.beds ? true : false);
                store.filteringApartments = stepFilteringApartments;
            }
            if (store.apartmentType > 0) {
                stepFilteringApartments = store.filteringApartments.filter(apartment => apartment.apartment_type.id === store.apartmentType ? true : false);
                store.filteringApartments = stepFilteringApartments;
            }
            if (store.services.length > 0) {
                stepFilteringApartments = [];
                store.filteringApartments.forEach(apartment => {
                    let apartmentServices = [];
                    apartment.services.forEach(service => {
                        apartmentServices.push(service.id);
                    })
                    const allServicesChecked = store.checkedServices.every(service => {
                        return apartmentServices.indexOf(service) >= 0;
                    })
                    if (allServicesChecked) {
                        stepFilteringApartments.push(apartment);
                    }
                })
                store.filteringApartments = stepFilteringApartments;
            }
        },
        randomRotate() {
            const deg = Math.random() * (5 - -5) + -5;
            return 'rotate(' + deg + 'deg)';
        },
        getImagePath(path) {
            return this.base_URL + 'storage/' + path
        }
    },
    mounted() {
        this.getAllApartments();

    },
}
</script>

<template>
    <main class="bg_primary">
        <!-- <JumboSection></JumboSection> -->
        <div class="jumbotron d-flex align-items-center justify-content-end">
            <div class="col-8 col-md-6 card p-4 ms-5 position-absolute start-0 strong_shadow rounded-4">
                <h5>Scopri tutti gli alloggi</h5>
                <p>Inserisci una città o un indirizzo ed inizia la tua ricerca</p>
                <div>
                    <input @input="store.inputAddress.length >= 3 ? getRealtimeResults() : ''" type="text" id="address"
                        name="address" v-model="store.inputAddress" class="form-control">
                    <ul class="list-unstyled">
                        <li @click="getAllApartments(result), store.results = []" v-for="result in store.results">
                            {{ result.address.freeformAddress }}
                        </li>
                    </ul>
                    <!-- Modal trigger button -->
                    <button type="button" class="btn btn-outline-dark my-3" data-bs-toggle="modal"
                        data-bs-target="#modalId">
                        Filtri
                        <font-awesome-icon icon="fa-solid fa-filter" />
                    </button>

                </div>
            </div>
            <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close m-0 position-absolute" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <h5 class="modal-title m-auto" id="modalTitleId">Affina ricerca</h5>
                            <!-- <div class="space"></div> -->
                        </div>
                        <div class="modal-body">
                            <h5>Distanza dall'indirizzo cercato ({{ store.radius }}km)</h5>
                            <input type="range" class="form-range" min="1" max="100" step="1" id="radius_range"
                                v-model="store.radius">
                            <h5>Numero minimo di stanze {{ store.rooms >= 1 ? `(${store.rooms})` : "" }}</h5>
                            <input type="number" class="form-range" min="0" max="255" step="1" id="min_rooms"
                                v-model="store.rooms">
                            <h5>Numero minimo di posti letto {{ store.beds >= 1 ? `(${store.beds})` : "" }}</h5>
                            <input type="number" class="form-range" min="0" max="255" step="1" id="min_beds"
                                v-model="store.beds">
                            <h5>Servizi aggiuntivi {{ store.checkedServices.length > 0 ?
                                `(${store.checkedServices.length})` : "" }}</h5>
                            <div class="d-flex flex-wrap">
                                <div v-for="(service, index) in store.services" class="w-50">
                                    <input :value="service.id" type="checkbox" class="form-checkbox"
                                        :id="service.name + '-' + index" v-model="store.checkedServices">
                                    <label :for="service.name + '-' + index" class="ms-2">{{ service.name }}</label>
                                </div>
                            </div>
                            
                            <!-- apartment_type input----------ORIGINAAAAAAAAAL -->
                                    <!-- <div class="mb-3">
                                        <h5>Tipo di alloggio?</h5>
                                        <div class="btn-group rounded-1 max-w-max" role="group" aria-label="Basic_radio_toggle_button_group">
                                            <input type="radio" class="btn-check" name="apartment_type" id="allTypes"
                                                value="0" autocomplete="off" checked v-model="store.apartmentType">
                                            <label
                                                class="btn btn-outline-dark btn-lg d-flex align-items-center justify-content-center"
                                                for="allTypes">Tutti
                                            </label>
                                            <template class="" v-for="singleType in store.apartmentTypes">

                                                <input type="radio" class="btn-check" name="apartment_type"
                                                    :id="singleType.name" :value="singleType.id" autocomplete="off"
                                                    v-model="store.apartmentType">
                                                <label
                                                    class="btn btn-outline-dark btn-lg d-flex align-items-center justify-content-center"
                                                    :for="singleType.name">{{ singleType.name }}
                                                </label>
                                            </template>
                                        </div>
                                    </div> -->



                                    <div class="mb-3 "><!-- apartment_type input----------test -->
                                        <h5>Tipo di alloggio?</h5>
                                        <div class="btn-group rounded-1 g-1 d-flex flex-wrap-reverse" role="group" aria-label="Basic_radio_toggle_button_group" v-for="singleType in store.apartmentTypes">
                                            <!-- <input type="radio" class="btn-check" name="apartment_type" id="allTypes"
                                                value="0" autocomplete="off" checked v-model="store.apartmentType">
                                            <label
                                                class="btn btn-outline-dark btn-lg d-flex align-items-center justify-content-center"
                                                for="allTypes">Tutti
                                            </label> -->

                                                <input type="radio" class="btn-check" name="apartment_type"
                                                    :id="singleType.name" :value="singleType.id" autocomplete="off"
                                                    v-model="store.apartmentType">
                                                <label
                                                    class="btn btn-outline-dark btn-lg d-flex align-items-center justify-content-center"
                                                    :for="singleType.name">{{ singleType.name }}
                                                </label>
                                        </div>
                                    </div>
                                    
                            <!-- <h5>Tipo di alloggio?</h5>
                            <div class="btn-group my-3" role="group" aria-label="Basic radio toggle button group">
                                <input type="radio" class="btn-check" name="apartment_type" id="allTypes" value="0"
                                    autocomplete="off" checked v-model="store.apartmentType">
                                <label class="btn btn-outline-dark btn-lg d-flex align-items-center justify-content-center"
                                    for="allTypes">Tutti</label>
                                <template v-for="singleType in store.apartmentTypes">
                                    <input type="radio" class="btn-check" name="apartment_type" :id="singleType.name"
                                        :value="singleType.id" autocomplete="off" v-model="store.apartmentType">
                                    <label
                                        class="btn btn-outline-dark btn-lg d-flex align-items-center justify-content-center"
                                        :for="singleType.name">{{ singleType.name }}</label>
                                </template>
                            </div> -->
                            
                            <!-- VEDERE SE E COME IMPLEMENTARE
                            <h5>Fascia di prezzo</h5>
                            <input type="range" class="form-range" min="0" id="price_range"> -->
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
            <div class="image_container px-0 px-sm-4">
                <img class="jumbo_tron_img" src="../assets/images/pexels-quang-nguyen-vinh-2131772.jpg" alt="">
            </div>
        </div>

        <div class="container">


            <h1 class="text-center my-5">In primo piano</h1>
            <div class="d-flex flex-wrap">
                <div class=" col-12 col-sm-6 col-md-4 col-xl-3 sponsored_apartment" :style="{ transform: randomRotate() }"
                    v-for="apartment in store.apartments">
                    <router-link :to="{ name: 'singleApartment', params: { slug: apartment.slug } }"
                        class="text-decoration-none">
                        <div class="post_card">
                            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor"
                                class="bi bi-bookmark-star-fill position-absolute top-0 end-0 me-2 text-warning"
                                viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5zM8.16 4.1a.178.178 0 0 0-.32 0l-.634 1.285a.178.178 0 0 1-.134.098l-1.42.206a.178.178 0 0 0-.098.303L6.58 6.993c.042.041.061.1.051.158L6.39 8.565a.178.178 0 0 0 .258.187l1.27-.668a.178.178 0 0 1 .165 0l1.27.668a.178.178 0 0 0 .257-.187L9.368 7.15a.178.178 0 0 1 .05-.158l1.028-1.001a.178.178 0 0 0-.098-.303l-1.42-.206a.178.178 0 0 1-.134-.098L8.16 4.1z" />
                            </svg>
                            <img :src="getImagePath(apartment.image)"
                                class="card-img-top moving_image pointer card_shadow h-100"
                                :alt="apartment.name + ' image'">
                            <h2 class="">{{ apartment.name }}</h2>
                            <p> {{ apartment.address }}</p>

                            <p> {{ apartment.description }}</p>
                            <!-- <p>BEDS {{ apartment.beds }}</p> -->
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
    </main>
</template>

<style lang="scss" scoped></style>
