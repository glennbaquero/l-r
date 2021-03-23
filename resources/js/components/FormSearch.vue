<script type="text/javascript">
	export default {
		name: 'FormSearch',

		props: {
			url: String
		},

		data() {
			return {
				payload: {},
				result: {}
			}
		},

		render() {
		    return this.$scopedSlots.default({
		        search: this.search,
		        payload: this.payload,
		        result: this.result,
		    });
		},

		methods: {
			search() {
				axios.post(this.url, this.payload) 
					.then(response => {
						this.result = response.data.result;

						this.$children[0].display = true;
						console.log(this.$children[0].display);
					}).catch(error => {

					})
			}
		}
	}
</script>