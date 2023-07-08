
<script>
export default {
    name: 'AppHeader'

}
</script>

<template>
    <header class="position-sticky top-0 z_index_1000 bg_primary shadow">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container ">
                <router-link :to="{name: 'home'}" class="text-decoration-none fw-bold fs-2 text-dark">BoolBnB</router-link>
                <button class="navbar-toggler d-lg-none border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">

                    <font-awesome-icon icon="fa-solid fa-user" />

                    <!-- <span class="navbar-toggler-icon"></span> -->
                </button>
                <div class="collapse navbar-collapse  " id="collapsibleNavId">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0 bg_primary z_index_999 rounded-4">
                        <li class="nav-item">
                            <a class="nav-link text-center" href="http://127.0.0.1:8000/">Area Personale</a>
                        </li>
                    </ul>
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