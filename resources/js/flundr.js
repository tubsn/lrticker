let FlundrDialog = require('./components/flundr/flDialog.vue').default;
let FlundrMenu = require('./components/flundr/flMenu.vue').default;
let FlundrMenuItem = require('./components/flundr/flMenuItem.vue').default;

// Flundr Vue Instance
let FlundrApp = new Vue({

	el: '.flundrApp',
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