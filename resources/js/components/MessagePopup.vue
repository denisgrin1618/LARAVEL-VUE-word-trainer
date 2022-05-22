<template>
<v-dialog v-model="dialog" persistent max-width="290">
    <!-- <template v-slot:activator="{ on, attrs }">
        <v-btn color="primary" dark v-bind="attrs" v-on="on">
            Open Dialog
        </v-btn>
    </template> -->
    <v-card>
        <v-card-title class="text-h5">
            Message
        </v-card-title>
        <v-card-text> {{ this.message }}</v-card-text>
        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="green darken-1" text @click="ok">
                OK
            </v-btn>
        </v-card-actions>
    </v-card>
</v-dialog>
</template>

<script>
import { mapActions, mapWritableState } from 'pinia'
import { useMessagesStore } from "../store/messages";

export default {
    data() {
        return {
            dialog: false,
        }
    },

    watch: {
        message(newMessage){
            if (newMessage) this.dialog = true
        }
    },

    computed: {
        ...mapWritableState(useMessagesStore, ['message'])
    },

    methods: {
        ok(){
            this.message = ''
            this.dialog = false
        }
    },
}
</script>
