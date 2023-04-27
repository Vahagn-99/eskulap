import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'news',
            component: () => import('./AppLayout.vue'),
            children: [
                {
                    path: '/index',
                    name: 'news.index',
                    component: () => import('./pages/NewsIndex.vue'),
                },
                {
                    path: '/show/:id',
                    name: 'news.show',
                    component: () => import('./pages/NewsShow.vue'),
                },
            ]
        },
    ]
})

export default router;
