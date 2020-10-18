import Vue from 'vue';
import VueRouter from 'vue-router';

import Movies from '../components/API/Movies.vue'
import Create from '../components/API/Create.vue'
import Edit from '../components/API/Edit.vue'
Vue.use(VueRouter);


const routes = [
    {
        path: '/',
        name:'movies',
        component: Movies
    },
    {
        path: '/create',
        name:'create',
        component: Create
    },
    {
        path: '/edit',
        name:'edit',
        component: Edit
    },

    // {
    //     path: '*',
    //     name:'page404',
    //     component: AdminStart
    // },
];

const router = new VueRouter({
    routes,
    mode: 'history',
});

export default router;