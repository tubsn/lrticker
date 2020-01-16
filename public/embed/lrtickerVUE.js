Vue.component('lr-liveticker', {
	data: function () {
		return {
			headline: 'Tickerheadline',
			posts : '',
			refreshTime : 10000
		}
	},

	props: ['tickerId'],

	created: function() {
		this.loadTickerJSON(); // Initial Refresh
	},

	mounted: function() {
		this.$refs.refreshBar.style.animationDuration = (this.refreshTime/1000) + 's';
	},

	methods: {
		loadTickerJSON: function(){
			fetch(`http://test.lr-cottbus.de/storage/ticker/${this.tickerId}.js`, {cache: "no-store"})
				.then(response => response.json())
				.then(tickerData => {
					this.posts = tickerData.posts;
					this.headline = tickerData.ticker.headline;
					document.title = this.headline;

					// Interval Timer for Refresh
					clearInterval(this.interval);
					let self = this;
					this.interval = setInterval(function(){ self.refreshTicker(); }, this.refreshTime);					
			});
		},

		refreshTicker: function() {
			
			this.loadTickerJSON();

			// Reset the Refreshbar CSS Animation
			this.$refs.refreshBar.classList.remove('ticker-refresh-bar');
			this.$refs.refreshBar.offsetWidth;
			this.$refs.refreshBar.classList.add('ticker-refresh-bar');

		}

	},

	template:`
	<div id="ticker-container" class="ticker-container">
		<div class="ticker-logo-area">
		<img src="/embed/LRBadge.svg" />
		<span>Live</span> aus Cottbus
		</div>
		<div class="ticker-refresh">
			<button @click="refreshTicker" class="ticker-refresh-button">aktualisieren</button>
			<div class="ticker-refresh-wrapper">
				<div class="ticker-refresh-bar" ref="refreshBar"></div>
			</div>
		</div>
		<div class="ticker-body">
			<div class="ticker-headline">{{ headline }}</div>
			<div class="ticker-posts">
				<ticker-post v-for="(post, index) in posts" v-bind:post="post" :key="post.id"></ticker-post>
			</div>
		</div>
	</div>`
})


Vue.component('ticker-post', {
	data: function (){
		return {
			transitionState: '',
		}
	},

	props: ['post'],

	computed: {
		postID: function () {
			return this.post.id;
		},			
		content: function () {
			return this.post.content;
		},
		media: function () {
			return this.post.media;
		},
		date: function () {
			return this.post.date;
		},
		time: function () {
			return this.post.time;
		},		
		author: function () {
			return this.post.author;
		}			
	},

	methods: {
		resetState: function() {
			let self = this;
			setTimeout(function(){ self.transitionState = "" }, 300);
		},
	},

	watch: {
		content: function () {
			this.transitionState = "edited";
			this.resetState();
		}
	},

	created: function() {
		this.transitionState = "added";
		this.resetState();

		// Lazy Load possible Twitter Posts
		if (twttr.widgets) { twttr.widgets.load(this.$el) }

	},

	// Hier weitermachen...
	mounted: function() {
		let elem = document.querySelector('.ticker-slider');
		let flkty = new Flickity( elem, {
		  // options
		  height: '100%'
		});

	},

	template:`
	<div :id="'post-'+postID" class="ticker-post" :class="transitionState">
		<div class="ticker-date" :title="'Eintrag von '+author.username+' um: '+time+' Uhr am: '+date">{{time}} <span>Uhr</span></div>
		<div class="ticker-post-media" v-if="media" v-html="media"></div>
		<div class="ticker-post-content" v-if="content" v-html="content"></div>
	</div>
	`
})


let liveticker = new Vue({
	el: '.ticker-container',
})
