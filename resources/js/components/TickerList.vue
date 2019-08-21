<template>
<div>
	<ticker-post v-for="post, postKey in posts" v-bind:post="post" v-bind:key="postKey"></ticker-post>
</div>

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

		props: ['tickerid'],
		data: function () {
			return {
				posts: ''
			}
		},

		computed: {
			tinyConfig: function () {
				return this.$parent.tinyConfig;
			}

		},

		methods: {
			refresh: async function () {
				if (this.tickerid) {
					const response = await axios.get('/ticker/'+this.tickerid+'/refresh');
					this.posts = response.data;
				}
			},

		},

	}
</script>
