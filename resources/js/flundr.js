window._ = require('lodash');

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

// Vue Instance
window.Vue = require('vue');


let FlundrDialog = require('./components/flundr/flDialog.vue').default;
let FlundrMenu = require('./components/flundr/flMenu.vue').default;
let FlundrMenuItem = require('./components/flundr/flMenuItem.vue').default;

// Flundr Vue Instance
let FlundrApp = new Vue({

	el: '#App',
	data: {},

	components: {
		'fl-dialog': FlundrDialog,
		'fl-menu': FlundrMenu,
		'menu-item': FlundrMenuItem
	},

	mounted: function () {
	},

	methods: {
	}

}) // End Flundr