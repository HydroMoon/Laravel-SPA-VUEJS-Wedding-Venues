require('./bootstrap');
require("bootstrap-css-only/css/bootstrap.min.css");
require("mdbvue/lib/css/mdb.min.css");
require("@fortawesome/fontawesome-free/css/all.min.css");
//Main imports
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuex from 'vuex';
//routes
import {routes} from './routes/routes';
//importing Main app component
import MainApp from './components/MainComponent.vue';
//importing progressbar
import VueProgressBar from 'vue-progressbar';

//importing vue-toasted
import Toasted from 'vue-toasted';

//importing i18n localization
import VueI18n from 'vue-i18n'
import en from './locales/en.json'
import ar from './locales/ar.json'

//Vueprogress options
const options = {
    color: '#FF8800',
    failedColor: '#CC0000',
    thickness: '5px',
    transition: {
      speed: '0.7s',
      opacity: '1',
      termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
}

Vue.use(VueProgressBar, options);

Vue.use(Toasted, {
    iconPack : 'fontawesome'
});
Vue.use(VueRouter);
Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        appLanguage: localStorage.getItem("appLanguage") || process.env.VUE_APP_I18N_LOCALE
    },
    getters: {
        getAppLanguage: (state) => state.appLanguage
    },
    mutations: {
        setAppLanguage(state, language) {
            state.appLanguage = language;
            localStorage.setItem("appLanguage", language);
        }
    }
});

Vue.use(VueI18n);

const i18n = new VueI18n({
    locale: store.getters.getAppLanguage,
    fallbackLocale: process.env.VUE_APP_I18N_FALLBACK_LOCALE,
    messages: {
        ar,
        en
    }
});

const router = new VueRouter({
    routes,
    mode: 'history'
});



const app = new Vue({
    router,
    store,
    i18n,
    components: {
        MainApp
    }
}).$mount('#app');
