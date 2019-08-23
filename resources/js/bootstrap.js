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
require('tinymce/plugins/lists');
require('tinymce/plugins/media');
require('tinymce/plugins/table');
require('tinymce/plugins/quickbars');
require('tinymce/plugins/code');
require('tinymce/plugins/paste');

window.tinyMCEConfig = {
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
		extended_valid_elements : 'a[href|target=_blank]'
}

// Vue Instance
window.Vue = require('vue');

// Vue Components
window.Editor = require('@tinymce/tinymce-vue').default;
window.TickerList = require('./components/TickerList.vue').default;
window.TickerPost = require('./components/TickerPost.vue').default;