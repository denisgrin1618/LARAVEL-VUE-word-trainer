import { defineStore } from 'pinia'

export const useLanguageStore = defineStore('LanguageStore', {
  state: () => {
    return {     
      languages: []      
    }
  },
  actions: {
  },
})