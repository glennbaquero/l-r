<script type="text/javascript">
 	import Loading from './Loading.vue';

	export default {
		name: 'PdfViewer',

		props: {
			getOffices: Array,
			getUsers: Array,
			getCash: Array,
			searchUrl: String
		},

		data() {
			return {
				src: null,
				offices: [],
				users: [],
				cash_registers: [],
				viewer_show: false,
				loading: false,
			}
		},

		render() {
		    return this.$scopedSlots.default({
		    	src: this.src,
		    	offices: this.offices,
		    	users: this.users,
		    	cash_registers: this.cash_registers,
		    	getPdfDataDailyTill: this.getPdfDataDailyTill,
		    	viewer_show: this.viewer_show,
		    	loading: this.loading,
		    });
		},

		components: {
			Loading
		},

		methods: {
			selectChanged(value, type) {
				switch(type) {
					case 'office_type':
						this.offices = _.filter(this.getOffices, (office) => { return office.office_type_id == value});
						break;
					case 'office':
						this.users = _.filter(this.getUsers, (user) => { return user.office_id == value});
						break;
					case 'user_cash_registry':
						this.cash_registers = _.filter(this.getCash, (cash) => { return cash.user_id == value});
						break;
				}
			},

			getPdfData() {
				this.loading = true;

				var date_type = this.$children[4].display;
				var office_type_id = this.$children[1].selectedItem.id;
				var office_id = this.$children[2].selectedItem.id;
				var user_ids = this.$children[3].selected;
				var start_date = document.getElementById("start_date").value;
				var end_date = date_type ? document.getElementById("end_date").value : null;
				var url = this.searchUrl+'/'+user_ids+'/'+date_type+'/'+start_date+'/'+end_date;
				this.fetch(url);
			},

			getPdfDataDailyTill() {
				this.loading = true;

				var office_type_id = this.$children[1].selectedItem.id;
				var office_id = this.$children[2].selectedItem.id;
				var user_ids = this.$children[3].selected;
				var date_type = this.$children[4].display;
				var cash_register = _.isEmpty(this.$children[5].selectedItem) ? null : this.$children[5].selected;
				var start_date = document.getElementById("start_date").value;
				var end_date = date_type ? document.getElementById("end_date").value : null;
				var url = this.searchUrl+'/'+user_ids+'/'+date_type+'/'+start_date+'/'+end_date+'/'+cash_register;
				this.fetch(url);
			},

			fetch(url) {
				axios.get(url)
					.then(response => {
						setTimeout(() => {
							document.getElementById('pdf_viewer').contentWindow.location.reload();
							this.viewer_show = true;
							this.loading = false;
						}, 500)
					}).catch(errors => {
						this.viewer_show = false;
						this.loading = false;
					})
			}
		}
	}
</script>>