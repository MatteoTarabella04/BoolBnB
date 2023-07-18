import { createRouter, createWebHistory } from "vue-router";
import HomeView from './views/HomeView.vue';
import SearchPage from './views/SearchPage.vue';
import SingleApartment from "./views/SingleApartment.vue";
import infoPrivacy from './views/infoPrivacy.vue';
import infoContatti from './views/infoContatti.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            'path': '/',
            'name': 'home',
            'component': HomeView
        },
        {
            'path': '/search-page',
            'name': 'searchPage',
            'component': SearchPage
        },
        {
            'path': '/apartment/:slug',
            'name': 'singleApartment',
            'component': SingleApartment
        },
        {
            'path': '/info-contatatti',
            'name': 'infoContatti',
            'component': infoContatti
        },
        {
            'path': '/privacy',
            'name': 'infoPrivacy',
            'component': infoPrivacy
        },
    ],
    scrollBehavior() {
        return { top: 0, left: 0 }
    }
})
export { router };
