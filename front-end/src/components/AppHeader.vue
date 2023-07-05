
<script>
export default {

}
</script>

<template>
    <header class="position-sticky top-0 z_index_1000 shadow">
        <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
                <a class="text-decoration-none fw-bold fs-2 text-dark" href="/">BoolBnB</a>
                <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse"
                    data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                        <!--                     @guest   fare dei controlli per vedere se l'utente sia loggato  -->
                        <li class="nav-item">
                            <a class="nav-link" href="http://127.0.0.1:8000/login">Accedi</a>
                        </li>
                        <!--                         @if (Route::has('register'))  -->
                        <li class="nav-item">
                            <a class="nav-link" href="http://127.0.0.1:8000/register">Registrati</a>
                        </li>
                        <!--                         @endif
                    @else -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <!--                                 {{ Auth::user()->first_name . ' ' . Auth::user()->last_name }} -->
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="http://127.0.0.1:8000/admin/dashboard">Dashboard</a>
                                <!-- <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    Esci
                                </a> -->
                                <!--  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                </form> -->
                            </div>
                        </li>
                        <!--                         @endguest -->

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