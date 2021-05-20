<script type="text/javascript">
	export default {
		name: 'UpdateUserOffice',

		props: {
			url: String,
			office_id: Number
		},

		data() {
			return {
				payload: {
					office_id: this.office_id
				},
				result: null
			}
		},

		render() {
		    return this.$scopedSlots.default({
		        actionHandler: this.actionHandler,
		        payload: this.payload,
		    });
		},

		methods: {
			actionHandler() {
				axios.post(this.url, this.payload) 
					.then(response => {
						this.result = response.data.result;
					}).catch(error => {

					})
			}
		}
	}
</script>