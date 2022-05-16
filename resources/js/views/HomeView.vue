<template>
   <v-container>
    <v-row class="text-center">
      <v-col cols="12">
        <!-- <v-img
          :src="'/images/logo.svg'"
          class="my-3"
          contain
          height="200"
        /> -->
      </v-col>

      <v-col class="mb-4">
        <h1 class="display-2 font-weight-bold mb-3">
          Welcome {{ this.user.name }}
        </h1>
        <p>This site will help you learn foreign languages by repeating difficult words</p>
      </v-col>

     
    </v-row>
  </v-container>
</template>

<script>
import { mapState } from 'pinia'
import { useUserStore } from "../store/user";

export default {
  name: 'HomeView',

  computed: {
      ...mapState(useUserStore, ['user'])
  },



}
</script>
