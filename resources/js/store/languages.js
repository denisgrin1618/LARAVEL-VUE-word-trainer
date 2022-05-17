import { defineStore } from 'pinia'
import { useUserStore } from "./user";

export const useLanguageStore = defineStore('LanguageStore', {
  state: () => {
    return {     
      languages: []      
    }
  },
  actions: {
    getLanguages() {

      const auth = useUserStore()
      if (!auth.isAuthenticated) {
        throw new Error('User must be authenticated')
      }

      if (this.languages.length == 0) {
        axios.get('/api/v1/languages')
          .then((response) => {
              this.languages = response.data.data
          })
          .catch(function (error) {
              console.log(error);
          });
      }
      
    },
  },
})