<template>
	<span>
		<button @click="openFileSelector"><slot></slot></button>
		<input @change="onFilesSelected" type="file" ref="fileSelector">
	</span>
</template>

<script>

	export default {

		props: ['action','method'],

		data: function () {
			return {
				maxFileSize: 2 * 1024*1024,
				allowedFormats : ['image/jpeg', 'image/gif', 'image/webp', 'image/svg+xml', 'image/png', 'image/bmp'],
			}
		},

		computed: {

		},

		methods: {

			openFileSelector: function(event) {
				event.preventDefault();
				this.$refs.fileSelector.click();
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
				this.$emit('fileuploaded', response.data);
			}

		},

	}
</script>

<style scoped>
	input {display:none;}
</style>
