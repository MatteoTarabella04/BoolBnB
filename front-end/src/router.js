import { createRouter, createWebHistory } from "vue-router";
import UserRegistrationView from './views/UserRegistrationView.vue'
import AddApartmentView from './views/ApartmentViews/AddApartmentView.vue'
import EditApartmentView from './views/ApartmentViews/EditApartmentView.vue'
import IndexApartmentView from './views/ApartmentViews/IndexApartmentView.vue'
import ShowApartmentView from './views/ApartmentViews/ShowApartmentView.vue'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {/* ---------------------------la view home non è stata creata al momento  */
            'path': '/',
            'name': 'home',
            'component': Homeview
        },
        {
            'path': '/user-login',
            'name': 'user-login',
            'component': UserRegistrationView
        },
        {
            'path': '/:id/AddApartment',/* da verificare */
            'name': 'AddApartment',
            'component': AddApartmentView
        },
        {
            'path': '/:id/EditApartment',/* da verificare */
            'name': 'EditApartment',
            'component': EditApartmentView
        },
        {
            'path': '/:id/ShowApartment',/* da verificare */
            'name': 'ShowApartment',
            'component': ShowApartmentView
        },
        {
            'path': '/:id/IndexApartment',/* da verificare */
            'name': 'IndexApartment',
            'component': IndexApartmentView
        },
    ]
})
