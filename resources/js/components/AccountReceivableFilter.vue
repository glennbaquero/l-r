<script type="text/javascript">
	
	import Loading from './Loading.vue';
	import Modal from './Modal.vue';

	export default {
		name: 'AccountReceivableFilter',

		props: {
			getOffices: Array,
			registerPaymentUrl: String,
		},

		data() {
			return {
				list_office: [],
				field: {
					end_date: null
				},
				office: {},
				show: false,
				loading: false,
				modalMessage: '',
				modalTitle: '',
				showModal: false,
			}
		},

		render() {
		    return this.$scopedSlots.default({
		    	list_office: this.list_office,
		    	search: this.search,
		    	field: this.field,
		    	office: this.office,
		    	show: this.show,
		    	loading: this.loading,
		    	modalMessage: this.modalMessage,
		    	modalTitle: this.modalTitle,
		    	showModal: this.showModal,
		    	closeModal: this.closeModal,
		    	registerPaymentHandler: this.registerPaymentHandler,
		    });
		},


		components: {
			Loading,
		    Modal,
		},


		watch: {
			'field.office_id'(val) {
				this.office = _.find(this.getOffices, (office) => {
					return office.id == val;
				})
			}
		},

		methods: {
			selectChanged(value, type) {
				this.list_office = _.filter(this.getOffices, (office) => { return office.state_name == value});
			},

			registerPaymentHandler() {
				this.loading = true;

				var ids = [];
				_.each(this.$parent.data, (item) => {
					if(item.is_selected) {
						ids.push(item.id);
					}
				})

				if(_.isEmpty(ids)) {
					this.modalMessage = 'Please select one item to proceed.';
					this.modalTitle = 'Ooops';
					// this.showModal = true;
					this.$children[3].display = true;
					this.loading = false;

					return;
				}

				var params = {
					ids: ids
				};

				axios.post(this.registerPaymentUrl, params)
					.then(response => {
						this.modalMessage = response.data.message;
						this.modalTitle = 'Success';
						this.$children[3].display = true;
						// this.showModal = true;
						this.loading = false;

					}).catch(errors => {
						this.modalMessage = 'Something went wrong';
						this.modalTitle = 'Ooops!';
						this.$children[3].display = true;
						// this.showModal = true;
						this.loading = false;
					})
			},

			search() {
				this.show = true;
				this.$parent.params['office_id'] = this.field.office_id;
				this.$parent.params['date'] = this.field.date;
				this.$parent.params['end_date'] = !_.isEmpty(this.field.end_date) ? this.field.end_date : null;
				this.$parent.params['has_end_date'] = !_.isEmpty(this.field.end_date) ? true : false;
				this.$parent.createUrl();
			},

			closeModal() {
				this.showModal = false;
				console.log(this.showModal);
			}
		}

	}
</script>