<script>
import axios from "axios";
import tt from "@tomtom-international/web-sdk-maps";
import DrawingPin from '../components/DrawingPin.vue';


import { nextTick } from "vue";
/* import { showMap } from "../js/map.js"; */
export default {
  data() {
    return {
      apartment: null,
      fullName: "",
      senderEmail: "",
      content: "",
      base_URL: 'http://127.0.0.1:8000/',
      // TODO mettere api-key in file separato, non pushato su GitHub, ed importarlo in alto
      apiKey: 'EzjZV0IZ4ed8DMmJXesJTqZNFMWxQ0E5',
    }
  },
  components: {
    DrawingPin,
  },
  methods: {
    sendMail() {
      const data = {
        full_name: this.fullName,
        sender_email: this.senderEmail,
        content: this.content,
        apartment_id: this.apartment.id,
      }

      axios
        .post("http://127.0.0.1:8000/api/contacts", data)
        .then(response => {
          console.log(response);
        })

      this.fullName = '';
      this.senderEmail = '';
      this.content = '';
    },
    getImagePath(path) {
      return this.base_URL + 'storage/' + path
    }

  },
  mounted() {
    axios
      .get(`http://127.0.0.1:8000/api/apartments/${this.$route.params.slug}`)
      .then(response => {
        this.apartment = response.data.apartment;

        nextTick(() => {
          const lon = response.data.apartment.longitude;
          const lat = response.data.apartment.latitude;

          let map = tt.map({
            key: this.apiKey,
            container: 'map',
            center: [lon, lat],
            zoom: 14,
          })

          let marker = new tt.Marker()
            .setLngLat([lon, lat])
            .addTo(map)
        })
      })
      .catch(error => {
        console.error(error.message);
      });
  }
}
</script>

<template>
  <!-- TODO completare pagina -->
  <div v-if="apartment" class="container">

    <div class="posts_container d-flex flex-wrap mb-3">

      <div class=" col-12 col-md-7 mt-3 ">
        <div class="post_card image_container">
          <a class="open_modal" type="button" data-bs-toggle="modal" data-bs-target="#modalId">
            <img :src="getImagePath(apartment.image)" class="card-img-top moving_image pointer card_shadow h-100"
              :alt="apartment.name + ' image'">
          </a>
          <!-- Modal Body -->
          <div class="modal fade text-center" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl position-relative"
              role="document">
              <div class="modal-content">
                <div class="modal-body p-0">
                  <button type="button" class="modal_close_button" data-bs-dismiss="modal" aria-label="Close">
                    ✖
                  </button>
                  <img :src="`http://127.0.0.1:8000/storage/` + apartment.image" :alt="apartment.name" class="img-fluid">
                </div>
              </div>
            </div>
          </div>
          <h2 class="fs-2 fw-bold">{{ apartment.name }}</h2>
          <h4>{{ apartment.apartment_type.name }}</h4>
          <p class="fs-6"> {{ apartment.address }}</p>
          <p> {{ apartment.description }}</p>
        </div>

        <div class="mt-3 text-center">
          <div class="card mb-3 shadow">
            <div class="card-body">
              <span class="d-block">
                <strong class="fs-4">{{ apartment.price_per_night }}€</strong> /notte
              </span>
              <a class="btn btn-dark mt-2" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
                aria-controls="offcanvasExample">
                Contatta la struttura
              </a>
            </div>
          </div>
        </div>

      </div>


      <div class=" col-12 col-md-5">

        <div class="post_card image_container mt-3 aspect_ratio_1 card_scrollable"
          style="transform: rotate(-2deg);top: -10px;">
          <h5 class="mb-3 fw-bold">
            Dimensioni :
          </h5>
          <span class="mb-3">
            {{ apartment.square_meters + ' mq' }}
          </span>
          <h5 class="mb-3 fw-bold">
            Numero stanze :
          </h5>
          <span class="mb-3">
            {{ apartment.rooms }}
          </span>
          <h5 class="mb-3 fw-bold">
            Numero bagni :
          </h5>
          <span class="mb-3">
            {{ apartment.bathrooms }}
          </span>
          <h5 class="mb-3 fw-bold">
            Letti disponibili :
          </h5>
          <span class="">
            {{ apartment.beds }}
          </span>
        </div>
        <div v-if="apartment.services.length > 0" class="post_card services_container image_container card_scrollable"
          style="transform: rotate(2deg);">

          <h5 class="mb-3">
            Servizi inclusi nel prezzo:
          </h5>
          <ul class="m-0">
            <li class="mb-3" v-for="service in apartment.services">
              {{ service.name }}
            </li>
          </ul>
        </div>

      </div>

    </div>



    <div class="col-12 p-3 d-flex flex-wrap justify-content-center">
      <input type="text" class="form-control d-none" name="latitude" id="latitude" aria-describedby="helpId"
        placeholder="" :value="apartment.latitude" required>
      <input type="text" class="form-control d-none" name="longitude" id="longitude" aria-describedby="helpId"
        placeholder="" :value="apartment.longitude" required>

      <div id="map" class="rounded-2 shadow">
      </div>

    </div>


    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Contatta il proprietario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <form>
          <div class="mb-3">
            <label for="full_name" class="form-label">Nome e Cognome:</label>
            <input type="text" class="form-control" id="full_name" name="full_name" v-model="fullName">
          </div>
          <div class="mb-3">
            <label for="sender_email" class="form-label">La tua Mail:</label>
            <input type="email" class="form-control" id="sender_email" name="sender_email" v-model="senderEmail"
              placeholder="name@example.com">
          </div>
          <div class="mb-3">
            <label for="content" class="form-label">Scrivi un messaggio:</label>
            <textarea class="form-control" id="content" name="content" v-model="content" rows="3"></textarea>
          </div>
          <button @click.prevent="sendMail()" type="submit" class="btn btn-dark">Invia</button>
        </form>
      </div>
    </div>
  </div>
</template>

<style lang="scss">
.card_scrollable {
  max-height: 370px;
  overflow-y: auto;

  li:last-child {
    margin: 0 !important;
  }
}

.modal_close_button {
  position: absolute;

  top: 0;
  right: 0;

  padding: 1rem;

  background-color: transparent;
  border: none;
}

#map {
  width: 100%;
  height: 400px;
}
</style>
