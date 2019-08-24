/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');



const livetickerAPP = new Vue({
el: '#liveticker',
data: {
	tickerID: '',
	posts: '',
	newPostContent: '',
	newPostType: 'standard',
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

	savePost: async function(data) {

		try {
			const response = await axios.post('/post', data);
			if (response.data.success) {
				return true;
			}

		} catch (error) {
			console.error(error);
		}

	},

	submitPost: async function() {

		let data = {
			'type': 'standard',
			'content': this.newPostContent,
			'ticker_id': this.tickerID
		}

		if (await this.savePost(data)) {
			this.$refs.ticker.refresh();
			this.newPostContent = '';
			this.$refs.newPost.$el.focus();
		}

	},

	postImage: async function(attachments) {

		let attachment = attachments[0];

			let data = {
				'type': 'image',
				'content': `<img src="/storage/uploads/${attachment.url}">`,
				'ticker_id': this.tickerID
			}

			await this.savePost(data);


		this.$refs.ticker.refresh();
		this.$refs.newPost.$el.focus();

	},




	/*
	addImagesToPost: function(attachments) {

		let images;

		attachments.forEach(attachment => {
			images = images + `<img src="/storage/uploads/${attachment.url}">`;
		});

		this.newPostContent = images;

	},
	*/

}

}) // End Vue

