
<script>
export default {

}
</script>

<template>
    <header>


        <nav class="navbar navbar-expand-md navbar-light bg-light">
            <div class="container">
                <router-link class="navbar-brand" :to="{ 'name': 'Home' }">BoolBnB</router-link>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">

                        <li class="nav-item">
                            <a class="nav-link" href="http://127.0.0.1:8000/login">
                                <span>Accedi</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="http://127.0.0.1:8000/register">
                                <span>Registrati</span>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <router-link class="nav-link" class-active="" :to="{ 'name': 'Home' }">
                                <span>Esci</span>
                            </router-link>
                        </li> -->

                        <!-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                            <div class="dropdown-menu" aria-labelledby="dropdownId">
                                <a class="dropdown-item" href="#">Action 1</a>
                                <a class="dropdown-item" href="#">Action 2</a>
                            </div>
                        </li> -->
                    </ul>
                    <!-- <form class="d-flex my-2 my-lg-0">
                        <input class="form-control me-sm-2" type="text" placeholder="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form> -->
                </div>
            </div>
        </nav>



    </header>
</template>

<style lang="scss">
@use '../styles/partials/colors.scss' as *;

header {

    & .navbar {
        background-color: $bg-primary !important;
    }

    & .nav-link {
        color: $text-primary !important;
    }

    & .nav-item {
        border-radius: .5rem;
        transition-property: all;
        transition-duration: .4s;
    }

    & .nav-item:hover {
        background-color: $bg-primary-hover !important;
    }
}

body {
    background-color: $bg-secondary !important;

    & .card {
        background-color: $bg-special-light !important;
    }
}
</style>