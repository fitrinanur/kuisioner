
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');


// Import vue Router
import VueRouter from 'vue-router'
Vue.use(VueRouter)
window.routes = VueRouter;


// Import vue form
Vue.component('pagination', require('laravel-vue-pagination'));

// Import vue form
import { Form, HasError, AlertError } from 'vform';
window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

// Import vue form
import moment from 'moment';



// vue prgressbar
// vue prgressbar
import VueProgressBar from 'vue-progressbar';
Vue.use(VueProgressBar, {
  color: 'green',
  failedColor: 'red',
  height: '10px'
})


// Vue sweet alert
import Swal from 'sweetalert2';
window.Swal = Swal;
const toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});
window.toast = toast;

// Vue Fire
window.Fire =  new Vue();



Vue.filter('truncate', function (text, length, suffix) {
    if (text.length > length) {
        return text.substring(0, length) + suffix;
    } else {
        return text;
    }
});


// Import vue select search
// Vue.component('v-select', vSelect)
import VueSingleSelect from "vue-single-select";
Vue.component('vue-single-select', VueSingleSelect);

/**
 * 
 *All vue template assign in varable
 * 
 */
const routes = [
  { path: '/home', component: require('./components/Home.vue').default },

  //user route
  { path: '/users', component: require('./components/users/Index.vue').default },
  { path: '/user/create', component: require('./components/users/Create.vue').default },
  { path: '/user/edit/:slug', component: require('./components/users/Edit.vue').default },
  { path: '/profile', component: require('./components/users/Profile.vue').default },
  //question route
  { path: '/questions', component: require('./components/question/Index.vue').default },
  { path: '/question/create', component: require('./components/question/Create.vue').default },
  { path: '/question/edit/:id', component: require('./components/question/Edit.vue').default },
  //question indicator route
  { path: '/question-indicators', component: require('./components/questionIndicator/Index.vue').default },
  { path: '/question-indicators/create', component: require('./components/questionIndicator/Create.vue').default },
  { path: '/question-indicators/edit/:id', component: require('./components/questionIndicator/Edit.vue').default },

  //option route
  { path: '/options', component: require('./components/option/Index.vue').default },
  { path: '/options/create', component: require('./components/option/Create.vue').default },
  { path: '/option/edit/:id', component: require('./components/option/Edit.vue').default },
  //Icon route
  { path: '/icon', component: require('./components/icon/Index.vue').default },
  { path: '/icon/create', component: require('./components/icon/Create.vue').default },
  { path: '/icon/edit/:id', component: require('./components/icon/Edit.vue').default },
  //suggestions route
  { path: '/result', component: require('./components/suggestion/Index.vue').default },
  { path: '/result/create', component: require('./components/suggestion/Create.vue').default },
  { path: '/result/edit/:id', component: require('./components/suggestion/Edit.vue').default },
 
  //result map route
  { path: '/result-map', component: require('./components/result-map/Index.vue').default },
  { path: '/create-option-suggestion', component: require('./components/result-map/Create.vue').default },
  { path: '/edit-option-suggestion/:id', component: require('./components/result-map/Edit.vue').default },
  //suggestions rule
  { path: '/event', component: require('./components/event/Index.vue').default },
  { path: '/event/create', component: require('./components/event/Create.vue').default },
  { path: '/event/edit/:id', component: require('./components/event/Edit.vue').default },
  //subscriber 
  { path: '/subscriber', component: require('./components/subscriber/Index.vue').default },
  { path: '/subscriber-exports', component: require('./components/subscriber/Index.vue').default },
  //settings 
  { path: '/settings', component: require('./components/settings/Index.vue').default },
  
  // 404 vue
  { path: '*', component: require('./components/404.vue').default },
]
const router = new VueRouter({
	mode: "history",
    routes // short for `routes: routes`
})


Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
/**
* Filter / Capitalize
*/
Vue.filter('capitalize', function (text) {
  return text.charAt(0).toUpperCase() + text.slice(1);
})


Vue.filter('dateFormat', function (creted) {
  return moment(creted).format('MMMM Do YYYY');
})


Vue.filter('month', function () {
  return moment.month();
})


Vue.filter('truncate', function (text, length, suffix) {
    if (text.length > length) {
        return text.substring(0, length) + suffix;
    } else {
        return text;
    }
});




// language translation
import VueInternationalization from 'vue-i18n';
import Locale from './vue-i18n-locales.generated';

Vue.use(VueInternationalization);

const lang = document.documentElement.lang.substr(0, 2);
// or however you determine your current app locale

const i18n = new VueInternationalization({
    locale: lang,
    messages: Locale
});




const app = new Vue({
    el: '#app',
    i18n,
    router
});
