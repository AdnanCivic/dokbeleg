import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from '../components/User/Home.vue';

import AlleBausteine from '../components/Baustein/AlleBausteine.vue';
import BausteinCreate from '../components/Baustein/BausteinCreate.vue';
import BausteinEdit from '../components/Baustein/BausteinEdit.vue';
import NotFound from '../components/Baustein/NotFound.vue';

import AlleGruppen from '../components/Gruppe/AlleGruppen.vue';
import GruppeEdit from '../components/Gruppe/GruppeEdit.vue';
import GruppeCreate from '../components/Gruppe/GruppeCreate.vue';

import AlleDokumente from '../components/Dokument/AlleDokumente.vue';
import DokumentEdit from '../components/Dokument/DokumentEdit.vue';
import DokumentCreate from '../components/Dokument/DokumentCreate.vue';

import NProgress from 'nprogress';

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    linkActiveClass: 'font-weight-bold',
    routes: [
        {
            path: '/',
            name: 'Home',
            component: Home
        },
        {
            path: '/bausteins',
            name: 'AlleBausteine',
            component: AlleBausteine
        },
        {
            path: '/gruppes',
            name: 'AlleGruppen',
            component: AlleGruppen
        },
        {
            path: '/dokuments',
            name: 'AlleDokumente',
            component: AlleDokumente
        },
        {
            path: '/bausteins/:id/edit',
            name: 'BausteinEdit',
            component: BausteinEdit
        },
        {
            path: '/gruppes/:id/edit',
            name: 'GruppeEdit',
            component: GruppeEdit
        },
        {
            path: '/dokuments/:id/edit',
            name: 'DokumentEdit',
            component: DokumentEdit
        },
        {
            path: '/bausteins/create',
            name: 'BausteinCreate',
            component: BausteinCreate
        },
        {
            path: '/gruppes/create',
            name: 'GruppeCreate',
            component: GruppeCreate
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
            path: '/bausteins/*',
            redirect: '404'
        },
        {
            path: '/gruppes/*',
            redirect: '/404'
        },
        {
            path: '/dokuments/*',
            redirect: '404'
        },
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