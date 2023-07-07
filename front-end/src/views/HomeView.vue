<script>
import axios from "axios";
import { store } from "../store.js";
export default {
    name: "HomeView",
    data() {
        return {
            store,
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
            if(store.rooms > 0) {
                stepFilteringApartments = store.filteringApartments.filter(apartment => apartment.rooms >= store.rooms ? true : false);
                store.filteringApartments = stepFilteringApartments;
            }
            if(store.beds > 0) {
                stepFilteringApartments = store.filteringApartments.filter(apartment => apartment.beds >= store.beds ? true : false);
                store.filteringApartments = stepFilteringApartments;
            }
            if(store.apartmentType > 0) {
                stepFilteringApartments = store.filteringApartments.filter(apartment => apartment.apartment_type.id === store.apartmentType ? true : false);
                store.filteringApartments = stepFilteringApartments;
            }
            if(store.services.length > 0) {
                stepFilteringApartments = [];
                store.filteringApartments.forEach(apartment => {
                    let apartmentServices = [];
                    apartment.services.forEach(service => {
                        apartmentServices.push(service.id);
                    })
                    const allServicesChecked = store.checkedServices.every(service => {
                        return apartmentServices.indexOf(service) >= 0;
                    })
                    if(allServicesChecked) {
                        stepFilteringApartments.push(apartment);
                    }
                })
                store.filteringApartments = stepFilteringApartments;
            }
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
            <div class="col-4 card p-4 ms-5 position-absolute start-0">
                <h5>Scopri tutti gli alloggi</h5>
                <p>Inserisci una città o un indirizzo ed inizia la tua ricerca</p>
                <div>
                    <input @input="store.inputAddress.length >= 3 ? getRealtimeResults() : ''" type="text" id="address" name="address" v-model="store.inputAddress" class="form-control">
                    <ul class="list-unstyled">
                        <li @click="getAllApartments(result), store.results = []" v-for="result in store.results">
                            {{ result.address.freeformAddress }}
                        </li>
                    </ul>
                    <!-- Modal trigger button -->
                    <button type="button" class="btn btn-outline-dark my-3" data-bs-toggle="modal" data-bs-target="#modalId">
                        Filtri (icona)
                    </button>

                    <!-- Modal Body -->
                    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
                    <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close m-0 position-absolute" data-bs-dismiss="modal" aria-label="Close"></button>
                                    <h5 class="modal-title m-auto" id="modalTitleId">Filtri</h5>
                                    <!-- <div class="space"></div> -->
                                </div>
                                <div class="modal-body">
                                    <h5>Distanza dall'indirizzo cercato ({{ store.radius }}km)</h5>
                                    <input type="range" class="form-range" min="1" max="100" step="1" id="radius_range" v-model="store.radius">
                                    <h5>Numero minimo di stanze {{ store.rooms >= 1 ? `(${store.rooms})` : "" }}</h5>
                                    <input type="number" class="form-range" min="0" max="255" step="1" id="min_rooms" v-model="store.rooms">
                                    <h5>Numero minimo di posti letto {{ store.beds >= 1 ? `(${store.beds})` : "" }}</h5>
                                    <input type="number" class="form-range" min="0" max="255" step="1" id="min_beds" v-model="store.beds">
                                    <h5>Servizi aggiuntivi {{ store.checkedServices.length > 0 ? `(${store.checkedServices.length})` : "" }}</h5>
                                    <div class="d-flex flex-wrap">
                                        <div v-for="(service, index) in store.services" class="w-50">
                                            <input :value="service.id" type="checkbox" class="form-checkbox" :id="service.name + '-' + index" v-model="store.checkedServices">
                                            <label :for="service.name + '-' + index" class="ms-2">{{ service.name }}</label>
                                        </div>
                                    </div>
                                    <h5>Tipo di alloggio?</h5>
                                    <div class="btn-group my-3" role="group" aria-label="Basic radio toggle button group">
                                        <input type="radio" class="btn-check" name="apartment_type" id="allTypes" value="0" autocomplete="off" checked v-model="store.apartmentType">
                                        <label class="btn btn-outline-dark btn-lg d-flex align-items-center justify-content-center" for="allTypes">Tutti</label>
                                        <template v-for="singleType in store.apartmentTypes">
                                            <input type="radio" class="btn-check" name="apartment_type" :id="singleType.name" :value="singleType.id" autocomplete="off" v-model="store.apartmentType">
                                            <label class="btn btn-outline-dark btn-lg d-flex align-items-center justify-content-center" :for="singleType.name">{{ singleType.name }}</label>
                                        </template>
                                    </div>
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
                </div>
            </div>
            <div class="image_container">
                <img class="jumbo_tron_img" src="../assets/images/pexels-quang-nguyen-vinh-2131772.jpg" alt="">
            </div>
        </div>

        <div class="container">



            <div class="row row-cols-3">
                <div class="col" v-for="apartment in store.apartments">
                    <div class="card">
                        <h3>{{ apartment.name }}</h3>
                        <p>{{ store.filtering ? "DISTANCE " + Math.round(apartment.distance_from_point * 100) / 100 + "km" : "" }}
                        </p>
                        <p>ROOMS {{ apartment.rooms }}</p>
                        <p>BEDS {{ apartment.beds }}</p>
                        <router-link
                            :to="{ name: 'singleApartment', params: { slug: apartment.slug } }">DETTAGLI</router-link>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<style lang="scss" scoped></style>
