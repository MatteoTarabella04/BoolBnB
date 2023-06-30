<script>
import axios from "axios";
export default {
    name: "UserLoginView",
    data() {
        return {
            email: "",
            password: "",
            password_confirmation: "",
            first_name: null,
            last_name: null,
            date_of_birth: null
        }
    },
    methods: {
        sendRegistrationRequest() {
            const data = {
                "email": this.email,
                "password": this.password,
                "password_confirmation": this.password_confirmation,
                "first_name": this.first_name,
                "last_name": this.last_name,
                "date_of_birth": this.date_of_birth
            }
            axios
                .post("http://127.0.0.1:8000/api/register", data)
                .then(response => {
                    console.log(response)
                    window.sessionStorage.setItem("userID", response.data.user_id)
                })
                .catch(error => {
                    console.error(error);
                })
        }
    }
}
</script>

<template>

    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">


                    <form @submit.prevent="sendRegistrationRequest()">
                        <input type="email" name="email" id="email" placeholder="Insert e-mail" required v-model.trim="email">
                        <input type="password" name="password" id="password" placeholder="Insert password" required v-model.trim="password">
                        <input type="password" name="password_confirmation" id="password_confirmation"
                            placeholder="Insert password again for confirmation" required v-model.trim="password_confirmation">
                        <input type="text" name="first_name" id="first_name" placeholder="Insert first name" v-model.trim="first_name">
                        <input type="text" name="last_name" id="last_name" placeholder="Insert last name" v-model.trim="last_name">
                        <input type="date" name="date_of_birth" id="date_of_birth" v-model.trim="date_of_birth">
                        <button type="submit">Send</button>
                    </form>


                </div>
            </div>
        </div>
    </div>




</template>

<style lang="scss" scoped></style>