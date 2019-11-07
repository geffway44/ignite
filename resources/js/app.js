require('./bootstrap');

window.Vue = require('vue');

Vue.prototype.authorize = function (handler) {
    let user = window.App.user;

    return user ? handler(user) : false;
};

window.events = new Vue();

window.flash = function (message, level = 'success') {
    window.events.$emit('flash', message, level);
};

Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('paginator', require('./components/Paginator.vue').default);
Vue.component('subscribe', require('./components/Subscribe.vue').default);
Vue.component('thread', require('./pages/Thread.vue').default);
Vue.component('notifications', require('./components/Notifications.vue').default);
Vue.component('avatar', require('./components/Avatar.vue').default);

const app = new Vue({
    el: '#app',
});
