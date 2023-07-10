
<script>
export default {
    name: 'AppHeader'

}
</script>

<template>
    <header class="position-sticky top-0 z_index_1000 bg_primary shadow">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container ">

                <router-link :to="{name: 'home'}" class="text-decoration-none fw-bold fs-2 text-dark">
                <img class="logo" src="../assets/logo/second-01.svg" alt="">
                </router-link>

                <button class="navbar-toggler d-lg-none border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">

                    <font-awesome-icon icon="fa-solid fa-user" />

                    <!-- <span class="navbar-toggler-icon"></span> -->
                </button>
                <div class="collapse navbar-collapse  " id="collapsibleNavId">
                    <div class="navbar-nav ms-auto mt-2 mt-lg-0 bg_primary z_index_999 rounded-4">
                        <router-link :to="{ 'name': 'home' }" class="nav-link">
                            <span class="font_w500 underline-on-hover text_shadow "
                                :class="{ 'selected_link': $route.name === 'home' }">Home</span>
                        </router-link>
                        <router-link :to="{ 'name': 'searchPage' }" class="nav-link text_shadow">
                            <span class="nav-item mx-2 underline-on-hover"
                                :class="{ 'selected_link': $route.name === 'searchPage' }">Ricerca
                            </span>
                        </router-link>
                        <div class="nav-item fw">
                            <a class="nav-link text-center" href="http://127.0.0.1:8000/">Area Personale</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<style lang="scss">
@use '../styles/partials/colors.scss' as *;

header {
    font-family: 'Comfortaa', cursive;
    background-color: #f0f0f0;
}
</style>