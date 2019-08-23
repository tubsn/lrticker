/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');



/*
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
const app = new Vue({
    el: '#app',
});
*/


//Document Ready
document.addEventListener("DOMContentLoaded", function() {




const livetickerAPP = new Vue({
el: '#liveticker',
data: {
	tickerID: '',
	posts: '',
	newPost: '',
	tinyConfig: tinyMCEConfig,

},

components: {
	'editor': Editor,
	'ticker-list': TickerList,
	'file-upload': FileUploadButton,
},

mounted: function () {
	this.tickerID = this.$el.getAttribute('data-tickerID');
},

methods: {
	submitPost: async function() {
		try {
			const response = await axios.post('/post', {'content': this.newPost, 'ticker_id': this.tickerID});

			console.log(response);
			if (response.data.success) {
				this.$refs.ticker.refresh();
				this.newPost = '';
				this.$refs.newPost.$el.focus();
			}

		} catch (error) {
			console.error(error);
		}

	},

	createImagePost: function(attachments) {

		let images;

		attachments.forEach(attachment => {
			images = images + `<img src="/storage/uploads/${attachment.url}">`;
		});



		this.newPost = images;




	},


}

}) // End Vue




}); // End Document Rdy

