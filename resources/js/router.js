import Vue from 'vue';
import AlleBausteine from './components/Baustein/AlleBausteine.vue';
import BausteinCreate from './components/Baustein/BausteinCreate.vue';
import BausteinEdit from './components/Baustein/BausteinEdit.vue';
import NotFound from './components/Baustein/NotFound.vue';
import VueRouter from 'vue-router';
import NProgress from 'nprogress';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    linkActiveClass: 'font-weight-bold',
    routes: [
        {
            path: '/bausteins',
            name: 'AlleBausteine',
            component: AlleBausteine
        },
        {
            path: '/bausteins/:id/edit',
            name: 'BausteinEdit',
            component: BausteinEdit
        },
        {
            path: '/bausteins/create',
            name: 'BausteinCreate',
            component: BausteinCreate
        },
        {
            path: '/404',
            name: '404',
            component: NotFound,
        },
        {
            path: '/bausteins/*',
            redirect: '404'
        }
    ]
});

router.beforeEach((to, from, next) => {
    NProgress.start();
    next();
});

router.afterEach(() => {
    NProgress.done();
});

export default router;