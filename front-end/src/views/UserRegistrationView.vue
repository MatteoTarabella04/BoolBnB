<script>
import axios from "axios";
export default {
    name: "UserRegistrationView",
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
                <div class="card mt-5 p-3">
                    <form @submit.prevent="sendRegistrationRequest()">

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

                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Conferma la tua password</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                id="password_confirmation" aria-describedby="password_confirmationhelpId"
                                placeholder="Inserisci nuovamente la password per conferma" required v-model.trim="password_confirmation">
                        </div>

                        <div class="mb-4">
                            <label for="first_name" class="form-label">Nome</label>
                            <input type="text" class="form-control" name="first_name" id="first_name"
                                aria-describedby="first_namehelpId" placeholder="Inserisci il tuo nome" required
                                v-model.trim="first_name">
                        </div>

                        <div class="mb-4">
                            <label for="last_name" class="form-label">Cognome</label>
                            <input type="text" class="form-control" name="last_name" id="last_name"
                                aria-describedby="last_namehelpId" placeholder="Inserisci il tuo cognome" required
                                v-model.trim="last_name">
                        </div>

                        <div class="mb-4">
                            <label for="date_of_birth" class="form-label">Data di nascita</label>
                            <input type="date" class="form-control" name="date_of_birth" id="date_of_birth"
                                aria-describedby="date_of_birthhelpId" placeholder="Inserisci la tua data di nascita"
                                required v-model.trim="date_of_birth">
                        </div>

                        <button type="submit" class="btn btn-primary w-100">CONFERMA</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<style lang="scss" scoped></style>