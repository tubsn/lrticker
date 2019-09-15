<template>
	<div class="ticker-area">
		<section class="ticker-editor">
			<h2 class="ticker-headline"><slot></slot></h2>
			<ticker-editor @submitted="refresh_list"></ticker-editor>
		</section>
		<ticker-list ref="list"></ticker-list>
	</div>
</template>

<script>

// Vue Components
let TickerEditor = require('./TickerEditor.vue').default;
let TickerList = require('./TickerList.vue').default;

export default {

	components: {
		'ticker-editor': TickerEditor,
		'ticker-list': TickerList,
	},

	props: ['id'],

	computed: {
		tickerID : function () { return this.id; }
	},

	methods: {
		refresh_list : async function () {
			await this.$refs.list.refresh();
		},
	}
}
</script>
