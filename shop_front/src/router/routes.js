export default [
    {
        path: '/',
        name: 'Home',
        component: () => import('../views/homepage.vue')
    },
    {
        path: '/products',
        name: 'Products',
        component: () => import('../views/product/list.vue')
    },
]
