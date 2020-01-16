<template>
	<div class="ticker-area">
		<section class="ticker-editor">
			<h2 class="ticker-headline" contenteditable="true" v-on:blur="saveHeadline"><slot></slot></h2>
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

	props: ['id','tickerStatus','tickerTyp'],

	computed: {
		tickerID : function () { return this.id; },
		active : function () { return this.tickerStatus; },
		showTimer : function () {
			if (this.tickerTyp == 'Fussball') {
				return true;
			}
		}
	},

	methods: {
		refresh_list : function () {
			this.$refs.list.refresh();
		},

		saveHeadline: async function(event) {
			const element = event.currentTarget;
			const response = await axios.patch('/ticker/'+this.id, {'headline': element.innerText, 'js':true});
		},

	}
}
</script>
