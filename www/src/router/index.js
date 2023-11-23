import { createRouter, createWebHistory } from 'vue-router'
import taskRouter from "./task.router";
import HomeView from '../views/HomeView.vue'
import TasksView from "@/views/TasksView.vue";

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: TasksView
    },
    {
      path: '/about',
      name: 'about',
      component: () => import('../views/AboutView.vue')
    },
    ...taskRouter
  ]
})


export default router
