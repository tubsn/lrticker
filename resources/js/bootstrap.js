window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });



// Tiny
window.TinyMCE = require('tinymce');
window.TinyMCE.baseURL = "/styles/libs/tiny/";// trailing slash important
require('tinymce/themes/silver');
require('tinymce/plugins/autolink');
require('tinymce/plugins/link');
//require('tinymce/plugins/lists');
//require('tinymce/plugins/media');
require('tinymce/plugins/table');
require('tinymce/plugins/quickbars');
require('tinymce/plugins/code');
require('tinymce/plugins/paste');

window.globalTinyConfig = {
		menubar: false,
		inline: true,
		toolbar: false,
		plugins: ['autolink','link','table','quickbars','code','paste'],
		quickbars_insert_toolbar: '',
		//quickbars_selection_toolbar: 'h1 h2 h3 blockquote | bold italic strikethrough | forecolor backcolor | bullist | quicklink | removeformat',
		quickbars_selection_toolbar: 'bold italic strikethrough | blockquote | alignleft aligncenter alignright | forecolor backcolor | quicklink removeformat',
		contextmenu: 'hr link | fontsizes lineheight | inserttable cell row column deletetable | code removeformat',
		relative_urls: false,
		remove_script_host: false,
		link_assume_external_targets: true,

		fontsize_formats: ".8em .9em 1em 1.1em 1.2em 1.3em",
		lineheight_formats: '100% 120% 140% 160%',

		paste_enable_default_filters: false,
		//paste_word_valid_elements: "b,strong,i,em,p",
		invalid_elements : 'div, aside, section, article, iframe, ul, li, ol',
		fix_list_elements : true,
		paste_data_images: true,

		extended_valid_elements : 'a[href|target=_blank]', // Converts all Links to target _blank

		formats: {
			removeformat: [
				{ selector: 'b,strong,span,em,i,font,u,strike,blockquote,sub,sup,dfn,code,samp,kbd,var,cite,mark,q,del,ins,h1,h2,h3,a,ul,li,ol',
				split: true, block_expand: true, expand: false, deep: true, remove: 'all' },
				{ selector: '*', attributes: ['style', 'class'], split: false, expand: false, deep: true }
			]
		},

		mobile: {
			quickbars_selection_toolbar: 'bold italic strikethrough | blockquote | alignleft aligncenter alignright | forecolor backcolor | quicklink removeformat',
			contextmenu: '',
		},

}




// Vue Instance
window.Vue = require('vue');
