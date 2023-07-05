import { createRouter, createWebHistory } from "vue-router";
import HomeView from './views/HomeView.vue';
import SingleApartment from "./views/SingleApartment.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            'path': '/',
            'name': 'home',
            'component': HomeView
        },
        {
            'path': '/apartment/:slug',
            'name': 'singleApartment',
            'component': SingleApartment
        },
    ],
    scrollBehavior() {
        return { top: 0, left: 0 }
    }
})
export { router };
