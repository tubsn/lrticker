<template>
	<span>
		<button @click="openDialog" type="button"><slot></slot></button>

		<div v-show="isVisible" class="modal-container" ref="modalContainer" @click.self="destroyModal">

			<div class="centered-box">
				<h2>Youtube Link eingeben:</h2>
				<label>Hier nicht den Embed Code sondern einfach den Link einfügen
					<input v-model="embed" placeholder="z.B. https://www.youtube.com/watch?v=e7KjEpNDZTI" ref="input">
				</label>
				<button class="button" type="button" @click="submit">Einfügen</button>
				<button class="button minor" @click="destroyModal">abbrechen</button>
			</div>

		</div>
	</span>
</template>

<script>

	export default {

		data: function () {
			return {
				isVisible : false,
				embed : '',
			}
		},

		methods: {

			openDialog: function(event) {
				document.body.appendChild(this.$refs.modalContainer);
				this.isVisible = true;

				let focusElement = this.$refs.input;
				_.delay(function() {
					focusElement.focus();
				}, 5);

			},


			destroyModal: function() {
				this.isVisible = false;
			},

			submit: function() {
				if (this.embed != '') {
					this.$emit('submit', this.embed);
					this.destroyModal();
				}
			}
		},
	}
</script>

<style scoped>

h2 {margin-bottom:0;}
.modal-container {left:0; top:0; position:fixed; z-index:999; display:grid;
width:100%; min-height: 100vh; background-color: #00000055;}

.centered-box {width:100%; max-width:800px; padding:2em; box-sizing: border-box;}

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
