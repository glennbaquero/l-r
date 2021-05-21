<script type="text/javascript">
	export default {
		name: 'UpdateNotification',

		props: {
			url: String,
			unreadCount: Number
		},

		data() {
			return {
				unread: this.unreadCount
			}
		},


		render() {
		    return this.$scopedSlots.default({
		        updateNotificationHandler: this.updateNotificationHandler,
		        unread: this.unread,
		    });
		},

		mounted() {

		},

		methods: {
			updateNotificationHandler() {
				axios.post(this.url, {})
					.then(response => {
						this.unread = 0;
					}).catch(errors => {

					})
			}
		}
	}
</script>