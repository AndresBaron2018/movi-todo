import Vue from "vue";
import vSelect from "vue-select";
import { VueDatePicker } from '@mathieustan/vue-datepicker';
import '@mathieustan/vue-datepicker/dist/vue-datepicker.min.css';
// import Datepicker from 'vuejs-datepicker';


require('./bootstrap');

window.Vue = require('vue');


Vue.component('vue-date-picker', VueDatePicker);
Vue.component("v-select", vSelect);

Vue.component('driver-index', require('./components/driver/index.vue').default);
Vue.component('vehicle-index', require('./components/vehicle/index.vue').default);
Vue.component('admin-index', require('./components/admin/roles/index.vue').default);
Vue.component('personal-information', require('./components/user/personal_information/index.vue').default);
Vue.component('employee-liquidation', require('./components/driver/employeeLiquidation/index.vue').default);




const app = new Vue({
    el: '#app',
});
