<script type="text/javascript">
	export default {
		name: 'FormData',

		props: {
			url: String,

			forNotification:{
				type: Boolean,
				default: false
			},

			forReply:{
				type: Boolean,
				default: false
			},
		},

		data() {
			return {
				payload: {},
				result: null
			}
		},

		render() {
		    return this.$scopedSlots.default({
		        actionHandler: this.actionHandler,
		        payload: this.payload,
		        result: this.result,
		    });
		},

		methods: {
			actionHandler() {
				//loading
				this.$children[0].display = true;

				if(this.forNotification && !this.forReply) {
					if(this.payload.send_to != 'All') {
						this.payload.ids = this.$children[1].$children[0].selected;
					}
				}
				
				axios.post(this.url, this.payload) 
					.then(response => {
						//loading
						this.$children[0].display = false;
						
						this.result = response.data.result;
						
						//modal
						this.$parent.display = false;
					}).catch(error => {
						//loading
						this.$children[0].display = false;
						//modal
						this.$parent.display = false;
					})
			}
		}
	}
</script>