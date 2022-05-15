<template>
<div>
    <v-alert class="text-center" :type="type" dismissible :value="!!this.message">
      {{ message }}
    </v-alert>
</div>
</template>

<script>
export default {
    name: 'Alert',
    props: {
        message: String,
        type: String
    }
}
</script>
