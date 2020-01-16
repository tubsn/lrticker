<template>
	<div>
		<input @change="onFilesSelected" type="file"  ref="fileSelector">
	</div>
</template>

<script>

	export default {

		props: ['action','method','trigger'],

		data: function () {
			return {
				element : null,
				maxFileSize: 5 * 1024*1024,
				allowedFormats : ['image/jpeg', 'image/gif', 'image/webp', 'image/svg+xml', 'image/png', 'image/bmp'],
			}
		},

		computed: {

		},

		mounted: function() {
			this.triggerElement = document.querySelector(this.trigger);
			this.addListener(this.triggerElement);
		},

		methods: {

			addListener: function(element) {

				let fileSelector = this.$refs.fileSelector;

				element.addEventListener("click", function(){
					fileSelector.click();
				});

			},

			onFilesSelected: function(event) {
				let files = Array.from(event.target.files);
				files = this.filterResctricted(files);
				this.uploadFiles(files);
			},

			filterResctricted: function(files) {
				let rescrictedFiles = [];
				let acceptedFiles = files.filter(file => {

					// Check for Filesize
					if (file.size > this.maxFileSize) {
						file.reason = 'File is too big';
						rescrictedFiles.push(file);
						return;
					}

					// Check for Extensions
					if (!this.allowedFormats.includes(file.type)) {
						file.reason = 'Filetype not allowed';
						rescrictedFiles.push(file);
						return;
					}

					return file;
				});

				this.announceRescrited(rescrictedFiles);
				return acceptedFiles;
			},


			announceRescrited: function(files) {
				files.forEach(file => {
					console.warn(`"${file.name}" rejected | ${file.reason}`);
				});
			},


			uploadFiles: async function(files) {

				if (files.length == 0) {
					return;
				}

				let data = new FormData();

				files.forEach(file => {
					data.append('files[]', file);
				});

				const response = await axios.post('/attachment', data);
				console.log(response.data);
				this.saveToUser(response.data[0].url);
			},

			saveToUser: async function(url) {

				let data = {'thumbnail' : url};

				try {
					const response = await axios.patch('/profil/thumbnail', data);
					if (response.data.success) {
						return true;
					}

					location.reload();

				} catch (error) {
					alert(error);
				}

			},
		},

	}
</script>

<style scoped>
	input {display:none;}
</style>
