require('./bootstrap');

// windowに対してvueを作成
windows.vue = require('vue');

// Vueに対して 何を使用するか登録する
Vue.component('sample-component', require('./components/Sample.vue').default);

// Vue利用の常套句
const app = new Vue({
    // elementに使用したいid属性を定義
    el: '#app',
});
