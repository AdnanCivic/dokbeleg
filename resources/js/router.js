import Vue from 'vue';
import AlleBausteine from './components/AlleBausteine.vue';
import SummerNote from './components/SummerNote.vue';
import BausteinCreate from './components/BausteinCreate.vue';
import BausteinEdit from './components/BausteinEdit.vue';
import NotFound from './components/NotFound.vue';
import VueRouter from 'vue-router';
import NProgress from 'nprogress';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
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
            path: '/bausteins/summernote',
            component: SummerNote
        },
        {
            path: '/bausteins/*',
            component: NotFound
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