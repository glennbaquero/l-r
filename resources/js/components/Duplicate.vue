<script type="text/javascript">
	import Loading from './Loading.vue'
	import Modal from './Modal.vue';
    import Response from '../mixins/response.js';

	export default {
		name: 'Duplicate',

		props: {
			url: String
		},

		data() {
			return {
				payload: {},
				result: {},
				loading: false,
				modalMessage: null,
				modalTitle: null,
				showModal: false
			}
		},
		
		components: {
		    Loading,
		    Modal,
		},

        mixins: [ Response ],

		render() {
		    return this.$scopedSlots.default({
		        actionHandler: this.actionHandler,
		        payload: this.payload,
		        result: this.result,
		        loading: this.loading,
		        modalMessage: this.modalMessage,
		        modalTitle: this.modalTitle,
		        showModal: this.showModal,
		    });
		},

		methods: {
			actionHandler() {
				this.loading = true;
				axios.post(this.url, this.payload) 
					.then(response => {
						// this.result = response.data.result;
						this.loading = false;
						this.modalMessage = response.data.message;
						this.modalTitle = response.data.title;
						this.showModal = true;
					}).catch(error => {
						this.showModal = true;
						this.modalMessage = this.parseResponse(error);
						this.modalTitle = 'Ooops!';
						this.loading = false;
					})
			},
		}
	}
</script>