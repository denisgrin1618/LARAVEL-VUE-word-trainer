<template>
<v-container fluid>
    <v-layout row wrap>
        <v-flex xs12 class="text-xs-center" mt-5>
            <h1>Sign In</h1>
        </v-flex>
        <v-flex xs12 sm6 offset-sm3 mt-3>
            <form @submit="formSubmit">
                <v-layout column>
                    <v-flex>
                        <v-text-field name="email" label="Email" id="email" type="email" required v-model="email"></v-text-field>
                    </v-flex>
                    <v-flex>
                        <v-text-field name="password" label="Password" id="password" type="password" required v-model="password"></v-text-field>
                    </v-flex>
                    <v-flex class="text-xs-center" mt-5>
                        <v-btn color="primary" type="submit">Sign In</v-btn>
                    </v-flex>
                </v-layout>
            </form>
        </v-flex>
    </v-layout>
</v-container>
</template>

<script>
import {
    mapWritableState
} from 'pinia'
import {
    useUserStore
} from "../store/user";

export default {

    data: function () {
        return {
            email: '',
            password: ''
        };
    },

    computed: {
        ...mapWritableState(useUserStore, ['user', 'isAuthenticated'])
    },

    methods: {

        formSubmit(e) {
            e.preventDefault();

            axios.post('/api/login', {
                    email: this.email,
                    password: this.password
                })
                .then((response) => {
                    this.user.token = response.data.data.token;
                    this.user.name = response.data.data.name;
                    this.isAuthenticated = true;
                    this.$cookies.set('apitoken', this.user.token)
                    this.$cookies.set('username', this.user.name)
                    axios.defaults.headers.common['Authorization'] = `Bearer ${this.user.token}`;
                    this.$router.push('/')
                })
                .catch(function (error) {
                    console.log(error);
                });
        }

    }

}
</script>
