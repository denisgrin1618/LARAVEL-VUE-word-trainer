import Vue from 'vue'
import VueRouter from 'vue-router'
import HomePage from '../pages/HomePage.vue'
import SignInPage from '../pages/SignInPage.vue'
import SignUpPage from '../pages/SignUpPage.vue'
import WordsPage from '../pages/WordsPage.vue'
import StatisticsPage from '../pages/StatisticsPage.vue'
import QuizPage from '../pages/QuizPage.vue'
import { useUserStore } from "../store/user";

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomePage
  },
  {
    path: '/signin',
    name: 'signin',
    component: SignInPage
  },
  {
    path: '/signup',
    name: 'signup',
    component: SignUpPage
  },
  {
    path: '/words',
    name: 'words',
    component: WordsPage
  },
  {
    path: '/statistics',
    name: 'statistics',
    component: StatisticsPage
  },
  {
    path: '/quiz',
    name: 'quiz',
    component: QuizPage
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
