export default [
    {
        path: '/',
        name: 'Home',
        component: () => import('../views/test1.vue')
    },
    {
        path: '/about',
        name: 'About',
        component: () => import('../views/test2.vue')
    },
    {
        path: '/products',
        name: 'Products',
        component: () => import('../views/products.vue')
    }
]
