<script>
import axios from "axios";
import tt from "@tomtom-international/web-sdk-maps";
import { nextTick } from "vue";
/* import { showMap } from "../js/map.js"; */
// import AppHeader from '../components/AppHeader.vue';
export default {
  components: {
    // AppHeader,
  },
  data() {
    return {
      apartment: null,
      fullName: "",
      senderEmail: "",
      content: "",
      apiKey: 'EzjZV0IZ4ed8DMmJXesJTqZNFMWxQ0E5',
    }
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
    },

  },
  mounted() {
    axios
      .get(`http://127.0.0.1:8000/api/apartments/${this.$route.params.slug}`)
      .then(response => {
        console.log(response);
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
          console.log(
            document.getElementById('map')
          );

        })



      })
      .catch(error => {
        console.log(error.message);
      });


  }
}
</script>

<template>
  <!-- TODO completare pagina -->
  <div v-if="apartment" class="container">
    <h2>
      {{ apartment.name }}
    </h2>

    <div class="top d-flex gap-3 mb-3">
      <div class="col-7 image_container">

        <!-- Modal trigger button -->

        <a class="open_modal" type="button" data-bs-toggle="modal" data-bs-target="#modalId">
          <img :src="`http://127.0.0.1:8000/storage/` + apartment.image" :alt="apartment.name"
            class="img-fluid rounded-3">
        </a>

        <!-- Modal Body -->
        <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
        <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
          role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
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

      </div>
      <div class="col-3">
        <div class="card mb-2">
          <div class="card-body">
            <span>
              <strong class="fs-4">{{ apartment.price_per_night }}€</strong> notte
            </span>
            <a class="btn btn-dark my-2" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
              aria-controls="offcanvasExample">
              Richiedi informazioni
            </a>
          </div>
        </div>
        <div class="card">
          <div class="card-body card_scrollable">
            <h5>
              Servizi:
            </h5>
            <ul class="" v-for="service in apartment.services">
              <li>
                {{ service.name }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="middle col-9">
      <p>
        {{ apartment.description }}
      </p>
    </div>

    <div class="bottom">
      <input type="text" class="form-control d-none" name="latitude" id="latitude" aria-describedby="helpId"
        placeholder="" :value="apartment.latitude" required>
      <input type="text" class="form-control d-none" name="longitude" id="longitude" aria-describedby="helpId"
        placeholder="" :value="apartment.longitude" required>

      <div id="map" class="rounded-2 strong_shadow my-4">
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
  height: 370px;
  overflow-y: auto;
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
