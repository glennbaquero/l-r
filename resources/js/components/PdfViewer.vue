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
		    	getPricePerRoutePdfData: this.getPricePerRoutePdfData,
		    	getIncomeByRoutePdfData: this.getIncomeByRoutePdfData,
		    	getSalesByDepartureArrivalPdfData: this.getSalesByDepartureArrivalPdfData,
		    	getSalesByTravelPdfData: this.getSalesByTravelPdfData,
		    	getSalesByVoucherPdfData: this.getSalesByVoucherPdfData,
		    	getSalesByTicketPdfData: this.getSalesByTicketPdfData,
		    	getSalesByCreditCardPdfData: this.getSalesByCreditCardPdfData,
		    	getSalesByStatePdfData: this.getSalesByStatePdfData,
		    	getPdfAccountReceivable: this.getPdfAccountReceivable,
		    	getSalesByAgencyPdfData: this.getSalesByAgencyPdfData,
		    	getBillingByTicketPdfData: this.getBillingByTicketPdfData,
		    	getPdfPassenger: this.getPdfPassenger,
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
			selectChanged(value, type, search_by=null) {
				switch(type) {
					case 'office_type':
						this.offices = _.filter(this.getOffices, (office) => { return office.office_type_id == value});
						break;
					case 'office':
						if(typeof value == 'object') {
							this.users = [];
							_.each(value, (office) => {
								_.each(this.getUsers, (user) => {
									if(user.office_id == office) {
										this.users.push(user)
									}
								});
							});
						} else {
							this.users = _.filter(this.getUsers, (user) => { return user.office_id == value});
						}
						break;
					case 'user_cash_registry':
						this.cash_registers = _.filter(this.getCash, (cash) => { return cash.user_id == value});
						break;

					case 'state':
						if(typeof value == 'object') {
							this.offices = [];
							_.each(value, (id) => {
								_.each(this.getOffices, (office) => {
									if(office[search_by] == id) {
										this.offices.push(office)
									}
								});
							});
						} else {
							this.offices = _.filter(this.getOffices, (office) => { return office[search_by] == value});
						} 
						break;
				}
			},

			getPdfData() {
				this.loading = true;

				var date_type = this.$children[3].display;
				var office_type_id = this.$children[0].selectedItem.id;
				var office_id = this.$children[1].selected;
				var user_ids = this.$children[2].selected
				var start_date = document.getElementById("start_date").value;
				var end_date = date_type ? document.getElementById("end_date").value : null;
				var url = this.searchUrl+'/'+user_ids+'/'+date_type+'/'+start_date+'/'+end_date;
				this.fetch(url);
			},

			getPdfDataDailyTill() {
				this.loading = true;

				var office_type_id = this.$children[0].selectedItem.id;
				var office_id = this.$children[1].selectedItem.id;
				var user_ids = this.$children[2].selected;
				var date_type = this.$children[3].display;
				var cash_register = _.isEmpty(this.$children[4].selectedItem) ? null : this.$children[4].selected;
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

			getPricePerRoutePdfData() {
				this.loading = true;

				var type_ids = this.$children[0].selected;
				var city_id = this.$children[1].selected;
				var url = this.searchUrl+'/'+city_id+'/'+type_ids;
				this.fetch(url);
			},

			getIncomeByRoutePdfData() {
				this.loading = true;

				var trip_ids = this.$children[0].selected;
				var bus_ids = this.$children[1].selected;
				var service_ids = this.$children[2].selected;
				var date_type = this.$children[3].display;
				var start_date = document.getElementById("start_date").value;
				var end_date = date_type ? document.getElementById("end_date").value : null;
				var url = this.searchUrl+'/'+trip_ids+'/'+bus_ids+'/'+service_ids+'/'+date_type+'/'+start_date+'/'+end_date;
				this.fetch(url);
			},

			getSalesByDepartureArrivalPdfData() {
				this.loading = true;

				var departure_ids = this.$children[0].selected;
				var arrival_ids = this.$children[1].selected;
				var ticket_type_ids = this.$children[2].selected;
				var genders = this.$children[3].selected;
				var date_type = this.$children[4].display;
				var start_date = document.getElementById("start_date").value;
				var end_date = date_type ? document.getElementById("end_date").value : null;
				var url = this.searchUrl+'/'+departure_ids+'/'+arrival_ids+'/'+ticket_type_ids+'/'+genders+'/'+date_type+'/'+start_date+'/'+end_date;
				this.fetch(url);
			},

			getSalesByTravelPdfData() {
				this.loading = true;

				var trip_ids = this.$children[0].selected;
				var terminal_ids = this.$children[1].selected;
				var service_ids = this.$children[2].selected;
				var date_type = this.$children[3].display;
				var start_date = document.getElementById("start_date").value;
				var end_date = date_type ? document.getElementById("end_date").value : null;
				var url = this.searchUrl+'/'+trip_ids+'/'+terminal_ids+'/'+service_ids+'/'+date_type+'/'+start_date+'/'+end_date;
				this.fetch(url);
			},

			getSalesByVoucherPdfData() {
				this.loading = true;

				var is_open = this.$children[0].display;
				var url = this.searchUrl+'/'+is_open;
				this.fetch(url);
			},

			getSalesByTicketPdfData() {
				this.loading = true;

				var office_ids = this.$children[0].selected;
				var user_ids = this.$children[1].selected;
				var ticket_type_ids = this.$children[2].selected;
				var ticket_status = this.$children[3].selected;
				var payment_type = this.$children[4].selected;
				var date_type = this.$children[5].display;
				var start_date = document.getElementById("start_date").value;
				var end_date = date_type ? document.getElementById("end_date").value : null;
				var url = this.searchUrl+'/'+office_ids+'/'+user_ids+'/'+ticket_type_ids+'/'+ticket_status+'/'+payment_type+'/'+date_type+'/'+start_date+'/'+end_date;
				this.fetch(url);
			},

			getSalesByCreditCardPdfData() {

				this.loading = true;

				var is_concept = this.$children[0].display;
				var office_id = this.$children[0].$children[0].selected;
				var date_type = this.$children[1].display;
				var start_date = document.getElementById("start_date").value;
				var end_date = date_type ? document.getElementById("end_date").value : null;
				var url = this.searchUrl+'/'+is_concept+'/'+office_id+'/'+date_type+'/'+start_date+'/'+end_date;
				this.fetch(url);
			},

			getSalesByStatePdfData() {

				this.loading = true;

				var state = this.$children[0].selected;
				var office_ids = this.$children[1].selected;
				var ticket_type_ids = this.$children[2].selected;
				var ticket_status = this.$children[3].selected;
				var payment_types = this.$children[4].selected;
				var date_type = this.$children[5].display;
				var start_date = document.getElementById("start_date").value;
				var end_date = date_type ? document.getElementById("end_date").value : null;
				var url = this.searchUrl+'/'+state+'/'+office_ids+'/'+ticket_type_ids+'/'+ticket_status+'/'+payment_types+'/'+date_type+'/'+start_date+'/'+end_date;
				this.fetch(url);
			},

			getPdfAccountReceivable() {

				this.loading = true;

				var office_id = this.$children[0].selected;
				var date_type = this.$children[1].display;
				var start_date = document.getElementById("start_date").value;
				var end_date = date_type ? document.getElementById("end_date").value : null;
				var url = this.searchUrl+'/'+office_id+'/'+date_type+'/'+start_date+'/'+end_date;
				this.fetch(url);
			},

			getSalesByAgencyPdfData() {

				this.loading = true;

				var terminal_ids = this.$children[0].selected;
				var office_ids = this.$children[1].selected;
				var date_type = this.$children[2].display;
				var start_date = document.getElementById("start_date").value;
				var end_date = date_type ? document.getElementById("end_date").value : null;
				var url = this.searchUrl+'/'+terminal_ids+'/'+office_ids+'/'+date_type+'/'+start_date+'/'+end_date;
				this.fetch(url);
			},

			getBillingByTicketPdfData() {

				this.loading = true;

				var date_type = this.$children[0].display;
				var start_date = document.getElementById("start_date").value;
				var end_date = date_type ? document.getElementById("end_date").value : null;
				var url = this.searchUrl+'/'+date_type+'/'+start_date+'/'+end_date;
				this.fetch(url);
			},

			getPdfPassenger(val, trip, route) {
				this.loading = true;
				var type = val;
				var trip = trip;
				var route = route;
				var date_type = this.$parent.display;
				var start_date = date_type ? this.$children[1].attr.value[0] : this.$children[1].attr.value;
				var end_date = date_type ? this.$children[1].attr.value[1] : null;
				var url = this.searchUrl+'/'+type+'/'+trip+'/'+route+'/'+date_type+'/'+start_date+'/'+end_date;
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