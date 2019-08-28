<template>
  <div class="carousel" @mouseenter="resize">
  </div>
</template>
<script>

import Flickity from 'Flickity';
export default {

	data: function () {
		return {
			flkty: null,
		}
	},

	props: ['images'],

	mounted: function() {

		Array.from(this.images).forEach(image => {
			/*
			let wrapper = document.createElement('div');
			wrapper.appendChild(image);
			this.$el.appendChild(wrapper);
			*/
			this.$el.appendChild(image);
		});


		this.flkty = new Flickity( this.$el, {
			cellAlign: 'left',
			contain: true,
			wrapAround: false,
			pageDots: false,
			//autoPlay: 3000,
			pauseAutoPlayOnHover: false,
			imagesLoaded: false,
			adaptiveHeight: true,
			//setGallerySize: false
		});

		this.resize(); // Async Fix for unknown image heights

	},

	methods: {

		resize: async function() {
			await this.sleep(1);
			this.flkty.resize();
		},

		sleep: function(milliseconds) {
 			return new Promise(resolve => setTimeout(resolve, milliseconds));
		},

	},

}
</script>

<style>
/*
.carousel {height:300px; background-color:var(--light-background)}
.carousel div {height:100%; width:100%; text-align:center;}
*/

.isActive {}

.flickity-viewport {transition: height 0.2s;}
.flickity-viewport:hover .flickity-button {opacity:1}
.flickity-button-icon {opacity:0.4;}

.carousel img {
  width: 100%;
  margin-right: 1em;
  line-height:0;
  margin-bottom:0;
}


</style>