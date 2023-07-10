import { createApp } from 'vue'
import App from './App.vue'
import { router } from './router.js'
import './styles/general.scss'

// Import all of Bootstrap's JS
import * as bootstrap from 'bootstrap'
import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faUserSecret, faUndo, faMask, faUser, faFilter, faMagnifyingGlass } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faUserSecret, faUndo, faMask, faUser, faFilter, faMagnifyingGlass)

createApp(App).use(router).component('font-awesome-icon', FontAwesomeIcon).mount('#app')
