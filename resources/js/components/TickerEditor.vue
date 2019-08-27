<template>
<section class="ticker-editor">
<h2 class="ticker-headline"><slot></slot></h2>


<form>
	<!--<textarea class="ticker-textarea" name="content" autofocus placeholder="Neue Nachricht"></textarea>-->
	<editor class="ticker-textarea" v-model="newPostContent" :init="tinyConfig" @onInit="focusIT" ref="contentEditor"></editor>

	<aside v-if ="newPostMedia" class="media-block">
		<p>Anhänge:</p>
		<div class="media-holder" v-html="newPostMedia"></div>
	</aside>

	<aside class="ticker-indicator"><div class="ticker-live-circle active"></div>Live</aside>


	<button type="button" @click="submitPost"><span class="hide-mobile">Nachricht </span>senden</button>
	<file-upload class="minor" action="/attachment" method="post" @fileuploaded="add_images_to_media">Bilder</file-upload>
	<dialog-button @submit="add_youtube_video" class="minor">Youtube</dialog-button>
	<button class="minor">HTML</button>
	<img class="ball" src="/styles/img/ticker-icons/soccer.png">
</form>


</section>
</template>

<script>

	let Editor = require('@tinymce/tinymce-vue').default;
	let FileUploadButton = require('./FileUploadButton.vue').default;
	let DialogButton = require('./DialogButton.vue').default;

	export default {

		components: {
			'editor': Editor,
			'file-upload': FileUploadButton,
			'dialog-button': DialogButton,
		},

		data: function () {
			return {
				newPostContent: '',
				newPostMedia: '',
			}
		},

		computed: {
			tickerID : function () {
				return this.$parent.tickerID;
			},
			tinyConfig: function () {
				return window.globalTinyConfig;
			},

		},

		mounted: function () {

		},


		methods: {

			focusIT: function(event) {
				event.target.focus();
			},


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
					'media': this.newPostMedia,
					'content': this.newPostContent,
					'ticker_id': this.tickerID
				}

				if (await this.savePost(data)) {
					this.$emit('submitted');
					this.newPostContent = '';
					this.newPostMedia = '';
					this.$refs.contentEditor.$el.focus();
				}

			},

			postImage: async function(attachments) {

				let attachment = attachments[0];

					let data = {
						'media': `<img src="/storage/uploads/${attachment.url}">`,
						'content': '',
						'ticker_id': this.tickerID
					}

					await this.savePost(data);


				this.$refs.ticker.refresh();
				this.$refs.contentEditor.$el.focus();

			},


			add_images_to_media: function(attachments) {

				let images = '';

				attachments.forEach(attachment => {
					images = images + `<img src="/storage/uploads/${attachment.url}">`;
				});

				this.newPostMedia = images;

			},


			add_youtube_video: function(embed) {

				function youtube_parser(url){
					// props to Lasnv - https://stackoverflow.com/questions/3452546
    				let regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    				let match = url.match(regExp);
    				return (match&&match[7].length==11)? match[7] : false;
				};

				let videoID = youtube_parser(embed);

				if (!videoID) {
					return false;
				}

				let embedCode = `<div class="media-container"><iframe src="https://www.youtube.com/embed/${videoID}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>`;

				this.newPostMedia = embedCode;

			},


		},

	}
</script>
