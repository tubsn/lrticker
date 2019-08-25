<template>
<section class="posts">
	<ticker-post v-for="(post, index) in posts" v-bind:post="post" :key="index"></ticker-post>
</section>
</template>

<script>

	let TickerPost = require('./TickerPost.vue').default;

	export default {

		components: {
			'ticker-post': TickerPost
		},

		mounted: function () {
			this.refresh();
		},

		data: function () {
			return {
				posts: ''
			}
		},

		computed: {
			tickerID : function () { return this.$parent.tickerID; },
			postList: function () {	return this.posts.map((post) => { return post.id; }) ;}
		},

		methods: {
			refresh: async function () {
				if (this.tickerID) {
					const response = await axios.get('/ticker/'+this.tickerID+'/refresh');
					this.posts = response.data;
				}
			},

		},

	}
</script>
