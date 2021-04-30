<script type="text/javascript">
 	import Loading from './Loading.vue';

	export default {
		name: 'PdfViewer',

		props: {
			getOffices: Array,
			getUsers: Array,
			getCash: Array,
			getTrips: Array,

			searchUrl: String,

			filteredCashRegister: Boolean,
			filteredTrips: Boolean,
		},

		data() {
			return {
				src: null,
				offices: [],
				users: [],
				cash_registers: [],
				viewer_show: false,
				loading: false,
				filtered_cash_registers: this.search_cash_registers,
				filtered_trips: [],

				available: false
			}
		},

		render() {
		    return this.$scopedSlots.default({
		    	src: this.src,
		    	offices: this.offices,
		    	users: this.users,
		    	cash_registers: this.cash_registers,
		    	viewer_show: this.viewer_show,
		    	loading: this.loading,
		    	filtered_cash_registers: this.filtered_cash_registers,
		    	filtered_trips: this.filtered_trips,

		    	getPdfData: this.getPdfData,
		    	getPdfDataDailyTill: this.getPdfDataDailyTill,
		    	getPdfDataDailyTillReportTerminal: this.getPdfDataDailyTillReportTerminal,
		    	getPdfMyDailyClosure: this.getPdfMyDailyClosure,
		    	getReservationPerRoutePdfData: this.getReservationPerRoutePdfData,
		    	datePickerHasChangedHandler: this.datePickerHasChangedHandler,
		    });
		},

		components: {
			Loading
		},

		computed: {
			search_cash_registers() {
				if(this.filteredCashRegister && this.available) {
					
					var start_date = this.$children[0].$children[0].attr.value;
					var end_date = this.$children[0].display ? this.$children[0].$children[1].attr.value : start_date;

					return _.filter(this.getCash, (cash) => {  return moment(cash.created_at).isBetween(start_date, end_date, undefined, '[]') });
				}

				return [];
			},

			search_trips() {
				if(this.filteredTrips && this.available) {
					
					var start_date = this.$children[0].$children[0].attr.value;
					var end_date = this.$children[0].display ? this.$children[0].$children[1].attr.value : start_date;
					var trips = _.filter(this.getTrips, (trip) => {  return moment(trip.date).isBetween(start_date, end_date, undefined, '[]') });
					trips = _.uniqBy(trips,'route_id')
					return trips;
				}

				return [];
			}
		},

		watch: {
			search_cash_registers(val) {
				this.filtered_cash_registers = val;
			},

			search_trips(val) {
				console.log(val);
				this.filtered_trips = val;
			},
		},

		mounted() {
			setTimeout(() => {
				this.available = true;
			}, 1000)
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

			getPdfDataDailyTillReportTerminal() {
				this.loading = true;

				var office_id = this.$children[0].selected;
				var date_type = this.$children[1].display;
				var start_date = document.getElementById("start_date").value;
				var end_date = date_type ? document.getElementById("end_date").value : null;
				var url = this.searchUrl+'/'+office_id+'/'+date_type+'/'+start_date+'/'+end_date;
				this.fetch(url);
			},

			getPdfMyDailyClosure() {
				this.loading = true;

				var date_type = this.$children[0].display;
				var start_date = document.getElementById("start_date").value;
				var end_date = date_type ? document.getElementById("end_date").value : null;
				var cash_box = this.$children[1].selected;
				var url = this.searchUrl+'/'+date_type+'/'+start_date+'/'+end_date+'/'+cash_box;
				this.fetch(url);
			},


			getPdfMyDailyClosure() {
				this.loading = true;

				var date_type = this.$children[0].display;
				var start_date = document.getElementById("start_date").value;
				var end_date = date_type ? document.getElementById("end_date").value : null;
				var cash_box = this.$children[1].selected;
				var url = this.searchUrl+'/'+date_type+'/'+start_date+'/'+end_date+'/'+cash_box;
				this.fetch(url);
			},

			getReservationPerRoutePdfData() {
				this.loading = true;

				var date_type = this.$children[0].display;
				var start_date = document.getElementById("start_date").value;
				var end_date = date_type ? document.getElementById("end_date").value : null;
				var trip_ids = this.$children[1].selected;
				var url = this.searchUrl+'/'+date_type+'/'+start_date+'/'+end_date+'/'+trip_ids;
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
			},

			datePickerHasChangedHandler(payloads) {
				console.log(payloads)
			}
		}
	}
</script>>