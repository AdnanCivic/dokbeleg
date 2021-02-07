import Vue from 'vue';
import VueRouter from 'vue-router';
import AlleGruppen from '../components/Gruppe/AlleGruppen.vue';
import GruppeEdit from '../components/Gruppe/GruppeEdit.vue';
import GruppeCreate from '../components/Gruppe/GruppeCreate.vue';

Vue.use(VueRouter);

const routerGru = new VueRouter({
    mode: 'history',
    base: process.env.BASE_URL,
    linkActiveClass: 'font-weight-bold',
    routes: [
        {
            path: '/gruppes',
            name: 'AlleGruppen',
            component: AlleGruppen
        },
        {
            path: '/gruppes/:id/edit',
            name: 'GruppeEdit',
            component: GruppeEdit
        },
        {
            path: '/gruppes/create',
            name: 'GruppeCreate',
            component: GruppeCreate
        },
    ]
});

export default routerGru;