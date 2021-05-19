<script type="text/javascript">
	export default {
		name: 'FormData',

		props: {
			url: String
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
				this.$children[0].display = true;
				axios.post(this.url, this.payload) 
					.then(response => {
						this.$children[0].display = false;
						this.result = response.data.result;
						this.$parent.display = false;
					}).catch(error => {
						this.$children[0].display = false;
						this.$parent.display = false;
					})
			}
		}
	}
</script>