/**
 * First, we will load all of this project's Javascript utilities and other
 * dependencies. Then, we will be ready to develop a robust and powerful
 * application frontend using useful Laravel and JavaScript libraries.
 */

require('./bootstrap');

// Tiny
var TinyMCE = require('tinymce');
TinyMCE.baseURL = "/styles/libs/tiny/";// trailing slash important
require('tinymce/themes/silver');
require('tinymce/plugins/autolink');
require('tinymce/plugins/link');
require('tinymce/plugins/lists');
require('tinymce/plugins/media');
require('tinymce/plugins/table');
require('tinymce/plugins/quickbars');
require('tinymce/plugins/code');
require('tinymce/plugins/paste');


var Editor = require('@tinymce/tinymce-vue').default;


//Document Ready
document.addEventListener("DOMContentLoaded", function() {

// Vue Instance
var Vue = require("vue");
var livetickerAPP = new Vue({
el: '#liveticker',

data: {
	tickerID: '',
	posts: '',
	newPost: '',
	tinyMainConfig: {
		menubar: false,
		inline: true,
		toolbar: false,
		plugins: ['autolink','link','lists','media','table','quickbars','code','paste'],
		quickbars_insert_toolbar: '',
		//quickbars_selection_toolbar: 'h1 h2 h3 blockquote | bold italic strikethrough | forecolor backcolor | bullist | quicklink | removeformat',
		quickbars_selection_toolbar: 'quicklink | bold italic strikethrough bullist | forecolor backcolor | removeformat',
		contextmenu: 'hr link | inserttable | cell row column deletetable | code removeformat',
		relative_urls: false,
		remove_script_host: false,
		link_assume_external_targets: true,
		valid_elements: 'a[href|target=_blank],span,b,strong,i,em,p,br,ul,li,table,td,tr,th',

	},
},

components: {
	'editor': Editor
},

created: function() {

},

mounted: function () {
	this.tickerID = this.$el.getAttribute('data-tickerID');
	this.refresh();
},

methods: {
	refresh: async function () {
		const response = await axios.get('/ticker/'+this.tickerID+'/refresh');
		//console.log(response);
		this.posts = response.data;
	},
	delete_post: async function (post, postKey) {
		const response = await axios.delete('/ticker/'+this.tickerID+'/'+post.id);
		console.log(response.data.message);
		if (response.data.deleted) {
			this.$delete(this.posts, postKey);
		}
	},
	submitPost: async function() {
		const response = await axios.post('/ticker/'+this.tickerID+'/addpost', {'content': this.newPost});
		if (response.data.added) {
			this.refresh();
			this.newPost = '';
			this.$refs.newPost.$el.focus();
		}
	},
	editPost: function(post) {
		//const response = await axios.post('/ticker/'+this.tickerID+'/addpost', {'content': this.newPost});
		console.log(post);


	}
}

}) // End Vue






/*
async function refreshPosts() {
	const Posts = await axios.get('http://test.lr-cottbus.de/ticker/3/refresh');
	console.log(Posts); // Async

}
refreshPosts();
*/


}); // End Document Rdy

