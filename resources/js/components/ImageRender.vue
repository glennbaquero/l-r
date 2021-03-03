<script type="text/javascript">
	export default {
		name: 'ImageRender',
		props: {
			item: Object
		},

		data() {
			return {
				image: null,
				display: false
			}
		},

		render() {
		    return this.$scopedSlots.default({
		    	image: this.image,
		    	display: this.display,
		    	fileChanged: this.fileChanged
		    });
		},

		mounted() {
			if(!_.isEmpty(this.item)) {
				this.image = this.item.full_image_path;
			}
		},

		watch: {
			image(val) {
				if(val) {
					this.display = true;
				} else {
					this.display = false;
				}
			}
		},

		methods: {
			fileChanged() {
		        /*
		          Set the local file variable to what the user has selected.
		        */
	        	this.image = document.getElementById("file").files[0];

		        /*
		          Initialize a File Reader object
		        */
	       	 	let reader  = new FileReader();

		        /*
		          Add an event listener to the reader that when the file
		          has been loaded, we flag the show preview as true and set the
		          image to be what was read from the reader.
		        */
		        reader.addEventListener("load", function () {
			          this.image = reader.result;
			        }.bind(this), false);

		        /*
		          Check to see if the file is not empty.
		        */
			    if( this.image ){
		          	/*
		            	Ensure the file is an image file.
		          	*/
	    	    	if ( /\.(jpe?g|png|gif)$/i.test( this.image.name ) ) {
		            	/*
		              		Fire the readAsDataURL method which will read the file in and
		              		upon completion fire a 'load' event which we will listen to and
		              		display the image in the preview.
		            	*/
	        	    	reader.readAsDataURL( this.image );
		        	}
           		}
			}
		}
	}
</script>