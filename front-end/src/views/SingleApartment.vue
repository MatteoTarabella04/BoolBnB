<script>
import axios from "axios";
import { nextTick } from "vue";
import tt from "@tomtom-international/web-sdk-maps";
import DrawingPin from '../components/DrawingPin.vue';



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
      ipAddress: null,
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
    registerVisit() {
      const now = new Date();
      const day = ("0" + now.getDate()).slice(-2);
      const month = ("0" + (now.getMonth() + 1)).slice(-2);
      const year = now.getFullYear();
      const seconds = ("0" + now.getSeconds()).slice(-2);
      const minutes = ("0" + now.getMinutes()).slice(-2);
      const hours = ("0" + now.getHours()).slice(-2);
      const formattedDate = year + "-" + month + "-" + day + " " + hours + ":" + minutes + ":" + seconds;

      const data = {
        apartment_id: this.apartment.id,
        visit_date: formattedDate,
        ip_address: this.ipAddress,
      }
      axios
        .post("http://127.0.0.1:8000/api/register-visit", data)
        .then(response => {
        })
        .catch(error => {
          console.error(error.message);
        })
    },
    getImagePath(path) {
      return this.base_URL + 'storage/' + path
    },
    // setPostsContainerHeight() {
    //   const infoContainer = document.getElementById('info_container');
    //   const leftSide = document.querySelector('.left_side');

    //   if (infoContainer && leftSide) {
    //     const infoContainerHeight = infoContainer.getBoundingClientRect().height;
    //     const leftSideHeight = leftSide.getBoundingClientRect().height;

    //     const maxHeight = Math.min(infoContainerHeight, leftSideHeight);
    //     infoContainer.style.height = `${maxHeight}px`;
    //     leftSide.style.height = `${maxHeight}px`;
    //   }
    // }
  },
  mounted() {
    const dataObjectScope = this;

    function getApartmentInfo() {
      return axios.get(`http://127.0.0.1:8000/api/apartments/${dataObjectScope.$route.params.slug}`);
    }

    function getIpAddress() {
      return axios.get('https://api.ipify.org?format=json');
    }

    Promise
      .all([getApartmentInfo(), getIpAddress()])
      .then(([apartmentResponse, ipAddressResponse]) => {
        this.apartment = apartmentResponse.data.apartment;
        nextTick(() => {
          const lon = apartmentResponse.data.apartment.longitude;
          const lat = apartmentResponse.data.apartment.latitude;

          let map = tt.map({
            key: this.apiKey,
            container: 'map',
            center: [lon, lat],
            zoom: 14,
          });

          let marker = new tt.Marker()
            .setLngLat([lon, lat])
            .addTo(map);
        });

        this.ipAddress = ipAddressResponse.data.ip;
        this.registerVisit();
      });

    // this.setPostsContainerHeight();
    // window.addEventListener('resize', this.setPostsContainerHeight);
  }

}
</script>

<template>
  <div v-if="apartment" class="container">
    <div class="posts_container d-flex flex-wrap mb-3">
      <div class=" col-12 col-md-7 mt-3 p-2 left_side">
        <div class="post_card image_container">
          <!-- <DrawingPin></DrawingPin> -->
          <a class="open_modal" type="button" data-bs-toggle="modal" data-bs-target="#modalId">
            <img :src="getImagePath(apartment.image)" class="card-img-top moving_image pointer card_shadow h-100"
              :alt="apartment.name + ' image'">
            <div class="position-absolute text-white bg_purple border_radius_30 px-2 m-1 top-0 mt-4 ms-2"> {{
              Math.floor(apartment.price_per_night).toLocaleString() + " €" }}</div>
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
          <h2 class="fs-2 fw-bold confortaa_font">{{ apartment.name }}</h2>
          <h5 class="purple_text">{{ apartment.apartment_type.name }}</h5>
          <div class="fs-6"> {{ apartment.address }}</div>
          <hr>
          <div>

            <div class="tooltip-wrapper me-3">
              <span class="mb-2 me-2 tooltip-trigger">
                {{ apartment.rooms }}
                <span class="ms-1 fs-6"><font-awesome-icon icon="fa-solid fa-house" /></span>
              </span>
              <div class="tooltip">Stanze</div>
            </div>
            <div class="tooltip-wrapper me-3">
              <span class="mb-2 me-2 tooltip-trigger">
                {{ apartment.bathrooms }}
                <span class="ms-1 fs-6"><font-awesome-icon icon="fa-solid fa-toilet" /></span>
              </span>
              <div class="tooltip">Bagni</div>
            </div>
            <div class="tooltip-wrapper me-3">
              <span class="mb-2 me-2 tooltip-trigger">
                {{ apartment.beds }}
                <span class="ms-1 fs-6"><font-awesome-icon icon="fa-solid fa-bed" /></span>
              </span>
              <div class="tooltip">Letti</div>
            </div>
            <div class="tooltip-wrapper me-3">
              <span class="mb-2 me-2 tooltip-trigger">
                {{ apartment.square_meters }}
                <span class="fs-6 fw-bold">Mq</span>
              </span>
              <div class="tooltip">Dimensione</div>
            </div>

          </div>
          <hr>
          <p class="confortaa_font text-dark"> {{ apartment.description }}</p>
          <hr>
          <div class=" ">
            <div v-if="apartment.services.length > 0">
              <h5 class=" mb-4 purple_text">
                Servizi inclusi nel prezzo:
              </h5>
              <div class=" d-flex flex-wrap">
                <div class="mb-2 me-3" v-for="service in apartment.services">
                  <font-awesome-icon :icon="service.icon" />
                  {{ service.name }}
                </div>
              </div>
            </div>
          </div>
        </div>



      </div>

      <div id="info_container" class="info_container col-12 col-md-5 d-flex flex-column">

        <div class="p-2 mt-md-3 aspect_ration_1">
          <input type="text" class="form-control d-none" name="latitude" id="latitude" aria-describedby="helpId"
            placeholder="" :value="apartment.latitude" required>
          <input type="text" class="form-control d-none" name="longitude" id="longitude" aria-describedby="helpId"
            placeholder="" :value="apartment.longitude" required>
          <div id="map" class="rounded-5 shadow aspect_ration_1"></div>
        </div>

        <div class="p-2 mt-md-3 ">
          <div class="card shadow rounded-5 p-2 border-0 confortaa_font">
            <div class="card-body  ">
              <h3 class="text-center mb-3">Contatta l'host</h3>
              <!-- <div class="font_size_10 text-center">Verrai ricontattato il prima possibile</div> -->
              <form>
                <div class="mb-3">
                  <label for="full_name" class="form-label">Nome e Cognome:</label>
                  <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Mario Rossi"
                    v-model="fullName">
                </div>
                <div class="mb-3">
                  <label for="sender_email" class="form-label">La tua Mail:</label>
                  <input type="email" class="form-control" id="sender_email" name="sender_email" v-model="senderEmail"
                    placeholder="mariorossi@example.com">
                </div>
                <div class="mb-3">
                  <label for="content" class="form-label">Scrivi un messaggio:</label>
                  <textarea class="form-control" id="content" name="content" v-model="content" rows="3"></textarea>
                </div>
                <button @click.prevent="sendMail()" type="submit" class="btn bg_purple text-white w-100"><span
                    class="icon"><font-awesome-icon icon="fa-solid fa-envelope" /></span>Invia</button>
              </form>
            </div>
          </div>

        </div>

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

.left_side {
  height: fit-content;
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


@media screen and (min-width: 768px) {
  .services_container {
    overflow: auto;
    max-height: 100%;
  }
}



//TOOLTIPS

.tooltip-wrapper {
  position: relative;
  display: inline-block;
}

.tooltip-trigger {
  position: relative;
}

.tooltip {
  position: absolute;
  top: -30px;
  left: 0;
  background-color: black;
  color: white;
  padding: 4px 8px;
  border-radius: 4px;
  font-size: 12px;
  opacity: 0;
  transition: opacity 0.2s;
}

.tooltip-trigger:hover+.tooltip {
  opacity: 1;
}

// Map responsive
@media screen and (max-width: 992px) {

  #map {
    height: 300px !important;
  }
}
</style>
