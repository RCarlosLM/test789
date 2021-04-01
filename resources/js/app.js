
require('./bootstrap');

window.Vue = require('vue');

import Snotify, { SnotifyPosition } from 'vue-snotify'

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('verificado', require('./components/verificado/Verificado.vue').default);

const options = {
    toast: { position: SnotifyPosition.rightTop }
}

Vue.use(Snotify, options)

const app = new Vue({
    el: '#app',
});
