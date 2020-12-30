import AlleBausteine from './components/AlleBausteine.vue';
import SummerNote from './components/SummerNote.vue';
import BausteinEdit from './components/BausteinEdit.vue';
import BausteinShow from './components/BausteinShow.vue';

export default{
    mode: 'history',
    linkActiveClass: 'font-weight-bold',
    routes: [
        {
            path: '/bausteins',
            name: 'AlleBausteine',
            component: AlleBausteine
        },
        {
            path: '/bausteins/:id',
            name: 'BausteinShow',
            component: BausteinShow
        },
        {
            path: '/bausteins/:id/edit',
            name: 'BausteinEdit',
            component: BausteinEdit
        },
        {
            path: '/bausteins/summernote',
            component: SummerNote
        }
    ]
}