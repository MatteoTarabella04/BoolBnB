<script>
import axios from "axios";
import { store } from "../store.js";
import { nextTick } from "vue";
import DrawingPin from '../components/DrawingPin.vue';
export default {
    name: "SearchPage",
    data() {
        return {
            store
        }
    },
    components: {
        DrawingPin,
    },
    methods: {
        getAllApartments(address = null) {
            store.filteringApartments = [];
            if (address == null) {
                axios
                    .get(store.base_admin_URL + "api/apartments-types-services")
                    .then(response => {
                        store.apartments = response.data.apartments;
                        store.services = response.data.services;
                        store.apartmentTypes = response.data.apartment_types;
                        nextTick(() => {
                            let loadedApartmentsEls = document.querySelectorAll(".sponsored_apartment");
                            loadedApartmentsEls.forEach(loadedApartmentsEl => {
                                loadedApartmentsEl.style.rotate = `${Math.random() * 10 - 5}deg`;
                            })
                        });
                    })
                    .catch(error => {
                        console.error(error.message);
                    })
            } else {
                axios
                    .get(store.base_admin_URL + "api/apartments")
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
                .get(`https://api.tomtom.com/search/2/search/${store.inputAddress}.json?key=1tCQiScG72uLCOIZ32Xx2BG2eB07fCTm&typeahead=true&language=it-IT&limit=10`)
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
            nextTick(() => {
                let loadedApartmentsEls = document.querySelectorAll(".sponsored_apartment");
                loadedApartmentsEls.forEach(loadedApartmentsEl => {
                    loadedApartmentsEl.style.rotate = `${Math.random() * 10 - 5}deg`;
                })
            });
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
        resetFilters() {
            store.radius = 20;
            store.rooms = 0;
            store.beds = 0;
            store.checkedServices = [];
            store.apartmentType = 0;
        },
        randomRotate() {
            const deg = Math.random() * 10 - 5;
            return 'rotate(' + deg + 'deg)';
        },
        getImagePath(path) {
            return store.base_admin_URL + 'storage/' + path
        },
        checkOrUncheck(e) {
            if (e.target.getAttribute("checked") == true) {
                e.target.setAttribute("checked", null)
            } else {
                e.target.setAttribute("checked", true)
            }
        },
        resetTheSearch() {
            this.resetFilters();
            this.store.results = [];
            this.store.inputAddress = "";
            this.store.selectedAddress = null;
            this.store.selectedLat = null;
            this.store.selectedLon = null;
            this.getAllApartments();
            this.store.searchError = false;


        },
        control() {
            console.log(store.inputAddress);
            console.log(store.results);
            console.log(store.selectedResult);
            console.log(store.selectedLat);
            console.log(store.selectedLon);
            console.log(store.searchError);
        }
    },
    mounted() {
        this.store.arrowKeysFunction();
        axios

            .get(store.base_admin_URL + "api/apartments-types-services")
            .then(response => {
                store.services = response.data.services;
                store.apartmentTypes = response.data.apartment_types;
                nextTick(() => {
                    let loadedApartmentsEls = document.querySelectorAll(".sponsored_apartment");
                    loadedApartmentsEls.forEach(loadedApartmentsEl => {
                        loadedApartmentsEl.style.rotate = `${Math.random() * 10 - 5}deg`;
                    })
                });
            })
            .catch(error => {
                console.error(error.message);
            })

    }
}
</script>

<template>
    <main class="viewport_without_header bg_primary overflow-hidden" @click.stop="store.results = []">
        <div class="d-flex p-4">
            <div class="col-12 card p-4 strong_shadow rounded-4">
                <h4 class="fw-bold">Trova alloggi su BoolBnB</h4>
                <p>Inserisci una città o un indirizzo ed inizia la tua ricerca</p>
                <div>
                    <input
                        @input="store.inputAddress.length >= 3 ? getRealtimeResults() : store.results = [], store.selectedResult = '', store.searchError = false, control()"
                        class="form-control" type="text" id="address" name="address"
                        placeholder="Inizia a digitare un indirizzo per affinare la ricerca" v-model="store.inputAddress">
                    <ul class="list-unstyled position-absolute bg-white w-75 rounded-3 list-group" id="addressSuggestions">
                        <li class="cursor_pointer p-1 list-group-item list-group-item-action"
                            @click="store.selectedResult = result, store.results = [], store.inputAddress = result.address.freeformAddress, store.searchError = false"
                            v-for="result in store.results">
                            {{ result.address.freeformAddress }}
                        </li>
                    </ul>
                    <h6 v-if="store.searchError" class="text-danger">
                        Attenzione: selezionare un indirizzo dall'elenco a discesa che appare dopo aver digitato.
                    </h6>
                    <div class="d-flex align-items-center justify-content-end justify-content-sm-between">
                        <!-- Modal trigger button -->
                        <div>
                            <button type="button" class="btn btn-outline-dark my-3 border_radius_30 px-3"
                                data-bs-toggle="modal" data-bs-target="#modalId"><span
                                    class="icon d-none d-sm-inline me-sm-1"><font-awesome-icon
                                        icon="fa-solid fa-filter" /></span><span class="d-sm-none"><font-awesome-icon
                                        icon="fa-solid fa-filter" /></span>
                                <span class="d-none d-sm-inline">Filtri</span>

                            </button>
                            <button type="button" class="btn btn-outline-dark my-3 ms-2 border_radius_30 px-3 "
                                @click="resetTheSearch()"><span class="icon d-none d-sm-inline me-sm-1"><font-awesome-icon
                                        icon="fa-solid fa-undo" /></span><span class="d-sm-none"><font-awesome-icon
                                        icon="fa-solid fa-undo" /></span>
                                <span class="d-none d-sm-inline">Azzera</span>

                            </button>
                        </div>
                        <button
                            @click="store.selectedResult != '' && store.selectedResult.address.freeformAddress == store.inputAddress ? getAllApartments(store.selectedResult) : store.searchError = true"
                            type="button" class="btn bg_purple hover_button text-white my-3 ms-2 border_radius_30 px-3">
                            <span class="icon"><font-awesome-icon icon="fa-solid fa-magnifying-glass" /></span>Mostra
                            risultati</button>
                    </div>

                </div>
            </div>
            <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg px-5 mx-auto"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close m-0 position-absolute" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                            <h5 class="modal-title m-auto" id="modalTitleId">Affina la tua ricerca</h5>
                            <!-- <div class="space"></div> -->
                        </div>
                        <div class="modal-body">
                            <div class="mb-3"><!-- radius_range distance input -->
                                <h5 class="form-label">Distanza massima
                                    <span class="badge bg_purple">{{ store.radius }} km</span>
                                </h5>
                                <input type="range" min="1" max="100" step="1" name="radius_range" id="radius_range"
                                    v-model="store.radius">
                            </div>

                            <div class="row mb-4">
                                <div class="col-6">
                                    <div><!-- min_rooms input -->
                                        <h5 for="min_rooms" class="form-label">Numero di stanze</h5>
                                        <input type="number" class="form-control" min="0" max="255" step="1"
                                            name="min_rooms" id="min_rooms" v-model="store.rooms">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div><!-- min_beds input -->
                                        <h5 for="min_beds" class="form-label">Posti letto</h5>
                                        <input type="number" class="form-control" min="0" max="255" step="1" name="min_beds"
                                            id="min_beds" v-model="store.beds">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3"><!-- services input -->
                                <h5 class="d-flex gap-2">Servizi aggiuntivi
                                    <span v-if="store.checkedServices.length > 0"
                                        class="d-flex align-items-center justify-content-center badge text-bg-primary badge text-bg-primary">
                                        {{ store.checkedServices.length }}
                                    </span>
                                </h5>
                                <div class="d-flex flex-wrap">


                                    <div v-for="(service, index) in store.services" class="col-12 col-md-6">
                                        <input :value="service.id" type="checkbox" class="form-checkbox"
                                            :id="service.name + '-' + index" v-model="store.checkedServices"
                                            @click.stop="checkOrUncheck">
                                        <label :for="service.name + '-' + index" class="ms-2 d-inline">

                                            {{ service.name }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 "><!-- apartment_type input -->
                                <h5>Tipo di alloggio?</h5>
                                <div class="d-flex flex-column flex-md-row align-items-stretch">

                                    <div class="apartment_type_wrapper g-1 d-flex"
                                        :class="store.apartmentType === 0 ? 'bg_purple text-light' : ''" role="group"
                                        aria-label="Basic_radio_toggle_button_group">
                                        <input type="radio" class="btn-check" name="apartment_type" id="allTypes" :value="0"
                                            autocomplete="off" v-model="store.apartmentType">
                                        <label
                                            class="apartment_type d-flex align-items-center justify-content-center px-3 py-1 text-center flex-grow-1 cursor_pointer"
                                            for="allTypes">Tutti</label>
                                    </div>
                                    <div class="apartment_type_wrapper g-1 d-flex"
                                        :class="store.apartmentType === index + 1 ? 'bg_purple text-light' : ''"
                                        role="group" aria-label="Basic_radio_toggle_button_group"
                                        v-for="(singleType, index) in store.apartmentTypes">
                                        <input type="radio" class="btn-check" name="apartment_type" :id="singleType.name"
                                            :value="singleType.id" autocomplete="off" v-model="store.apartmentType">
                                        <label
                                            class="apartment_type d-flex align-items-center justify-content-center px-3 py-1 text-center flex-grow-1 cursor_pointer"
                                            :for="singleType.name">{{ singleType.name }}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer justify-content-center justify-content-sm-between">
                                <b>
                                    <a @click="resetFilters()" type="reset"
                                        class="btn btn-outline-dark border_radius_30 px-3"><span class="icon">
                                            <font-awesome-icon icon="fa-solid fa-undo" /></span>Azzera filtri</a>
                                </b>
                                <button
                                    @click="store.selectedResult != '' && store.selectedResult.address.freeformAddress == store.inputAddress ? getAllApartments(store.selectedResult) : store.searchError = true"
                                    type="button" class="btn bg_purple text-white border_radius_30 px-3"
                                    data-bs-toggle="modal" data-bs-target="#modalId"><span class="icon"><font-awesome-icon
                                            icon="fa-solid fa-magnifying-glass" /></span>Mostra risultati</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="image_container px-0 px-sm-4">
                <img class="jumbo_tron_img" src="../assets/images/pexels-quang-nguyen-vinh-2131772.jpg"
                    alt="Jumbotron image">
            </div> -->
        </div>

        <div v-if="store.apartments.length > 0" class="container">


            <h1 v-if="store.selectedAddress" class="text-center my-5">Risultati</h1>
            <h1 class="text-center my-5" v-else>In primo piano</h1>
            <div class="d-flex flex-wrap">


                <div class="col-12 col-sm-6 col-lg-4 col-xxl-3 sponsored_apartment" v-for="apartment in store.apartments">
                    <router-link :to="{ name: 'singleApartment', params: { slug: apartment.slug } }"
                        class="text-decoration-none">
                        <div class="post_card text-center mb-2">
                            <!-- <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor"
                                class="bi bi-bookmark-star-fill position-absolute top-0 end-0 me-2 text-warning"
                                viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5zM8.16 4.1a.178.178 0 0 0-.32 0l-.634 1.285a.178.178 0 0 1-.134.098l-1.42.206a.178.178 0 0 0-.098.303L6.58 6.993c.042.041.061.1.051.158L6.39 8.565a.178.178 0 0 0 .258.187l1.27-.668a.178.178 0 0 1 .165 0l1.27.668a.178.178 0 0 0 .257-.187L9.368 7.15a.178.178 0 0 1 .05-.158l1.028-1.001a.178.178 0 0 0-.098-.303l-1.42-.206a.178.178 0 0 1-.134-.098L8.16 4.1z" />
                            </svg> -->
                            <DrawingPin></DrawingPin>
                            <img :src="getImagePath(apartment.image)"
                                class="card-img-top moving_image pointer card_shadow h-100"
                                :alt="apartment.name + ' image'">
                            <div class="position-absolute text-white bg_purple border_radius_30 px-2 m-1"> {{
                                Math.floor(apartment.price_per_night).toLocaleString() + " €" }}</div>
                            <h2>{{ apartment.name }}</h2>
                            <p> {{ apartment.address }} </p>
                            <p v-if="store.selectedAddress" class="fs-5">{{ 'Distante ' +
                                Math.floor(apartment.distance_from_point * 100)
                                / 100 + " km" }}</p>

                            <p> {{ apartment.description.length > 200 ? apartment.description.slice(0, 247) + '...' :
                                apartment.description }}</p>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
        <div class="container" v-else>
            <h1 class="text-center mt-5">Nessun risultato disponibile</h1>
            <h6 class="text-center ">Modifica la tua ricerca</h6>
        </div>
    </main>
</template>

<style lang="scss" scoped></style>
