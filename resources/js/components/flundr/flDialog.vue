<template>
	<span @click="openDialog" @keyup.esc="destroyModal">
		<slot name="button"><button class="button">{{ button }}</button></slot>
		<transition name="fade">
		<div v-show="isVisible" class="modal-container" ref="modalContainer" @click.self="destroyModal">
			<div class="centered-box">
				<slot></slot>
				<div class="mt">
					<button class="button" type="button" @click="submitModal">{{ submit }}</button>
					<button class="button minor" @click="destroyModal">{{ cancel }}</button>
				</div>
			</div>
		</div>
		</transition>
	</span>
</template>

<script>

	export default {

		props: {
			button: {type: String, default: 'Öffnen'},
			submit:{type: String, default: 'Ok'},
			cancel:{type: String, default: 'Abbrechen'},
			method:{type: String},
			action:{type: String, default: 'post'},
			redirect:{type: String,	default: ''}
		},

		data: function () {
			return {
				isVisible : false,
				embed : '',
			}
		},

		methods: {

			openDialog: function(event) {
				event.preventDefault();
				document.body.appendChild(this.$refs.modalContainer);
				this.isVisible = true;
			},

			destroyModal: function() {
				this.isVisible = false;
			},

			submitModal: function() {
				this.makeRequest();
				this.destroyModal();
			},

			makeRequest: async function() {
				try {

					const response = await axios({ method: this.method, url: this.action, });
					if (response.data.success) {
						window.location = this.redirect;
					}

				} catch (error) {
					console.error(error);
				}
			}

		},
	}
</script>

<style>

h2 {margin-bottom:0;}
.modal-container {left:0; top:0; position:fixed; z-index:999; display:grid;
width:100%; min-height: 100vh; background-color: #00000055;}


.modal-container.fade-enter-active, .modal-container.fade-leave-active {
  transition: opacity .2s;
}
.modal-container.fade-enter, .modal-container.fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

.centered-box {width:100%; max-width:800px; padding:2em; box-sizing: border-box; background-color:#f0f0f0;}

@media only screen and (min-width: 720px) {
	.modal-container {justify-items: center; align-items: center;}
	.centered-box {
	width:70%; max-width:800px;
	background-color:white; border: 1px solid #cecece;
	box-shadow: 0 0 1.5em 0 rgba(0,0,0,0.3);}
}

@media only screen and (min-width: 720px) and (min-height: 900px) {
	.centered-box {transform: translateY(-20%);}
}
</style>
