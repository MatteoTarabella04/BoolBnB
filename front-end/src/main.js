import { createApp } from 'vue'
import App from './App.vue'
import { router } from './router.js'
import './styles/general.scss'

// Import all of Bootstrap's JS
import 'bootstrap/dist/css/bootstrap.css'
import * as bootstrap from 'bootstrap'

import { library } from '@fortawesome/fontawesome-svg-core'

/* import font awesome icon component */
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

/* import specific icons */
import { faUserSecret, faUndo, faEnvelope, faBed, faMask, faUser, faFilter, faMagnifyingGlass, faPersonSkiing, faBell, faDog, faFan, faPanorama, faFire, faRotateLeft, faMugSaucer, faKitchenSet, faBabyCarriage, faSmoking, faSeedling, faHouse, faHotTubPerson, faWheelchair, faDumbbell, faSquareParking, faWaterLadder, faCarOn, faSmog, faDumpsterFire, faLaptop, faShirt, faTv, faWater, faWifi, faToilet, faBars } from '@fortawesome/free-solid-svg-icons'

/* add icons to the library */
library.add(faUserSecret, faUndo, faEnvelope, faBed, faMask, faUser, faFilter, faMagnifyingGlass, faPersonSkiing, faBell, faDog, faFan, faPanorama, faFire, faRotateLeft, faMugSaucer, faKitchenSet, faBabyCarriage, faSmoking, faSeedling, faHouse, faHotTubPerson, faWheelchair, faDumbbell, faSquareParking, faWaterLadder, faCarOn, faSmog, faDumpsterFire, faLaptop, faShirt, faTv, faWater, faWifi, faToilet, faBars)

createApp(App).use(router).component('font-awesome-icon', FontAwesomeIcon).mount('#app')
