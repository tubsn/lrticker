/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');
require('./flundr');

// Vue Components
let TickerEditor = require('./components/TickerEditor.vue').default;
let TickerList = require('./components/TickerList.vue').default;


// Liveticker Vue Instance
let livetickerAPP = new Vue({

	el: '#liveticker',
	data: {},

	components: {
		'ticker-editor': TickerEditor,
		'ticker-list': TickerList,
	},

	beforeMount: function () {
		this.tickerID = this.$el.getAttribute('data-tickerID');
	},

	methods: {
		refresh_list : async function () {
			await this.$refs.list.refresh();
		},
	}

}) // End Liveticker Vue

