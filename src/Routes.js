import { createRouter, createWebHistory } from 'vue-router';
import HomeView from './views/HomeView.vue'
import AboutView from './views/AboutView.vue'
import EditView from './views/EditView.vue';


const routes = [
  {
    path: '/',
    name: 'Home',
    component: HomeView
  },

  {
    path: '/about',
    name: 'About',
    component: AboutView
  },
  {
    path: '/contact/edit/:id?',
    name: 'Edit',
    component: EditView
  },

];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
