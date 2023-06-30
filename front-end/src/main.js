import { createApp } from 'vue'
import App from './App.vue'
import './styles/general.scss'
// Import all of Bootstrap's JS
import * as bootstrap from 'bootstrap'
import { router } from './router'
createApp(App).use(router).mount('#app')
