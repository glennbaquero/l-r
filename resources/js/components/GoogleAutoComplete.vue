<script>
	import googleAutocomplete from '../mixins/googleAutocomplete.js';

	export default {
		mixins: [ googleAutocomplete ],

	    name: 'google-auto-complete',

	    props: {
	    	item: Object,
	    },

		data:() => ({
			address: {
				id: null,
				address_line_1: '',
				address_line2: '',
				city: '',
				state: '',
				postal_code: '',

				/* Get only the timezone for main address */
				latitude: '',
				longitude: '',
				timezone_id: '',
				timezone_name: '',
			}
		}),


		render() {
		    return this.$scopedSlots.default({
		       address: this.address
		    });
		},

 		mounted() {

 			// Methods from mixins google auto complete places
 			if(!_.isEmpty(this.item)) {
 				this.address = this.item;
 			}

 			if(document.getElementById("latitude") && document.getElementById("longitude")) {
	 			this.address.latitude = document.getElementById("latitude").value;
	 			this.address.longitude = document.getElementById("longitude").value;
 			}
 			
 			this.autoCompletePlaces();
 			this.placeChanged(this.address);


 		}
	}
</script>