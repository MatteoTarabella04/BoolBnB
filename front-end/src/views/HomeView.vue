<script>
import axios from "axios";
import { store } from "../store.js";
import { nextTick } from "vue";
import DrawingPin from '../components/DrawingPin.vue';
import SiteCarousel from '../components/SiteCarousel.vue';
export default {
    name: "HomeView",
    data() {
        return {
            store
        }
    },
    components: {
        DrawingPin,
        SiteCarousel
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
            this.$router.push({
                name: "searchPage"
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
        this.resetFilters();
        this.store.results = [];
        this.store.inputAddress = "";
        this.store.selectedAddress = null;
        this.store.selectedLat = null;
        this.store.selectedLon = null;
        this.getAllApartments();
        this.store.arrowKeysFunction();
    },
}
</script>

<template>
    <main class="viewport_without_header bg_primary overflow-hidden" @click.stop="store.results = []">
        <div class="jumbotron container position-realtive d-flex align-items-center justify-content-end px-0 px-sm-4">

            <div class="col-8 col-md-6 card p-4 ms-5 position-absolute start-0 strong_shadow rounded-4 z_index_998">
                <h4 class="fw-bold">Trova alloggi su BoolBnB</h4>
                <p>Inserisci una città o un indirizzo ed inizia la tua ricerca</p>
                <div>
                    <input
                        @input="store.inputAddress.length >= 3 ? getRealtimeResults() : store.results = [], store.selectedResult = '', store.searchError = false"
                        @keydown.enter="store.selectedLat != null && store.selectedLon != null ? getAllApartments(store.selectedResult) : ''"
                        class="form-control border_radius_30" type="text" id="address" name="address"
                        placeholder="Inizia a digitare un indirizzo per affinare la ricerca" v-model="store.inputAddress">
                    <ul class="list-unstyled bg-white w-75 rounded-3 list-group" id="addressSuggestions">
                        <li class="cursor_pointer p-1 list-group-item list-group-item-action"
                            @click="store.selectedResult = result, store.results = [], store.inputAddress = result.address.freeformAddress, store.searchError = false, control()"
                            v-for="result in store.results">
                            {{ result.address.freeformAddress }}
                        </li>
                    </ul>
                    <h6 v-if="store.searchError" class="text-danger">
                        Attenzione: selezionare un indirizzo dall'elenco a discesa che compare digitando
                    </h6>
                    <div class="d-flex align-items-center justify-content-end  gap-3">
                        <button
                            @click="store.selectedResult != '' && store.selectedResult.address.freeformAddress == store.inputAddress ? getAllApartments(store.selectedResult) : store.searchError = true"
                            type="button" class="btn bg_purple border_radius_30 my-3 hover_button px-3 text-white">
                            <span class="icon"><font-awesome-icon icon="fa-solid fa-magnifying-glass" /></span>Mostra
                            risultati</button>

                    </div>

                </div>
            </div>


            <SiteCarousel></SiteCarousel>

        </div>

        <div v-if="store.apartments.length > 0" class="container">


            <h1 class="text-center my-5">In primo piano</h1>
            <div class="d-flex flex-wrap">


                <div class="col-12 col-sm-6 col-lg-4 col-xxl-3 sponsored_apartment" v-for="apartment in store.apartments">
                    <router-link :to="{ name: 'singleApartment', params: { slug: apartment.slug } }"
                        class="text-decoration-none">
                        <div class="post_card text-center">
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
                            <p> {{ apartment.address }}</p>
                            <p> {{ apartment.description.length > 200 ? apartment.description.slice(0, 247) +
                                '...' :
                                apartment.description }}</p>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
    </main>
</template>

<style lang="scss" scoped></style>
