<template>
<v-app :style="{background: $vuetify.theme.themes[theme].background}">
    <v-app-bar app color="#F5F7F6" dark v-if="mobile">

        <v-app-bar-nav-icon @click="drawer = true" color="black"></v-app-bar-nav-icon>

        <v-spacer></v-spacer>
        <div class="d-flex align-center">
            <router-link to="/">
                <v-img :src="'/images/logo.svg'" alt="Vuetify Logo" class="shrink mr-2" contain transition="scale-transition" height="40" width="100" to="/" />
            </router-link> |
        </div>

    </v-app-bar>
    <v-app-bar app color="#F5F7F6" dark v-if="!mobile">

        <div class="d-flex align-center">
            <router-link to="/">
                <v-img :src="'/images/logo.svg'" alt="Logo" class="shrink mr-2" contain transition="scale-transition" height="40" width="100" to="/" />
            </router-link> |
        </div>

        <v-tabs color="black" centered>

            <v-spacer></v-spacer>

            <v-tab class="black--text" to="/words">Words</v-tab>
            <v-tab class="black--text">Tab 2</v-tab>
            <v-tab class="black--text">Tab 3</v-tab>
            <v-tab class="black--text">Tab 4</v-tab>

            <v-spacer></v-spacer>

            <v-tab class="black--text" to="/signin" v-if="!this.isAuthenticated">
                <span class="mr-2">Sign in</span>
                <v-icon color="black">mdi-lock-open</v-icon>
            </v-tab>
            <v-tab class="black--text" to="/signup" v-if="!this.isAuthenticated">
                <span class="mr-2">Sign up</span>
                <v-icon color="black">mdi-fingerprint</v-icon>
            </v-tab>
        </v-tabs>

        <!-- <v-btn text color="black" to="/signin" v-if="!this.isAuthenticated">
            <span class="mr-2">Sign in</span>
            <v-icon>mdi-lock-open</v-icon>
        </v-btn>

        <v-btn text color="black" to="/signup" v-if="!this.isAuthenticated">
            <span class="mr-2">Sign up</span>
            <v-icon>mdi-fingerprint</v-icon>
        </v-btn> -->

        <!-- <span class="mr-2 black--text" v-if="this.isAuthenticated">{{this.user.name}}</span> -->

        <v-btn text color="black" @click="logout" v-if="this.isAuthenticated">
            <span class="mr-2">Logout</span>
            <v-icon>mdi-logout</v-icon>
        </v-btn>

    </v-app-bar>

    <v-navigation-drawer v-model="drawer" absolute temporary>
        <v-list nav dense>
            <v-list-item-group active-class="deep-purple--text text--accent-4">
                <v-list-item to="/">
                    <v-list-item-icon>
                        <v-icon>mdi-home</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Home</v-list-item-title>
                </v-list-item>

                <v-list-item to="/signin" v-if="!this.isAuthenticated">
                    <v-list-item-icon>
                        <v-icon>mdi-lock-open</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Sign in</v-list-item-title>
                </v-list-item>

                <v-list-item to="/signup" v-if="!this.isAuthenticated">
                    <v-list-item-icon>
                        <v-icon>mdi-fingerprint</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Sign up</v-list-item-title>
                </v-list-item>

                <v-list-item @click="logout" v-if="this.isAuthenticated">
                    <v-list-item-icon>
                        <v-icon>mdi-logout</v-icon>
                    </v-list-item-icon>
                    <v-list-item-title>Logout</v-list-item-title>
                </v-list-item>
            </v-list-item-group>
        </v-list>
    </v-navigation-drawer>

    <v-main>
        <!-- <Alert message="sdfsdf" type="error"></Alert> -->
        <router-view />
    </v-main>
</v-app>
</template>

<script>
import Alert from './components/Alert.vue'
import { mapWritableState } from 'pinia'
import { useUserStore } from "./store/user";

export default {
    name: 'App',

    components: {
        Alert
    },
    data() {
        return {
            drawer: false,
            mobile: false
        }
    },
    computed: {
        ...mapWritableState(useUserStore, ['user', 'isAuthenticated']),
        theme() {
            return (this.$vuetify.theme.dark) ? 'dark' : 'light'
        }
    },
    methods: {
        readCookie(){
            if (this.$cookies.isKey('apitoken')){
                this.isAuthenticated = true
                this.user.name = this.$cookies.get('username')
                this.user.token = this.$cookies.get('apitoken')
                this.$router.push('/');
            }           
        },
        detectScreenChange() {
            this.mobile = window.innerWidth < 560;
        },
        logout() {
            this.isAuthenticated = false;
            this.user.name = '';
            this.user.token = '';
            axios.defaults.headers.common['Authorization'] = null;
            this.$router.push('/signin');
        }
    },
    mounted() {
        this.$nextTick(() => {
            window.addEventListener('resize', this.detectScreenChange)
        })
        this.readCookie()
    },
    created() {
        this.detectScreenChange(); // when instance is created
    }

};
</script>

<style lang="scss">
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
}

nav {
    padding: 30px;

    a {
        font-weight: bold;
        color: #2c3e50;

        &.router-link-exact-active {
            color: #42b983;
        }
    }
}
</style>
