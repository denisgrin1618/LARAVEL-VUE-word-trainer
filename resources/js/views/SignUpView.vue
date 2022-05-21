<template>
<v-container fluid>
    <v-layout row wrap>
        <v-flex xs12 class="text-xs-center" mt-5>
            <h1>Sign Up</h1>
        </v-flex>
        <v-flex xs12 sm6 offset-sm3 mt-3>
            <form @submit="formSubmit">
                <v-layout column>
                    <v-flex>
                        <v-text-field name="name" label="Name" id="name" type="name" required v-model="name"></v-text-field>
                    </v-flex>
                    <v-flex>
                        <v-text-field name="email" label="Email" id="email" type="email" required v-model="email"></v-text-field>
                    </v-flex>
                    <v-flex>
                        <v-text-field name="password" label="Password" id="password" type="password" required v-model="password"></v-text-field>
                    </v-flex>
                    <v-flex>
                        <v-text-field name="confirmPassword" label="Confirm Password" id="confirmPassword" type="password" required v-model="password_confirmation"></v-text-field>
                    </v-flex>
                    <v-flex class="text-xs-center" mt-5>
                        <v-btn color="primary" type="submit">Sign Up</v-btn>
                    </v-flex>
                </v-layout>
            </form>
        </v-flex>
    </v-layout>
</v-container>
</template>

<script>
import { mapActions, mapWritableState } from 'pinia'
import { useUserStore } from "../store/user";

export default {

    data: function () {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        };
    },

    computed: {
        ...mapWritableState(useUserStore, ['user', 'isAuthenticated'])
    },
    mounted() {
        this.name = this.user.name;
    },

    methods: {
      ...mapActions(useUserStore, ['signUp']),
      formSubmit(e) {
        e.preventDefault();
        this.signUp(this.name, this.email, this.password, this.password_confirmation)
      }
    }

}
</script>
