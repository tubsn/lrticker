let FlundrDialog = require('./components/flundr/flDialog.vue').default;

// Flundr Vue Instance
let FlundrApp = new Vue({

	el: '.flundrApp',
	data: {},

	components: {
		'fl-dialog': FlundrDialog,
	},

	mounted: function () {
	},

	methods: {
	}

}) // End Flundr