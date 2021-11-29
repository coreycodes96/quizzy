require('./bootstrap');

import Vue from 'vue';

export const bus = new Vue();

import store from './store/index';

//Headers
Vue.component('guest-header', require('./components/Headers/GuestHeaderComponent.vue').default);
Vue.component('user-header', require('./components/Headers/UserHeaderComponent.vue').default);
Vue.component('admin-header', require('./components/Headers/AdminHeaderComponent.vue').default);

//Account
Vue.component('create-an-account', require('./components/CreateAnAccount/CreateAnAccountComponent.vue').default);
Vue.component('login', require('./components/Login/LoginComponent.vue').default);

//FAQ
Vue.component('faq', require('./components/FAQ/FAQComponent.vue').default);

//Announcement
Vue.component('announcements', require('./components/Announcements/AnnouncementsComponent.vue').default);

//Quiz
Vue.component('quiz-view', require('./components/Quiz/QuizViewComponent.vue').default);

//Profile
Vue.component('profile-view', require('./components/Profile/ProfileViewComponent.vue').default);

//Admin
Vue.component('admin-view', require('./components/Admin/AdminViewComponent.vue').default);

const app = new Vue({
    el: '#app',
    store
});
