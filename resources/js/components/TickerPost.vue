<template>
<div class="post-layout" v-if="isVivible">
	<div class="post-content" @mouseover.once="initTiny" @blur="savePost" v-html="post.content"></div>
	<aside class="post-time"><span>{{post.time}}</span> min</aside>
	<aside class="post-date">Datum: <span>{{post.date}}</span></aside>
	<aside class="post-autor">
		Autor: <span>{{post.author.username}}</span></aside>
	<aside class="post-move">::</aside>
	<aside class="post-delete" v-on:click="deletePost"></aside>
</div>
</template>

<script>
	export default {
		props: ['post'],
		data: function () {
			return {
				isVivible: true
			}
		},

		methods: {

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

			deletePost: async function (post) {

				const response = await axios.delete('/post/'+this.post.id);
				console.log(response.data);
				if (response.data.deleted) {
					this.isVivible = false;
				}
			},

		}
	}
</script>
