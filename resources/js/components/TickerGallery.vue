<template>
  <div class="carousel">
  </div>
</template>
<script>

import Flickity from 'Flickity';
export default {

	props: ['images'],

	mounted: function() {
		this.pushIntoSlider();
		this.initSlider();
	},

	methods: {

		pushIntoSlider: function() {
			Array.from(this.images).forEach(image => {
				this.$el.appendChild(image);
			});
		},

		initSlider: function() {
			let flkty = new Flickity( this.$el, {
				cellAlign: 'left',
				contain: true,
				wrapAround: false,
				pageDots: false,
				//autoPlay: 3000,
				pauseAutoPlayOnHover: false,
				imagesLoaded: false,
				adaptiveHeight: true,
			});

			// Call for a resize with delay
			// so that image heights are available
			_.delay(function() {
				flkty.resize();
			}, 5);

		},
	},

}
</script>

<style>
.flickity-viewport {transition: height 0.2s;}
.flickity-viewport:hover .flickity-button {opacity:1}
.flickity-button-icon {opacity:0.4;}
.carousel img {width: 100%; margin-right: 1em; line-height:0; margin-bottom:0;}
</style>