import Vue from "vue";
import vSelect from "vue-select";


require('./bootstrap');

window.Vue = require('vue');

Vue.component("v-select", vSelect);

Vue.component('driver-index', require('./components/driver/index.vue').default);
Vue.component('vehicle-index', require('./components/vehicle/index.vue').default);
Vue.component('admin-index', require('./components/admin/roles/index.vue').default);
Vue.component('personal-information', require('./components/user/personal_information/index.vue').default);




const app = new Vue({
    el: '#app',
});
