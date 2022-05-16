import Vue from 'vue'
import VueRouter from 'vue-router'
import HomeView from '../views/HomeView.vue'
import SignInView from '../views/SignInView.vue'
import SignUpView from '../views/SignUpView.vue'
import WordsView from '../views/WordsView.vue'
import StatisticsView from '../views/StatisticsView.vue'
import QuizView from '../views/QuizView.vue'
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
    path: '/statistics',
    name: 'statistics',
    component: StatisticsView
  },
  {
    path: '/quiz',
    name: 'quiz',
    component: QuizView
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  const userStore = useUserStore()
  if (userStore.isAuthenticated || to.name === 'signin' || to.name === 'signup') {
    next();
  } else {
    next('/signin');
  }
})

export default router
