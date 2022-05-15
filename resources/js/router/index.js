import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'
import SignInView from '../views/SignInView.vue'
import SignUpView from '../views/SignUpView.vue'
import WordsView from '../views/WordsView.vue'
import { useUserStore } from "../store/user";

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: '/signin',
    name: 'signin',
    component: SignInView
  },
  {
    path: '/signup',
    name: 'signup',
    component: SignUpView
  },
  {
    path: '/words',
    name: 'words',
    component: WordsView
  },
  {
    path: '/about',
    name: 'about',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {

  const userStore = useUserStore()

  if (userStore.isAuthenticated || to.name === 'signin') {
    axios.defaults.headers.common['Authorization'] = `Bearer ${userStore.user.token}`;
    next();
  } else {
    axios.defaults.headers.common['Authorization'] = null;
    next('/signin');
  }
  
})

export default router
