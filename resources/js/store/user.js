import { defineStore } from 'pinia'

export const useUserStore = defineStore('UserStore', {
  state: () => {
    return {     
      isAuthenticated: false,
      user: {
        name: '',
        token: ''
      }
      
    }
  },
  // could also be defined as
  // state: () => ({ count: 0 })
  actions: {
    increment() {
      
    },
  },
})