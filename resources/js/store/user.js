import { defineStore } from 'pinia'

export const useUserStore = defineStore('UserStore', {
  state: () => {
    return {     
      isAuthenticated: false,
      user: {
        id: 0,
        name: '',
        token: ''
      }
      
    }
  },

  actions: {  
    logout() {
      this.isAuthenticated = false;
      this.user.name = '';
      this.user.token = '';
      this.user.id = 0;
    },
    
    signIn(email, password) {
      axios.post('/api/login', {
          email: email,
          password: password
        })
        .then((response) => {
          this.user.token = response.data.data.token
          this.user.name = response.data.data.name
          this.user.id = response.data.data.id
          this.isAuthenticated = true
        })
        .catch(function (error) {
          console.log(error);
        });
    },

    signUp(name, email, password, password_confirmation) {
      axios.post('/api/register', {
          name: name,
          email: email,
          password: password,
          password_confirmation: password_confirmation
        })
        .then((response) => {
          this.user.token = response.data.data.token;
          this.user.name = response.data.data.name;
          this.user.id = response.data.data.id
          this.isAuthenticated = true;
        })
        .catch(function (error) {
          console.log(error);
        });
    }
  },
})