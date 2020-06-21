import Venue from '../components/Venue.vue';
import Main from '../components/Main.vue';

//importing dashboard settings...
import Settings from '../components/DashboardNav.vue';
import DStats from '../components/DashboardStats.vue';
import DBase from '../components/DashboardDatabase.vue';
import DBSetting from '../components/Database.vue';

//Notfound import
import Notfound from '../components/others/Notfound.vue'

//Auth views imports
import Login from '../components/auth/login.vue'

export const routes = [

    //Main route
    {
        path: '/',
        component: Main
    },

    {
        //Dashboard panel edit, delete etc...
        path: '/dashboard',
        component: Settings,
        children: [{
                path: 'stats',
                component: DStats
            },

            {
                path: 'database',
                component: DBase
            },

            {
                path: 'database/edit/:v_id',
                component: DBSetting
            }
        ]
    },


    //single venue view
    {
        path: '/venue/:id',
        component: Venue
    },




    //Notfound routes
    {
        path: '*',
        component: Notfound
    },





    //Auth routes
    //for now untill proper authentication implemented(placeholder)
    {
        path: '/login',
        component: Login
    }
];
