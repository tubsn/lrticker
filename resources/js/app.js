/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');



/*
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
const app = new Vue({
    el: '#app',
});
*/


//Document Ready
document.addEventListener("DOMContentLoaded", function() {





const livetickerAPP = new Vue({
el: '#liveticker',
data: {
	tickerID: '',
	posts: '',
	newPost: '',
	tinyConfig: {
		menubar: false,
		inline: true,
		toolbar: false,
		plugins: ['autolink','link','lists','media','table','quickbars','code','paste'],
		quickbars_insert_toolbar: '',
		//quickbars_selection_toolbar: 'h1 h2 h3 blockquote | bold italic strikethrough | forecolor backcolor | bullist | quicklink | removeformat',
		quickbars_selection_toolbar: 'quicklink | bold italic strikethrough bullist | forecolor backcolor | removeformat',
		contextmenu: 'hr link | paste pastetext inserttable | cell row column deletetable | code removeformat',
		relative_urls: false,
		remove_script_host: false,
		link_assume_external_targets: true,

		paste_enable_default_filters: false,
		paste_word_valid_elements: "b,strong,i,em,h1,h2,p",
		invalid_elements : 'div',

		//valid_elements: 'a[href|target=_blank],span,b,strong,i,em,p,br,ul,li,table,td,tr,th',
		extended_valid_elements : 'a[href|target=_blank]',
	},

},

components: {
	'editor': Editor,
	'ticker-list': TickerList
},

created: function() {

},

mounted: function () {
	this.tickerID = this.$el.getAttribute('data-tickerID');
},

methods: {
	submitPost: async function() {
		try {
			const response = await axios.post('/post', {'content': this.newPost, 'ticker_id': this.tickerID});

			console.log(response);
			if (response.data.added) {
				this.$refs.ticker.refresh();
				this.newPost = '';
				this.$refs.newPost.$el.focus();
			}

		} catch (error) {
			console.error(error);
		}

	},


}

}) // End Vue




}); // End Document Rdy

