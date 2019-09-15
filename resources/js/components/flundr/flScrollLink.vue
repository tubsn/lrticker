<template>
	<a :href="href" @click.prevent="scrollTo">
		<slot></slot>
	</a>
</template>

<script>

	export default {

		props: ['href'],

		data: function () {
			return {
			}
		},


		methods: {
			scrollTo() {

				document.querySelector(this.href).scrollIntoView({behavior: "smooth", block: "start", inline: "nearest"});


			},
		},
	}
</script>