
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
    <div class="row row-cols-3">
        <div class="col" v-for="apartment in apartments">
            <div class="card">
                {{ apartment.name }}
                {{ apartment.id }}
                {{ apartment.slug }}
                <router-link :to="{name: 'singleApartment', params:{slug: apartment.slug}}">DETTAGLI</router-link>
            </div>
        </div>
    </div>
</div>
</template>

<style lang="scss" scoped>

</style>