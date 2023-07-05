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
                full_name : this.fullName,
                sender_email : this.senderEmail,
                content : this.content,
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

<a class="btn btn-primary" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
  Link with href
</a>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <form>
        <input type="text" name="full_name" id="full_name" v-model="fullName">
        <input type="text" name="sender_email" id="sender_email" v-model="senderEmail">
        <input type="text" name="content" id="content" v-model="content">
        <button @click.prevent="sendMail()" type="submit">INVIA</button>
    </form>
  </div>
</div>
</template>

<style lang="scss"></style>
