import { defineStore } from 'pinia'
import { useUserStore } from "./user";

export const useTranslationStore = defineStore('TranslationStore', {
  state: () => {
    return {     
      translations: []
    }
  },

  actions: {

    getTranslations() {

      const auth = useUserStore()
      if (!auth.isAuthenticated) {
        throw new Error('User must be authenticated')
      }

      if (this.translations.length == 0) {
        axios.get('/api/v1/translations')
          .then((response) => {
              this.translations = response.data.data
          })
          .catch(function (error) {
              console.log(error);
          });
      }
      
    },

    saveTranslation(item, editedIndex) {
      let requestOne = axios({
          method: item.word_origin.id > 0 ? 'put' : 'post',
          url: '/api/v1/words' + (item.word_origin.id > 0 ? '/' + item.word_origin.id : ''),
          data: {
              name: item.word_origin.name,
              language_id: item.word_origin.language.id,
          }
      })

      let requestTwo = axios({
          method: item.word_translation.id > 0 ? 'put' : 'post',
          url: '/api/v1/words' + (item.word_translation.id > 0 ? '/' + item.word_translation.id : ''),
          data: {
              name: item.word_translation.name,
              language_id: item.word_translation.language.id,
          }
      })

      axios.all([requestOne, requestTwo])
          .then(axios.spread((...responses) => {
              item.word_origin = responses[0].data.data
              item.word_translation = responses[1].data.data

              if (editedIndex > -1) {
                  Object.assign(this.translations[editedIndex], item)
              } else if (item.id == 0) {
                  axios.post(`/api/v1/translations`, {
                          word_origin_id: item.word_origin.id,
                          word_translation_id: item.word_translation.id,
                      })
                      .then(response => {
                          item = response.data.data
                          this.translations.push(item)
                      })
              }

          })).catch(errors => {
              console.log(errors);
          })
    },
  },
})