<template>
<v-app>
    <v-app-bar app color="#F5F7F6" dark>
        <div class="d-flex align-center">
            <router-link to="/">
                <v-img :src="'/images/logo.svg'" alt="Vuetify Logo" class="shrink mr-2" contain transition="scale-transition" height="40" width="100" to="/" />
            </router-link> |
        </div>

        <v-spacer></v-spacer>

        <v-btn text color="black" to="/signin">
            <span class="mr-2">Sign in</span>
            <v-icon>mdi-lock-open</v-icon>
        </v-btn>

        <v-btn text color="black" to="/signup">
            <span class="mr-2">Sign up</span>
            <v-icon>mdi-fingerprint</v-icon>
        </v-btn>

        <v-btn text color="black" to="/about">
            <span class="mr-2">Logout</span>
            <v-icon>mdi-logout</v-icon>
        </v-btn>

    </v-app-bar>

    <v-main>
        <!-- <HelloWorld/> -->

        <router-view />
    </v-main>
</v-app>

<!-- <div id="app">
    <nav>
      <router-link to="/">Home</router-link> |
      <router-link to="/about">About</router-link>
    </nav>
    <router-view/>
  </div> -->
</template>

<script>
// import HelloWorld from './components/HelloWorld';

export default {
    name: 'App',

    // components: {
    //   HelloWorld,
    // },

    data: () => ({
        //
    }),
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
