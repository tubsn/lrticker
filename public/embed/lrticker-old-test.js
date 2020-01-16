class lrLiveTicker {

	constructor(id, containerName = '.ticker-container') {

		this.tickerID = id;
		this.tickerContainer = document.querySelector(containerName);
		this.jsonURL = 'http://test.lr-cottbus.de/storage/ticker/';
		this.refreshText = 'Ticker aktualisieren';
		this.activePosts = [];
		this.tickerBody; // Populated by createTickerDom()
		this.tickerHeadline; // Populated by refreshTicker()
		this.tickerPosts; // Populated by refreshTicker()

		this.createTickerDOM();
		this.refreshTicker();

	}

	createTickerDOM() {

		// Refresh Functionality
		let refreshContainer = document.createElement('div');
		refreshContainer.classList.add('ticker-refresh');

		let refreshButton = document.createElement('button');
		refreshButton.classList.add('ticker-refresh-button');
		refreshButton.innerText = this.refreshText;
		refreshButton.addEventListener('click', () => {
			refreshBar.classList.remove('ticker-refresh-bar');
			void refreshBar.offsetWidth;
			refreshBar.classList.add('ticker-refresh-bar');
			this.refreshTicker();
		});

		let refreshWrapper = document.createElement('div');
		refreshWrapper.classList.add('ticker-refresh-wrapper');

		let refreshBar = document.createElement('div');
		refreshBar.classList.add('ticker-refresh-bar');

		refreshContainer.appendChild(refreshButton);
		refreshWrapper.appendChild(refreshBar);
		refreshContainer.appendChild(refreshWrapper);
		this.tickerContainer.appendChild(refreshContainer);

		// Tickerbody
		this.tickerBody = document.createElement('div');
		this.tickerBody.classList.add('ticker-body');

		this.tickerHeadline = document.createElement('div');
		this.tickerHeadline.classList.add('ticker-headline');
		this.tickerBody.appendChild(this.tickerHeadline);

		this.tickerPosts = document.createElement('div');
		this.tickerPosts.classList.add('ticker-posts');
		this.tickerBody.appendChild(this.tickerPosts);

		this.tickerContainer.appendChild(this.tickerBody);

	}

	async getTickerData() {
		let response = await fetch(`${this.jsonURL}${this.tickerID}.js`);
		return await response.json();
	}

	refreshTicker(tickerData) {

		this.getTickerData().then(tickerData => {

			let ticker = tickerData.ticker;
			let posts = tickerData.posts;
			let container = this.tickerBody;

			let lastUpdate = ticker.updated_at;
			let startDate = ticker.start;
			let author = ticker.author.username;

			this.tickerHeadline.innerHTML = ticker.name;

			//posts.reverse();

			posts.forEach(post => {
				this.tickerPosts.appendChild(this.formatSinglePost(post));
			});

			console.log(this.activePosts);

		});

	}


	formatSinglePost(post) {

		//this.activePosts.splice(6, 1)

		if (this.activePosts[post.id]) {
			//container.classList.add('edited');
			//console.log(post.id + ' exists')
			return document.createElement(null);
		}



		if (!this.activePosts[post.id]) {
			//container.classList.add('added');
			//console.log(post.id + ' neeeeeu')

			let container = document.createElement('div');
			container.classList.add('ticker-post');

			if (post.media) {
				post.media = `<div class="ticker-post-media">${post.media}</div>`
			}

			else {post.media = ''};

			if (post.content) {
				container.innerHTML = `
				<span class="ticker-post-time" title="${post.date}"> ${post.time} Uhr</span>
				${post.content} ${post.media}`;
			}

			else {
				container.innerHTML = `${post.media}`;
			}

			this.activePosts[post.id] = post;

			return container;


		}


		/*
		if (this.postIDs.indexOf(post.id) <= 0) {
			//console.warn(post.id + ' deleted')
			container.classList.add('adding');
		}
		*/

		// Add Current Post to Set of active Posts

		// container.classList.add('deleted');




	}

}


document.addEventListener("DOMContentLoaded", function(){
	let liveticker = new lrLiveTicker(2);
	console.log(liveticker)
});