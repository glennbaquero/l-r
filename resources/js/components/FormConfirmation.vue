<script type="text/javascript">
	import Loading from './Loading.vue'

	export default {
		name: 'FormConfirmation',

		components: {
		    Loading
		},

		props: {
			url: String,
			payloads: Object
		},

		data() {
			return {
				result: 'Verify your reservation',
				loading: false,
				show_button: true,

			}
		},

		render() {
		    return this.$scopedSlots.default({
		        actionHandler: this.actionHandler,
		        result: this.result,
		        loading: this.loading,
		        show_button: this.show_button,
		    });
		},

		methods: {
			actionHandler() {
				//loading
				this.loading = true;

				axios.post(this.url, this.payloads) 
					.then(response => {
						//loading
						this.loading = false;
						
						this.result = response.data.header;
						this.show_button = false;
						
					}).catch(error => {
						//loading
						this.loading = false;
						this.show_button = false;
					})
			}
		}
	}
</script>