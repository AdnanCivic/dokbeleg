import AlleBausteine from './components/AlleBausteine.vue';
import SummerNote from './components/SummerNote.vue';

export default{
    mode: 'history',
    linkActiveClass: 'font-weight-bold',
    routes: [
        {
            path: '/bausteins',
            component: AlleBausteine
        },
        {
            path: '/bausteins/summernote',
            component: SummerNote
        }
    ]
}