import Vue from 'vue';
import VueRouter from 'vue-router';
import AlleDokumente from '../components/Dokument/AlleDokumente.vue';
import DokumentEdit from '../components/Dokument/DokumentEdit.vue';
import DokumentCreate from '../components/Dokument/DokumentCreate.vue';
import NotFound from '../components/Dokument/NotFound.vue';
import NProgress from 'nprogress';

Vue.use(VueRouter);

const routerDok = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    linkActiveClass: 'font-weight-bold',
    routes: [
        {
            path: '/dokuments',
            name: 'AlleDokumente',
            component: AlleDokumente
        },
        {
            path: '/dokuments/:id/edit',
            name: 'DokumentEdit',
            component: DokumentEdit
        },
        {
            path: '/dokuments/create',
            name: 'DokumentCreate',
            component: DokumentCreate
        },
        {
            path: '/404',
            name: '404',
            component: NotFound,
        },
        {
            path: '/dokuments/*',
            redirect: '404'
        }
    ]
});

routerDok.beforeEach((to, from, next) => {
    NProgress.start();
    next();
});

routerDok.afterEach(() => {
    NProgress.done();
});

export default routerDok;