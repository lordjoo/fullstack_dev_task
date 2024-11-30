import {createRouter, createWebHistory} from 'vue-router'

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'home',
            component: () => import('../views/Home.vue'),
        },
        {
            path: '/category/:id/courses',
            name: 'category',
            component: () => import('../views/Category.vue'),
        },
        {
            path: '/course/:id',
            name: 'course',
            component: () => import('../views/Course.vue'),
        }
    ],
})

export default router
