import Vue from 'vue';
import VueRouter from 'vue-router';
import AlleDokumentationen from './components/Dokumentation/AlleDokumentationen.vue';
import DokumentationEdit from './components/Dokumentation/DokumentationEdit.vue';
import DokumentationCreate from './components/Dokumentation/DokumentationCreate.vue';

Vue.use(VueRouter);

const routerDok = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    linkActiveClass: 'font-weight-bold',
    routes: [
        {
            path: '/dokumentations',
            name: 'AlleDokumentationen',
            component: AlleDokumentationen
        },
        {
            path: '/dokumentations/:id/edit',
            name: 'DokumentationEdit',
            component: DokumentationEdit
        },
        {
            path: '/dokumentations/create',
            name: 'DokumentationCreate',
            component: DokumentationCreate
        },
    ]
});

export default routerDok;