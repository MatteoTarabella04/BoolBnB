import { createRouter, createWebHistory } from "vue-router";
import UserRegistrationView from './views/UserRegistrationView.vue'
import UserLoginView from './views/UserLoginView.vue'
import HomeView from './views/HomeView.vue'


import AddApartmentView from './views/ApartmentViews/AddApartmentView.vue'
import EditApartmentView from './views/ApartmentViews/EditApartmentView.vue'
import IndexApartmentView from './views/ApartmentViews/IndexApartmentView.vue'
import ShowApartmentView from './views/ApartmentViews/ShowApartmentView.vue'


const router = createRouter({
    history: createWebHistory(),
    routes: [
        {/* ---------------------------la view home non è stata creata al momento  */
            'path': '/',
            'name': 'Home',
            'component': HomeView
        },
        {
            'path': '/user-registration',
            'name': 'UserRegistration',
            'component': UserRegistrationView
        },
        {/* ---------------------------la view UserLogin non è stata creata al momento  */
            'path': '/user-login',
            'name': 'UserLogin',
            'component': UserLoginView
        },
        {
            'path': '/:id/add-apartment',/* da verificare */
            'name': 'AddApartment',
            'component': AddApartmentView
        },
        {
            'path': '/:id/edit-apartment',/* da verificare */
            'name': 'EditApartment',
            'component': EditApartmentView
        },
        {
            'path': '/:id/show-apartment',/* da verificare */
            'name': 'ShowApartment',
            'component': ShowApartmentView
        },
        {
            'path': '/:id/index-apartment',/* da verificare */
            'name': 'IndexApartment',
            'component': IndexApartmentView
        },

    ]
})
export { router };
