<script>
import axios from "axios";
export default {
    name: "UserLoginView",
    data() {
        return {
            email: "",
            password: "",
        }
    },
    methods: {
        sendLogin() {
            const data = {
                "email" : this.email,
                "password" : this.password,
            }
            this.errors = null
            axios
            .post("http://127.0.0.1:8000/api/login", data)
            .then(response => {
                if(response.data.success) {
                    window.sessionStorage.setItem("userID", response.data.user_id)
                } else {
                    this.errors = response.data.errors
                }
            })
            .catch(error => {
                this.errors = error.response.data.errors;
            })
        },
        logout() {
            const data = {
                "userID" : window.sessionStorage.getItem("userID"),
            }
            this.errors = null
            axios
            .post("http://127.0.0.1:8000/api/logout", data)
            .then(response => {
                window.sessionStorage.removeItem("userID");
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
                <div class="card mt-5 p-3">
                    <form @submit.prevent="sendLogin()">

                        <div class="mb-4">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailhelpId"
                                placeholder="Inserisci l'Email" required v-model.trim="email">
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password"
                                aria-describedby="passwordhelpId" placeholder="Inserisci la password" required
                                v-model.trim="password">
                        </div>


                        <button type="submit" class="btn btn-primary w-100">ENTRA</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>