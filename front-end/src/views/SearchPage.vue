<script>
import axios from 'axios';
export default {
    name: "searchPage",
    data() {


        return {
            apartments: [],
            filteredApartments: [],
            results: [],
            inputAddress: "",
            selectAddress: null,
            selectLat: null,
            selectLon: null,
            radius: 20,
            filtering: false

        }
    },
    mounted() {
        axios
            .get("http://127.0.0.1:8000/api/apartments")
            .then(response => {

                this.apartments = response.data.apartments;
            })
            .catch(error => {
                console.error(error.message);
            })
    }
}

</script>
<template>
    <div>
        <div v-if="apartments.length > 0" class="row row-cols-3">
            <div class="col" v-for="apartment in apartments">
                <div class="card">
                    {{ apartment.name }}
                    <router-link :to="{ name: 'singleApartment', params: { slug: apartment.slug } }">DETTAGLI</router-link>
                </div>
            </div>
        </div>
    </div>
</template>


<style lang="scss" scoped></style>