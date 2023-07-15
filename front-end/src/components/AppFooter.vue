<script>
import { store } from "../store.js";
export default {
    name: 'AppHeader',
    data() {
        return {
            store,
        }
    }
}
</script>

<template>
    <footer class="bg_primary" @click.stop="store.results = []">
        <div
            class="container d-flex justify-content-between align-items-center flex-column flex-md-row h-100 gap-3 gap-md-0 p-3">


            <router-link :to="{ name: 'infoPrivacy' }" class="text-decoration-none">
                <div class="cursor_pointer border_bottom_hover text-center text-md-start " style="width: 121px;">
                    Privacy
                </div>
            </router-link>

            <div class="Copyright text-center fw-bold text-dark order-1 order-md-0">
                Copyright © 2023 BoolBnB.com™

            </div>
            <router-link :to="{ name: 'infoContatti' }" class="text-decoration-none">
                <div class="cursor_pointer border_bottom_hover text-center text-md-start ">
                    info & Contatti
                </div>
            </router-link>
        </div>
    </footer>
</template>

<style lang="scss">
@use '../styles/partials/colors.scss' as *;

footer {
    font-family: 'Comfortaa', cursive;
    background-color: #f0f0f0;
    box-shadow: -1px -1px 20px 5px rgba(0, 0, 0, 0.15);
    position: relative;
    bottom: 0;

    &>div {
        min-height: 76px;

        div {

            color: rgb(95, 95, 95);
        }


    }

}
</style>