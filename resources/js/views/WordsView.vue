<template>
<v-container>

    <v-data-table :headers="headers" :items="words" :languages="languages" sort-by="calories" class="elevation-1" :items-per-page="5">
        <template v-slot:top>
            <v-toolbar flat>
                <!-- <v-toolbar-title>My CRUD</v-toolbar-title> -->
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="500px">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn color="primary" dark class="mb-2" v-bind="attrs" v-on="on">
                            New Item
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="text-h5">{{ formTitle }}</span>
                        </v-card-title>

                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12" sm="6" md="6">
                                        <v-text-field v-model="editedItem.word_origin.name" label="Word1"></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="6">
                                        <v-select v-model="editedItem.word_origin.language.name" :items="languages" item-text="name"></v-select>
                                        <!-- <v-text-field v-model="editedItem.word_origin.language.name" label="Lang1"></v-text-field> -->
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6">
                                        <v-text-field v-model="editedItem.word_translation.name" label="Word2"></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="6">
                                        <v-select v-model="editedItem.word_translation.language.name" :items="languages" item-text="name"></v-select> 
                                        <!-- <v-text-field v-model="editedItem.word_translation.language.name" label="Lang2"></v-text-field> -->
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="close">
                                Cancel
                            </v-btn>
                            <v-btn color="blue darken-1" text @click="save">
                                Save
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <v-dialog v-model="dialogDelete" max-width="500px">
                    <v-card>
                        <v-card-title class="text-h5">Are you sure you want to delete this item?</v-card-title>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
                            <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-toolbar>
        </template>
        <template v-slot:item.actions="{ item }">
            <v-icon small class="mr-2" @click="editItem(item)">
                mdi-pencil
            </v-icon>
            <v-icon small @click="deleteItem(item)">
                mdi-delete
            </v-icon>
        </template>
        <template v-slot:no-data>
            <v-btn color="primary" @click="initialize">
                Reset
            </v-btn>
        </template>
    </v-data-table>
</v-container>
</template>

<script>
export default {

    data: () => ({
        dialog: false,
        dialogDelete: false,
        headers: [{
                text: 'Word1',
                align: 'start',
                sortable: false,
                value: 'word_origin.name',
            },
            {
                text: 'Lang1',
                value: 'word_origin.language.name'
            },
            {
                text: 'Word2',
                value: 'word_translation.name'
            },
            {
                text: 'Lang2',
                value: 'word_translation.language.name'
            },
            {
                text: 'Actions',
                value: 'actions',
                sortable: false
            },
        ],
        words: [],
        editedIndex: -1,
        editedItem: {
            id: 0,
            word_origin: {
                id: 0,
                name: "",
                language: {
                    id: 0,
                    name: ""
                }
            },
            word_translation: {
                id: 0,
                name: "",
                language: {
                    id: 0,
                    name: ""
                }
            }
        },
        defaultItem: {
            id: 0,
            word_origin: {
                id: 0,
                name: "",
                language: {
                    id: 0,
                    name: ""
                }
            },
            word_translation: {
                id: 0,
                name: "",
                language: {
                    id: 0,
                    name: ""
                }
            }
        },
        languages: []
    }),

    computed: {
        formTitle() {
            return this.editedIndex === -1 ? 'New Item' : 'Edit Item'
        },
    },

    watch: {
        dialog(val) {
            val || this.close()
        },
        dialogDelete(val) {
            val || this.closeDelete()
        },
    },

    created() {
        this.initialize()
    },

    methods: {

        editTranslation($t) {
            axios.post(`/api/v1/translations`, {
                    word_origin_id: $t.word_origin.id,
                    word_translation_id: $t.word_translation.id,
                })
                .then((response) => {
                    $t = response.data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        editTranslation($t) {
            // axios.put(`/api/v1/translations/${$t.id}`, {
            //     word_origin_id: $t.word_origin.id,
            //     word_translation_id: $t.word_translation.id,
            // })
            // .then((response) => {
            //     console.log(response);
            // })
            // .catch(function (error) {
            //     console.log(error);
            // });

            axios.put(`/api/v1/words/${$t.word_origin.id}`, {
                    name: $t.word_origin.name,
                    language_id: $t.word_origin.language.id,
                })
                .then((response) => {
                    $t.word_origin = response.data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });

            axios.put(`/api/v1/words/${$t.word_translation.id}`, {
                    name: $t.word_translation.name,
                    language_id: $t.word_translation.language.id,
                })
                .then((response) => {
                    $t.word_translation = response.data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },
        initialize() {

            axios.get('/api/v1/translations')
                .then((response) => {
                    console.log(response);
                    this.words = response.data.data
                })
                .catch(function (error) {
                    console.log(error);
                });

            axios.get('/api/v1/languages')
                .then((response) => {
                    console.log(response);
                    this.languages = response.data.data
                })
                .catch(function (error) {
                    console.log(error);
                });

        },

        editItem(item) {
            this.editedIndex = this.words.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
            console.log(item);
        },

        deleteItem(item) {
            this.editedIndex = this.words.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm() {
            this.words.splice(this.editedIndex, 1)
            this.closeDelete()
        },

        close() {
            this.dialog = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        closeDelete() {
            this.dialogDelete = false
            this.$nextTick(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            })
        },

        save() {
            if (this.editedIndex > -1) {
                Object.assign(this.words[this.editedIndex], this.editedItem)
            } else {
                this.words.push(this.editedItem)
            }
            this.editTranslation(this.editedItem)
            this.close()
        },
    },
}
</script>
