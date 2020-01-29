require('./bootstrap');

// Flundr Components
let FlundrDialog = require('./components/flundr/flDialog.vue').default;
let FlundrMenu = require('./components/flundr/flMenu.vue').default;
let FlundrModal = require('./components/flundr/flModal.vue').default;
let FlundrMenuItem = require('./components/flundr/flMenuItem.vue').default;
let FlundrFileUpload = require('./components/flundr/flFileUpload.vue').default;


// Ticker Components
let TickerApp = require('./components/TickerApp.vue').default;

// Main Vue Instance
let livetickerAPP = new Vue({
	el: '#App',
	components: {
		'ticker-app': TickerApp,
		'fl-dialog': FlundrDialog,
		'fl-upload': FlundrFileUpload,
		'fl-modal': FlundrModal,
		'fl-menu': FlundrMenu,
		'menu-item': FlundrMenuItem
	},
}) // End Main Vue

