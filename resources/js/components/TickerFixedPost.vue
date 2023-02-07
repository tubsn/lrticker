<template>
<section class="ticker-fixed-post">

	<div v-if="!editorVisible" @click="editorVisible = true" class="ticker-fp-note">
		- Fixierte Nachricht erstellen -
	</div>

	<div v-if="editorVisible" class="ticker-fp-container" @blur="saveFixedPost">
		<div class="ticker-fp-editor" @mouseenter.once="initTiny" @blur="saveFixedPost" v-html="editorContent"></div>
		<aside @click="removeFixedPost" class="ticker-fp-delete"></aside>
	</div>

</section>
</template>

<script>

let Editor = require('@tinymce/tinymce-vue').default;

export default {

	components: {
		'editor': Editor,
	},

	data: function () {
		return {
			editorContent: '',
			editorVisible: false,
		}
	},

	computed: {

		tickerID: function() {return this.$parent.tickerID;},
		tinyConfig: function () {
			return window.globalTinyConfig;
		},

	},

	mounted() {
		this.loadFixedPost();
	},

	methods: {

		loadFixedPost: async function() {
			const tickerID = this.tickerID;
			const response = await axios.get('/ticker/'+tickerID+'/info');
			this.editorContent = response.data.info;
			if (this.editorContent && this.editorContent != '') {this.editorVisible = true;}

		},

		saveFixedPost: async function (event) {
			const element = event.currentTarget;
			const tickerID = this.tickerID;
			const response = await axios.patch('/ticker/'+tickerID, {'info': element.innerHTML, 'js':true});
		},

		initTiny: function(event) {
			let element = event.currentTarget;
			let tinyConfig = window.globalTinyConfig;
			tinyConfig.target = element; // Extending Config with TinyMCE Target
			tinymce.init(tinyConfig);
		},

		removeFixedPost: async function () {
			this.editorVisible = false;
			const tickerID = this.tickerID;
			const response = await axios.get('/ticker/'+tickerID+'/reset_info');
		}

	}
}
</script>

<style>

</style>
