
<script>
import axios from "axios";
export default {
    name: "HomeView",
    data() {
        return {
            apartments: [],
            services: [],
            filteredApartments: [],
            checkedServices: [],
            results: [],
            filtering: false,
            inputAddress: "",
            selectedAddress: null,
            selectedLat: null,
            selectedLon: null,
            radius: 20,
            rooms: 0,
            beds: 0,
        }
    },
    methods: {
        getAllApartments(address = null) {
            if(!this.filtering) {
                axios
                .get("http://127.0.0.1:8000/api/apartments-and-services")
                .then(response => {
                    this.apartments = response.data.apartments;
                    console.log(this.apartments);
                    this.services = response.data.services;
                    if(address != null) {
                        this.filtering = true;
                    }
                    if(this.filtering) {
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
                    this.apartments = response.data.apartments;
                    if(address != null) {
                        this.filtering = true;
                    }
                    if(this.filtering) {
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
            .get(`https://api.tomtom.com/search/2/search/${this.inputAddress}.json?key=1tCQiScG72uLCOIZ32Xx2BG2eB07fCTm&typeahead=true&language=it-IT&limit=10&idxSet=PAD,Addr,Str,XStr`)
            .then(response => {
                this.results = response.data.results
            })
            .catch(error => {
                console.error(error.message);
            })
        },
        setCoordinates(address) {
            this.selectedAddress = address.address.freeformAddress;
            this.selectedLat = address.position.lat;
            this.selectedLon = address.position.lon;
            this.checkOtherFilters();
            this.apartments = this.filteredApartments.filter(apartment => {
                const lat1 = this.selectedLat;
                const lon1 = this.selectedLon;
                const lat2 = apartment.latitude;
                const lon2 = apartment.longitude;
                const distance = this.calculateDistance(lat1, lat2, lon1, lon2);
                if (distance <= this.radius) {
                    apartment.distance_from_point = distance;
                    return true;
                }
                return false;
            });
            this.apartments.sort((a, b) => a.distance_from_point - b.distance_from_point);
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
            let a = Math.pow(Math.sin(diffLat / 2), 2) + Math.cos(lat1) * Math.cos(lat2) * Math.pow(Math.sin(diffLon / 2),2);
            let c = 2 * Math.asin(Math.sqrt(a));
    
            // Radius of earth in kilometers. Use 3956 for miles
            let r = 6371;
    
            // calculate the result
            return(c * r);
        },
        checkOtherFilters() {
            let apartmentsByRooms = [];
            let apartmentsByBeds = [];
            //  && this.services.length > 0 ADD THIS TO CHECK FOR SERVICES TOO
            if(this.rooms > 0 && this.beds > 0) {
                apartmentsByRooms = this.apartments.filter(apartment => apartment.rooms >= this.rooms ? true : false);
                apartmentsByBeds = apartmentsByRooms.filter(apartment => apartment.beds >= this.beds ? true : false);
                // ADD NESTED FILTERS TO CHECK FOR SERVICES
                this.filteredApartments = apartmentsByBeds;
            } else if(this.rooms > 0) {
                this.filteredApartments = this.apartments.filter(apartment => apartment.rooms >= this.rooms ? true : false);
            } else if(this.beds > 0) {
                this.filteredApartments = this.apartments.filter(apartment => apartment.beds >= this.beds ? true : false);
            } else {
                this.filteredApartments = this.apartments;
            }
        }
    },
    mounted() {
        this.getAllApartments();
    }
}
</script>

<template>
    <div class="container">

        <div>
            <input @input="inputAddress.length >= 3 ? getRealtimeResults() : ''" type="text" id="address" name="address" v-model="inputAddress">
            <ul class="list-unstyled">
                <li @click="getAllApartments(result), results = []" v-for="result in results">
                    {{ result.address.freeformAddress }}
                </li>
            </ul>
            <!-- <h2 v-if="selectedAddress">Address: {{ this.selectedAddress }}</h2>
            <h2 v-if="selectedLat">Lat: {{ this.selectedLat }}</h2>
            <h2 v-if="selectedLon">Lon: {{ this.selectedLon }}</h2> -->
            <!-- <div class="d-flex align-items-start">
                <ul class="list-unstyled" style="width: 40vw" v-if="addresses.length > 0">
                    <li v-for="singleAddress in addresses">
                        {{ singleAddress.address.freeformAddress }}
                        <hr>
                    </li>
                </ul>
                <div id="map" style="width: 60vw; aspect-ratio: 3 / 2; margin-inline: auto;"></div>
            </div> -->
        </div>

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
                        <h5>Distanza dall'indirizzo cercato ({{ radius }}km)</h5>
                        <input type="range" class="form-range" min="1" max="100" step="1" id="radius_range" v-model="radius">
                        <h5>Numero minimo di stanze ({{ rooms }})</h5>
                        <input type="number" class="form-range" min="0" max="255" step="1" id="min_rooms" v-model="rooms">
                        <h5>Numero minimo di posti letto ({{ beds }})</h5>
                        <input type="number" class="form-range" min="0" max="255" step="1" id="min_beds" v-model="beds">
                        <h5>Servizi aggiuntivi</h5>
                        <div class="d-flex flex-wrap">
                            <div v-for="(service, index) in services" class="w-50">
                                <input :value="service.id" type="checkbox" class="form-checkbox" :id="service.name + '-' + index" v-model="checkedServices">
                                <label :for="service.name + '-' + index" class="ms-2">{{ service.name }}</label>
                            </div>
                        </div>
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
                        <input type="range" class="form-range" min="0" id="price_range">
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
                    <h3>{{ apartment.name }}</h3>
                    <p>{{ filtering ? "DISTANCE " + Math.round(apartment.distance_from_point * 100) / 100 + "km" : ""}}</p>
                    <p>ROOMS {{ apartment.rooms }}</p>
                    <p>BEDS {{ apartment.beds }}</p>
                    <router-link :to="{ name: 'singleApartment', params: { slug: apartment.slug } }">DETTAGLI</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>
