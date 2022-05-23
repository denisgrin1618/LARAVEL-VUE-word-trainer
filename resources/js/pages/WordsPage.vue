<template>
<v-container>

    <v-data-table :headers="headers" :items="translations" :languages="languages" sort-by="calories" class="elevation-1" :items-per-page="5" :search="search" :custom-filter="filterText">
        <template v-slot:top>
            <v-toolbar flat>
                <v-text-field v-model="search" label="Search" class="mt-4"></v-text-field>
                <!-- <v-divider class="mx-4" inset vertical></v-divider> -->
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
                                        <v-select v-model="editedItem.word_origin.language" :items="languages" item-text="name" return-object></v-select>
                                    </v-col>

                                    <v-col cols="12" sm="6" md="6">
                                        <v-text-field v-model="editedItem.word_translation.name" label="Word2"></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="6">
                                        <v-select v-model="editedItem.word_translation.language" :items="languages" item-text="name" return-object></v-select>
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
import { mapActions, mapWritableState } from 'pinia'
import { useTranslationStore } from "../store/translations";
import { useLanguageStore } from "../store/languages";

export default {

    data: () => ({
        dialog: false,
        search: '',
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
        }
    }),

    computed: {
        ...mapWritableState(useTranslationStore, ['translations']),
        ...mapWritableState(useLanguageStore, ['languages']),
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

        ...mapActions(useTranslationStore, ['getTranslations', 'saveTranslation']),
        ...mapActions(useLanguageStore, ['getLanguages']),

        deleteTranslation(item) {
            axios.delete('/api/v1/translations/' + item.id)
        },

        initialize() {
            this.getTranslations()
            this.getLanguages()
        },

        editItem(item) {
            this.editedIndex = this.translations.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialog = true
            console.log(item);
        },

        deleteItem(item) {
            this.editedIndex = this.translations.indexOf(item)
            this.editedItem = Object.assign({}, item)
            this.dialogDelete = true
        },

        deleteItemConfirm() {
            this.deleteTranslation(this.editedItem)
            this.translations.splice(this.editedIndex, 1)
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
            // if (this.editedIndex > -1) {
            //     Object.assign(this.translations[this.editedIndex], this.editedItem)
            // } else {
            //     this.translations.push(this.editedItem)
            // }
            this.saveTranslation(this.editedItem, this.editedIndex)
            this.close()
        },

        filterText(value, search, item) {
            return value != null &&
                search != null &&
                typeof value === 'string' &&
                value.toString().indexOf(search) !== -1
        },
    },
}
</script>
