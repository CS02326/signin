import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
// import signin from '../views/signin.vue'
// import register from "../views/register.vue";
import xyxw from "../views/xyxw.vue";
// import news from '../views/news-btn.vue'
// import store from "../views/store.vue";
const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    // {
    //   path: '/',
    //   name: 'home',
    //   component: HomeView,
    // },
    // {
    //   path: '/publish-news',
    //   name: 'publish-news-btn',
    //   component: news,
    // },
    {
      path: '/',
      name: 'xyxw',
      component: xyxw,
    },
    // {
    //   path: '/store',
    //   name: 'store',
    //   component: store,
    // },
    // {
    //   path: '/xyxw',
    //   name: 'xyxw',
    //   component: xyxw,
    // },
    // {
    //   path: '/register',
    //   name: 'register',
    //   component: register,
    // },
    {
      path: '/about',
      name: 'about',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/AboutView.vue'),
    },
  ],
})

export default router
