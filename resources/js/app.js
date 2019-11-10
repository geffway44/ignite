require('./bootstrap');
window.fuse = require('fuse.js');
window.Vue = require('vue');

import hljs from 'highlight.js/lib/highlight';

// Syntax highlighting
hljs.registerLanguage('bash', require('highlight.js/lib/languages/bash'));
hljs.registerLanguage('css', require('highlight.js/lib/languages/css'));
hljs.registerLanguage('html', require('highlight.js/lib/languages/xml'));
hljs.registerLanguage('javascript', require('highlight.js/lib/languages/javascript'));
hljs.registerLanguage('json', require('highlight.js/lib/languages/json'));
hljs.registerLanguage('markdown', require('highlight.js/lib/languages/markdown'));
hljs.registerLanguage('php', require('highlight.js/lib/languages/php'));
hljs.registerLanguage('scss', require('highlight.js/lib/languages/scss'));
hljs.registerLanguage('yaml', require('highlight.js/lib/languages/yaml'));

document.querySelectorAll('pre code').forEach((block) => {
    hljs.highlightBlock(block);
});

Vue.prototype.authorize = function (handler) {
    let user = window.App.user;

    return user ? handler(user) : false;
};

window.events = new Vue();

window.flash = function (message, level = 'success') {
    window.events.$emit('flash', message, level);
};

Vue.config.productionTip = false;

Vue.component('flash', require('./components/Flash.vue').default);
Vue.component('paginator', require('./components/Paginator.vue').default);
Vue.component('subscribe', require('./components/Subscribe.vue').default);
Vue.component('thread', require('./pages/Thread.vue').default);
Vue.component('notifications', require('./components/Notifications.vue').default);
Vue.component('avatar', require('./components/Avatar.vue').default);

const app = new Vue({
    el: '#app',
});
