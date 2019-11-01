/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('intersection-observer');
require('es6-promise').polyfill();
require('./polyfill');

import Vue from 'vue';
import iView from 'iview';
import moment from 'moment';

moment.locale('de');
Vue.use(iView);

require('./bootstrap');


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

//const files = require.context('./', true, /\.vue$/i);
//files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

window.Bus = new Vue();

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

new Vue({
    el: '#root',
    components: {
        HeaderApp: () => import('./components/HeaderApp'),
        FooterApp: () => import('./components/FooterApp'),
        CalendarPlugin: () => import('./components/CalendarPlugin'),
        UiCollapse: () => import('./components/Ui/UiCollapse'),
        UiDropdown: () => import('./components/Ui/UiDropdown'),
        ThemeOverview: () => import('./components/Theme/ThemeOverview'),
        ThemeSort: () => import('./components/Theme/ThemeSort'),
        ThemeComponentLazy: () => import('./components/Theme/ThemeComponentLazy'),
        MapDesktopApp: () => import('./components/Map/MapDesktopApp'),
        MeetingList: () => import('./components/Meeting/MeetingList'),
        MeetingDetailPage: () => import('./components/Meeting/MeetingDetailPage'),
        CommitteeTable: () => import('./components/Committee/CommitteeTable'),
        CommitteeDetailPage: () => import('./components/Committee/CommitteeDetailPage'),
        PeopleTable: () => import('./components/People/PeopleTable'),
        PeopleDetailPage: () => import('./components/People/PeopleDetailPage'),
    },
    data: () => ({
        navActive: false
    }),
    methods: {
        navActiveMethod(event) {
            this.navActive = event;
        }
    },
});
