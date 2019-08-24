<template>
<div :class="['post-layout' , isDragged ? 'is-dragged' :'', isDragTarget ? 'is-target' :'']" v-if="isVisible"
	@drop="drop" @dragover="dragover" @dragenter="dragenter" @dragleave="dragleave" :id="post.id">

	<div v-if="(post.type == 'image')" class="post-content image" v-html="post.content"></div>
	<div v-else-if="(post.type == 'video')" class="post-content video">Video</div>
	<div v-else class="post-content" @mouseenter.once="initTiny" @blur="savePost" v-html="post.content"></div>

	<aside class="post-time"><span>{{post.time}}</span> min</aside>
	<aside class="post-date">Datum: <span>{{post.date}}</span></aside>
	<aside class="post-autor">
		Autor: <span>{{post.author.username}}</span></aside>
	<aside class="post-move" draggable="true" @dragstart="dragstart" @dragend="dragend">::</aside>
	<aside class="post-delete" v-on:click="deletePost"></aside>
</div>
</template>



<script>
	export default {
		props: ['post'],
		data: function () {
			return {
				isVisible: true,
				isDragged: false,
				isDragTarget: false,
			}
		},

		computed: {
			postList: function () {return this.$parent.postList;},
			isImage: function () {
				if (this.post.type == 'image') {
					return true
				}
				else {return false}
			}
		},

		methods: {

			dragstart: function (event) {
				this.isDragged = true;
				event.dataTransfer.setData("Text", this.post.id);
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
				this.isDragTarget = true;
			},

			dragleave: function (event) {
				this.isDragTarget = false;
			},

			drop: function (event) {
				event.preventDefault();
				this.isDragTarget = false;
				let draggedElementID = parseInt(event.dataTransfer.getData('Text'));

				if (draggedElementID == this.post.id) {
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


			initTiny: function(event) {
				let element = event.currentTarget;
				let tinyConfig = this.$parent.tinyConfig;
				tinyConfig.target = element; // Extending Config with TinyMCE Target
				tinymce.init(tinyConfig);
			},

			savePost: async function(event) {
				const element = event.currentTarget;
				const response = await axios.patch('/post/'+this.post.id, {'content': element.innerHTML});
			},

			reorderTicker: async function() {
				const response = await axios.patch('/ticker/'+this.$parent.tickerid+'/reorder', {'post_ids': this.postList.join(',')});

				if (response.data.success) {
					console.log(response.data.message);
					this.$parent.refresh();
				}
			},

			deletePost: async function (post) {
				const response = await axios.delete('/post/'+this.post.id);
				console.log(response.data);
				if (response.data.success) {
					this.isVisible = false;
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