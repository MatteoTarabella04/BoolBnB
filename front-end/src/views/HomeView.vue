<script>
import { store } from "../store.js";
import DrawingPin from '../components/DrawingPin.vue';
import SiteCarousel from '../components/SiteCarousel.vue';
export default {
    name: "HomeView",
    data() {
        return {
            store,
            firstApartmentOnPage: 0,
            itemsPerPage: 12,
        }
    },
    components: {
        DrawingPin,
        SiteCarousel
    },
    methods: {
        control() {
            console.log(store.inputAddress);
            console.log(store.results);
            console.log(store.selectedResult);
            console.log(store.selectedLat);
            console.log(store.selectedLon);
            console.log(store.searchError);
        },
        prevClick() {
            const apartmentsListEl = document.getElementById("apartments-list");
            const offset = apartmentsListEl.getBoundingClientRect().top + window.scrollY - 100;
            
            if(this.firstApartmentOnPage < this.itemsPerPage) {
                window.scrollTo({
                    top: offset
                });
                this.firstApartmentOnPage = 0;
            } else {
                window.scrollTo({
                    top: offset
                });
                this.firstApartmentOnPage -= this.itemsPerPage;
            }
        },
        nextClick() {
            const apartmentsListEl = document.getElementById("apartments-list");
            const offset = apartmentsListEl.getBoundingClientRect().top + window.scrollY - 100;

            if(this.firstApartmentOnPage > store.apartments.length - (this.itemsPerPage * 2)) {
                window.scrollTo({
                    top: offset
                });
                this.firstApartmentOnPage = store.apartments.length - this.itemsPerPage;
            } else {
                window.scrollTo({
                    top: offset
                });
                this.firstApartmentOnPage += this.itemsPerPage;
            }
        },
    },
    mounted() {
        store.resetFilters();
        store.results = [];
        store.inputAddress = "";
        store.selectedAddress = null;
        store.selectedLat = null;
        store.selectedLon = null;
        store.getAllApartments(this);
        store.arrowKeysFunction();
    },
}
</script>

<template>
    <main class=" bg_primary overflow-hidden" @click.stop="store.results = []">
        <div class="jumbotron container position-relative d-flex align-items-center justify-content-end px-0 px-sm-4">

            <div class="col-8 col-md-6 card p-4 ms-5 ms-sm-0 position-absolute start-0 strong_shadow rounded-4 z_index_998">
                <h4 class="fw-bold">Trova alloggi su BoolBnB</h4>
                <p>Inserisci una città o un indirizzo</p>
                <div>
                    <input
                        @input="store.inputAddress.length >= 3 ? store.getRealtimeResults() : store.results = [], store.selectedResult = '', store.searchError = false"
                        @keydown.enter="store.selectedLat != null && store.selectedLon != null ? getAllApartments(store.selectedResult) : ''"
                        class="form-control border_radius_30" type="text" id="address" name="address"
                        placeholder="Digita qui" v-model="store.inputAddress">
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
                    <div class="d-flex align-items-center justify-content-end gap-3">
                        <button
                            @click="store.selectedResult != '' && store.selectedResult.address.freeformAddress == store.inputAddress ? store.getAllApartments(this, store.selectedResult) : store.searchError = true"
                            type="button"
                            class="btn bg_purple border_radius_30 my-3 hover_button px-3 text-white flex-grow-1 flex-md-grow-0"
                            id="view_results">
                            <span class="icon"><font-awesome-icon icon="fa-solid fa-magnifying-glass" /></span>Mostra
                            risultati</button>

                    </div>

                </div>
            </div>

            <SiteCarousel></SiteCarousel>

        </div>

        <div v-if="store.apartments.length > 0" class="container" id="apartments-list">

            <h1 class="text-center my-5">In primo piano</h1>
            <div class="d-flex flex-wrap justify-content-center">
                <template v-for="n in store.apartments.length < itemsPerPage ? store.apartments.length : itemsPerPage">
                    <div class="col-12 col-sm-6 col-lg-4 col-xxl-3 sponsored_apartment card_hover"
                        v-if="store.checkIfSponsorized(store.apartments[n + firstApartmentOnPage - 1])">
                        <router-link :to="{ name: 'singleApartment', params: { slug: store.apartments[n + firstApartmentOnPage - 1].slug } }"
                            class="text-decoration-none">
                            <div class="post_card text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" fill="currentColor"
                                    class="bi bi-bookmark-star-fill position-absolute top-0 start-0 ms-1 text-warning"
                                    viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5zM8.16 4.1a.178.178 0 0 0-.32 0l-.634 1.285a.178.178 0 0 1-.134.098l-1.42.206a.178.178 0 0 0-.098.303L6.58 6.993c.042.041.061.1.051.158L6.39 8.565a.178.178 0 0 0 .258.187l1.27-.668a.178.178 0 0 1 .165 0l1.27.668a.178.178 0 0 0 .257-.187L9.368 7.15a.178.178 0 0 1 .05-.158l1.028-1.001a.178.178 0 0 0-.098-.303l-1.42-.206a.178.178 0 0 1-.134-.098L8.16 4.1z" />
                                </svg>
                                <DrawingPin></DrawingPin>
                                <img :src="store.getImagePath(store.apartments[n + firstApartmentOnPage - 1].image)"
                                    class="card-img-top moving_image pointer card_shadow h-100"
                                    :alt="store.apartments[n + firstApartmentOnPage - 1].name + ' image'">
                                <div class="position-absolute text-white bg_purple border_radius_30 px-2 m-1"> {{
                                    Math.floor(store.apartments[n + firstApartmentOnPage - 1].price_per_night).toLocaleString() + " €" }}
                                </div>
                                <h2>{{ store.apartments[n + firstApartmentOnPage - 1].name }}</h2>
                                <p> {{ store.apartments[n + firstApartmentOnPage - 1].address }}</p>
                                <p> {{ store.apartments[n + firstApartmentOnPage - 1].description.length > 200 ?
                                    store.apartments[n + firstApartmentOnPage - 1].description.slice(0, 247) +
                                    '...' :
                                    store.apartments[n + firstApartmentOnPage - 1].description }}</p>
                            </div>
                        </router-link>
                    </div>
                </template>
                <template v-for="n in store.apartments.length < itemsPerPage ? store.apartments.length : itemsPerPage">
                    <div class="col-12 col-sm-6 col-lg-4 col-xxl-3 sponsored_apartment card_hover"
                        v-if="!store.checkIfSponsorized(store.apartments[n + firstApartmentOnPage - 1])">
                        <router-link :to="{ name: 'singleApartment', params: { slug: store.apartments[n + firstApartmentOnPage - 1].slug } }"
                            class="text-decoration-none">
                            <div class="post_card text-center">
                                <DrawingPin></DrawingPin>
                                <img :src="store.getImagePath(store.apartments[n + firstApartmentOnPage - 1].image)"
                                    class="card-img-top moving_image pointer card_shadow h-100"
                                    :alt="store.apartments[n + firstApartmentOnPage - 1].name + ' image'">
                                <div class="position-absolute text-white bg_purple border_radius_30 px-2 m-1"> {{
                                    Math.floor(store.apartments[n + firstApartmentOnPage - 1].price_per_night).toLocaleString() + " €" }}</div>
                                <h2>{{ store.apartments[n + firstApartmentOnPage - 1].name }}</h2>
                                <p> {{ store.apartments[n + firstApartmentOnPage - 1].address }}</p>
                                <p> {{ store.apartments[n + firstApartmentOnPage - 1].description.length > 200 ? store.apartments[n + firstApartmentOnPage - 1].description.slice(0, 200) +
                                    '...' :
                                    store.apartments[n + firstApartmentOnPage - 1].description }}</p>
                            </div>
                        </router-link>
                    </div>
                </template>
            </div>

            <div v-if="store.apartments.length > itemsPerPage" class="d-flex justify-content-between flex-fill d-sm-none my-4">
                <ul class="pagination">
                    <li v-if="firstApartmentOnPage == 0" class="page-item disabled" aria-disabled="true">
                        <span class="page-link text_purple fw-bolder">&lsaquo;&lsaquo;</span>
                    </li>
                    <li v-else class="page-item">
                        <a class="page-link text_purple fw-bolder" @click.prevent="prevClick()" rel="prev">&lsaquo;&lsaquo;</a>
                    </li>

                    <li v-if="firstApartmentOnPage < store.apartments.length - itemsPerPage" class="page-item">
                        <a class="page-link text_purple fw-bolder" @click.prevent="nextClick()" rel="next">&rsaquo;&rsaquo;</a>
                    </li>
                    <li v-else class="page-item disabled" aria-disabled="true">
                        <span class="page-link text_purple fw-bolder">&rsaquo;&rsaquo;</span>
                    </li>
                </ul>
            </div>
            <div v-if="store.apartments.length > itemsPerPage" class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between my-4">
                <div>
                    <p class="small text-muted">
                        Mostrando
                        <span class="fw-semibold">{{ firstApartmentOnPage + 1 }}</span>
                        a
                        <span class="fw-semibold">{{ firstApartmentOnPage + itemsPerPage }}</span>
                        di
                        <span class="fw-semibold">{{ store.apartments.length }}</span>
                        strutture
                    </p>
                </div>

                <div>
                    <ul class="pagination">
                        <li v-if="firstApartmentOnPage == 0" class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                            <span class="page-link text_purple fw-bolder cursor_pointer" aria-hidden="true">&lsaquo;&lsaquo;</span>
                        </li>
                        <li v-else class="page-item" @click.prevent="prevClick()">
                            <a class="page-link cursor_pointer text_purple fw-bolder" rel="prev" aria-label="prev">&lsaquo;&lsaquo;</a>
                        </li>

                        <li v-if="firstApartmentOnPage < store.apartments.length - itemsPerPage" class="page-item">
                            <a class="page-link cursor_pointer text_purple fw-bolder" @click.prevent="nextClick()" rel="next" aria-label="next">&rsaquo;&rsaquo;</a>
                        </li>
                        <li v-else class="page-item disabled" aria-disabled="true" aria-label="next">
                            <span class="page-link text_purple fw-bolder cursor_pointer" aria-hidden="true">&rsaquo;&rsaquo;</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </main>
</template>

<style lang="scss" scoped></style>
