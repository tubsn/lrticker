<template>
<div :class="['post-layout' , isDragged ? 'is-dragged' :'', isDragTarget ? 'is-target' :'']" v-if="isVisible"
	@drop="drop" @dragover="dragover" @dragenter="dragenter" @dragleave="dragleave" :id="post.id">

	<div class="post-content">
		<div class="post-media" v-if="mediaGallery">
			<ticker-gallery :images="mediaGallery"></ticker-gallery>
		</div>
		<div class="post-media" v-else-if="post.media" v-html="post.media"></div>
		<div class="post-editor" @mouseenter.once="initTiny" @blur="savePost" v-html="post.content"></div>
	</div>

	<aside class="post-time"><span contenteditable="true" @click="makeEditable" @blur="saveTime">{{post.time}}</span>{{this.timeunit}}</aside>
	<aside class="post-date">Datum: <span @click="makeEditable" @blur="saveDate">{{post.date}}</span></aside>
	<aside class="post-autor">Autor: <span>{{post.author.username}}</span></aside>
	<aside class="post-move" draggable="true" @dragstart="dragstart" @dragend="dragend">::</aside>
	<aside class="post-delete" v-on:click="deletePost"></aside>
</div>
</template>



<script>
let TickerGallery = require('./TickerGallery.vue').default;

export default {

	components: {
		'ticker-gallery': TickerGallery,
	},

	props: ['post'],
	data: function () {
		return {
			isVisible: true,
			isDragged: false,
			isDragTarget: false,
		}
	},

	computed: {
		tickerID: function() {return this.$parent.tickerID;},
		postList: function() {return this.$parent.postList;},
		timeunit: function() {
			if (this.post.time.indexOf(':')>=0) {
				return ' Uhr';
			}
			else {
				return ' Min';
			}
		},
		isImage: function() {
			if (this.post.type == 'image') {
				return true
			}
			else {return false}
		},

		mediaGallery: function() {

			// Broken :/ elements.isArray is always false -> no flickity Gallery

			if (!this.post.media) {return null}

			let elements = this.stringToTemplate(this.post.media);

			// Check if Media Elements are in Slider Div
			if ((elements.isArray) && elements[0].classList.contains('ticker-slider')) {
				return elements[0].children;
			}

			else {return null;}

		}
	},

	methods: {

		dragstart: function (event) {
			this.isDragged = true;
			event.dataTransfer.setData("PostID", this.post.id);
			event.dataTransfer.effectAllowed = "move";
			event.dataTransfer.setDragImage(event.target.parentElement, -10, -10);
		},

		dragend: function (event) {
			event.preventDefault();
			this.isDragged = false;
		},

		dragover: function (event) {
			event.preventDefault();
		},

		dragenter: function (event) {
			if (event.dataTransfer.getData('PostID')) {
				this.isDragTarget = true;
			}
		},

		dragleave: function (event) {
			if (event.dataTransfer.getData('PostID')) {
				this.isDragTarget = false;
			}
		},

		drop: function (event) {
			event.preventDefault();
			this.isDragTarget = false;
			let draggedElementID = parseInt(event.dataTransfer.getData('PostID'));

			if (!draggedElementID || draggedElementID == this.post.id) {
				return false; // Element dragged onto itself
			}

			let draggedElementKey = this.postList.indexOf(draggedElementID);
			let targetKey = this.postList.indexOf(this.post.id);

			if (draggedElementKey > -1) {
				this.postList.splice(draggedElementKey, 1);
			}

			if (targetKey > -1) {
				this.postList.splice(targetKey, 0, draggedElementID);
			}

			console.log(`Dragging: ${draggedElementID} to ${this.post.id}`);
			this.reorderTicker();
		},

		stringToTemplate: function(htmlString) {
			let template = document.createElement('template');
			template.innerHTML = htmlString;
			return template.content.childNodes;
		},

		initTiny: function(event) {
			let element = event.currentTarget;
			let tinyConfig = window.globalTinyConfig;
			tinyConfig.target = element; // Extending Config with TinyMCE Target
			tinymce.init(tinyConfig);
		},

		makeEditable: function(event) {
			const element = event.currentTarget;
			element.contentEditable = true;
			element.classList.add('edit');
		},

		savePost: async function(event) {
			const element = event.currentTarget;
			const response = await axios.patch('/post/'+this.post.id, {'content': element.innerHTML});
		},

		saveTime: async function(event) {
			const element = event.currentTarget;
			const response = await axios.patch('/post/'+this.post.id, {'time': element.innerText});
			element.contentEditable = false;
			element.classList.remove('edit');
			this.$parent.refresh();
		},

		saveDate: async function(event) {
			const element = event.currentTarget;
			element.contentEditable = false;
			element.classList.remove('edit');

			if (element.innerText != '') {
				const response = await axios.patch('/post/'+this.post.id, {'date': element.innerText});
				element.contentEditable = false;
				this.$parent.refresh();
			}
			else {
				element.innerText= 'error';
			}


		},

		reorderTicker: async function() {
			const response = await axios.patch('/ticker/'+this.tickerID+'/reorder', {'post_ids': this.postList.join(',')});

			if (response.data.success) {
				console.log(response.data.message);
				this.$parent.refresh();
			}
		},

		deletePost: async function (post) {
			const response = await axios.delete('/post/'+this.post.id);
			console.log(response.data);
			if (response.data.success) {
				//this.isVisible = false;
				this.$parent.refresh();
			}
		},

	}
}
</script>

<style>
.post-layout.is-dragged {opacity:.3; background:#fff1cf;}
.post-layout.is-target {opacity:.8; background:#fff1cf;}
.post-layout.is-target > * {pointer-events: none !important;}
</style>