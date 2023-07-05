<script>
import axios from "axios";
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
    }
  },
  mounted() {
    axios
      .get(`http://127.0.0.1:8000/api/apartments/${this.$route.params.slug}`)
      .then(response => {
        console.log(response);
        this.apartment = response.data.apartment;
        console.log(this.apartment);
      })
      .catch(error => {
        console.log(error.message);
      })
  }
}
</script>

<template>
  Single apartment page

  <a class="btn btn-dark" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
    aria-controls="offcanvasExample">
    Richiedi informazioni
  </a>

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
</template>

<style lang="scss"></style>
