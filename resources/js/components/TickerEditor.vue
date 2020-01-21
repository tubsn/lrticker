<template>
	<form>
		<!--<textarea class="ticker-textarea" name="content" autofocus placeholder="Neue Nachricht"></textarea>-->
		<editor class="ticker-textarea" v-model="newPostContent" :init="tinyConfig" @onInit="focusIT" ref="contentEditor"></editor>

		<aside v-if="mediaContainer" class="media-block">
			<p>Anhänge:</p>
			<div v-if="mediaLoading" class="loadIndicator"><div></div><div></div><div></div></div>
			<div class="media-holder" v-html="newPostMedia"></div>
		</aside>

		<aside v-if="active" class="hide-mobile ticker-indicator"><div class="ticker-live-circle active"></div>Live</aside>
		<aside v-else class="hide-mobile ticker-indicator"><div class="ticker-live-circle inactive"></div>Beendet</aside>

		<button type="button" @click="submitPost"><span class="hide-mobile">Nachricht </span>senden</button>
		<file-upload class="minor" action="/attachment" method="post" @fileloading="showLoadAnimation" @fileuploaded="add_images_to_media">Bilder</file-upload>
		<video-button @submit="add_youtube_video" class="minor">Youtube</video-button>
		<html-button @submit="add_html" class="minor">HTML</html-button>
		<div v-if="showTimer" class="gametime">Min: <input min="0" v-model="gameTime" type="number"></div>
	</form>
</template>

<script>

	let Editor = require('@tinymce/tinymce-vue').default;
	let FileUploadButton = require('./FileUploadButton.vue').default;
	let VideoButton = require('./TickerVideoButton.vue').default;
	let HTMLButton = require('./TickerHtmlButton.vue').default;

	export default {

		components: {
			'editor': Editor,
			'file-upload': FileUploadButton,
			'video-button': VideoButton,
			'html-button': HTMLButton,
		},

		data: function () {
			return {
				newPostContent: '',
				newPostMedia: '',
				mediaContainer: false,
				mediaLoading: false,
				gameTime: '0',
			}
		},

		computed: {
			tickerID : function () {
				return this.$parent.tickerID;
			},
			tinyConfig: function () {
				return window.globalTinyConfig;
			},

			active: function () {
				if (Boolean(Number(this.$parent.active))) {
					return true;
				}
				return false;
			},
			showTimer: function () {
				return this.$parent.showTimer;
			},

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

				if (this.newPostMedia == '' && this.newPostContent == '') {return;}

				let data = {
					'media': this.newPostMedia,
					'content': this.newPostContent,
					'ticker_id': this.tickerID,
					'time': this.gameTime
				}

				if (await this.savePost(data)) {
					this.$emit('submitted');
					this.newPostContent = '';
					this.newPostMedia = '';
					this.mediaContainer = false;
					this.$refs.contentEditor.$el.focus();
				}

			},

			postImage: async function(attachments) {

				let attachment = attachments[0];

					let data = {
						'media': `<img src="${location.origin}${attachment.url}">`,
						'content': '',
						'ticker_id': this.tickerID
					}

					await this.savePost(data);

				this.$refs.contentEditor.$el.focus();

			},

			showLoadAnimation: function() {
				this.mediaContainer = true;
				this.mediaLoading = true;
			},

			add_images_to_media: function(attachments) {

				let images = '';

				attachments.forEach(attachment => {
					images = images + `<img src="${location.origin}${attachment.url}">`;
				});

				if (attachments.length > 1) {
					images = '<div class="ticker-slider">' + images + '</div>';
				}

				this.mediaLoading = false;
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


			add_html: function(embed) {
				this.newPostMedia = embed;
			},


		},

	}
</script>
