<template>
	<div>
		<div class="grid grid-cols-2 gap-2 pl-4">
			<div class="col-span-1 sm:col-span-1">
				<div class="grid grid-cols-1 gap-1">
					<div class="col-span-full sm:col-span-full">
						<label for="payment_method" class="block font-medium font-semibold text-gray-500">Payment Method</label>
						<select name="payment_method" v-model="payment.payment_method" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent">
							<option value="Cash">Cash</option>
							<option value="Credit Card">Credit Card</option>
							<option value="Reservation">Reservation</option>
							<option value="External Credit Card">External Credit Card</option>
						</select>
					</div>
					<div class="col-span-full sm:col-span-full"  v-if="payment.payment_method == 'Cash'">
						<label for="cash" class="block font-medium font-semibold text-gray-500">Cash</label>
						<input type="number" name="cash" v-model="payment.cash" min="0" :min="totalSale" step="any" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent">
					</div>
					<div class="col-span-full sm:col-span-full"  v-if="payment.payment_method == 'External Credit Card'">
						<label for="cash" class="block font-medium font-semibold text-gray-500">Transaction Number/Reference Number</label>
						<input type="text" name="transaction_no" v-model="payment.transaction_number" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent">
					</div>
					<div class="col-span-full sm:col-span-full"  v-if="payment.payment_method == 'Cash'">
						<label for="cash" class="block font-medium font-semibold text-gray-500">Refunded Amount: {{ refundedAmount }}</label>
					</div>
					
				</div>
			</div>

			<div class="bg-gradient-to-r col-span-1 from-darkblue ml-20 rounded-lg sm:col-span-1 text-center to-darkblue via-lightblue w-8/12 h-48">
				<p class="font-medium mt-5 mx-auto text-2xl text-white">Total Sale</p>
				<p class="font-bold text-5xl text-white">$ {{ totalSale }}</p>

				<div class="bg-white gap-1 grid grid-cols-3 mt-4 mx-auto p-1 rounded w-60">
					<div class="col-span-2 sm:col-span-2">
						<input type="text" placeholder="Apply Discount" class="rounded border-transparent duration-150 ease-in-out form-input outline-none w-full" v-model="code">
					</div>
					<div class="col-span-1 sm:col-span-1">
						<button tabindex="3" type="button" class="active:bg-lighterblue bg-lightblue border border-transparent flex focus:shadow-outline-lighterblue h-9 hover:bg-lighterblue justify-center mt-0.5 mx-auto my-auto px-4 py-2 rounded text-sm text-white w-full" @click="validateCoupon">
						    Apply
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="gap-4 grid grid-cols-6 pl-4 mt-5">
			<div class="col-span-1 sm:col-span-1">
				<button tabindex="3" type="button" class="w-full flex justify-center py-2 px-4 border border-lighterblue text-sm font-medium rounded text-black bg-transparent hover:bg-lighterblue hover:text-white focus:outline-none focus:border-transparent focus:shadow-outline-transparent active:bg-transparent focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out sm:leading-8" @click="$emit('backToForm', 4)">
				    Back
				</button>
			</div>
			<div class="col-span-1 sm:col-span-1" v-if="!disabledNextButton">
				<button tabindex="3" type="button" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out sm:leading-8" @click="nextFormHandler">
				    {{ btnLabel }}
				</button>
			</div>
		</div>

	</div>
</template>
<script type="text/javascript">
	export default {
		data() {
			return {
				payment: {
					payment_method: 'Cash',
					cash: 0,
				},
				code: null,

				voucher: null,
				discount: 0,

				edit: this.$parent.edit
			}
		},

		computed: {
			refundedAmount() {
				return this.payment.cash - this.totalSale;
			},

			totalSale() {
				var totalDiscount = 0;
				var price = this.$parent.price;
				var ticket_type = this.$parent.passenger_info.ticket_type;
				var totalSale = 0;
				// var totalSale = parseFloat(this.$parent.price.departure_price) + parseFloat(this.$parent.price.arrival_price);

				switch(this.$parent.payloads.type_of_ticket) {
					case 'adult':
						totalSale = parseFloat(this.$parent.price.adult_one_way);
						break;
					case 'senior':
						totalSale = parseFloat(this.$parent.price.senior_one_way);
						break;
					case 'child':
						totalSale = parseFloat(this.$parent.price.child_one_way);
						break;

				}



				if(ticket_type.discount_type == 'Percentage') {
					totalDiscount = parseFloat(ticket_type.discount) / 100;
					// totalDiscount = this.payment.cash - totalDiscount;
				} else {
					totalDiscount = parseFloat(ticket_type.discount);
				}

				if(!_.isEmpty(this.voucher)) {
					switch(this.voucher.coupon_type) {
						case 'Percentage': 
							totalDiscount = this.discount * totalDiscount;
							break;
						default: 
							totalDiscount = totalDiscount - this.discount;
							break;
					}
				}


				// check if max baggage is exceed
				
				if(this.$parent.payloads.trip.max_baggage < this.$parent.passenger_info.no_of_bags) {
					totalSale = totalSale + ((this.$parent.passenger_info.no_of_bags - this.$parent.payloads.trip.max_baggage) * parseFloat(this.$parent.payloads.trip.additional_bag_fee));
				}
					// console.log(totalSale - totalDiscount, totalSale, totalDiscount);

				totalSale = totalSale - totalDiscount;

				this.payment.cash = totalSale;
				return totalSale.toFixed(2);
			},

			disabledNextButton() {

				if(parseInt(this.payment.cash) >= parseInt(this.totalSale) && this.payment.payment_method == 'Cash') {
					return false;
				}

				if(this.payment.payment_method == 'External Credit Card' && this.payment.transaction_number) {
					return false;
				}

				if(this.payment.payment_method == 'Credit Card' || this.payment.payment_method == 'Reservation') {
					return false;
				}

				return true;
			},

			btnLabel() {
				if(this.edit) {
					return 'Save';
				}

				if(this.payment.payment_method == 'Cash' && this.payment.payment_method == 'Credit Card') {
					return 'Next';
				} else {
					return 'Pay';
				}
			}
		},

		mounted() {
			if(this.$parent.edit) {
				this.payment = this.$parent.selectedTicket;
				this.code = this.$parent.selectedTicket.code;
			} else {
				this.payment = !_.isEmpty(this.$parent.payment) ? this.$parent.payment : this.payment; 
				this.voucher = !_.isEmpty(this.$parent.voucher) ? this.$parent.voucher : this.voucher;
			}
		},

		methods: {

			nextFormHandler() {

				if(!this.edit) {
					this.$parent.payment = this.payment;
					this.$parent.totalSale = this.totalSale;
					this.$parent.voucher = this.voucher;
					

					if(this.payment.payment_method == 'Reservation' || this.payment.payment_method == 'External Credit Card' || this.payment.payment_method == 'Credit Card') {
						this.$parent.loading = true;

						var payloads = {
							passenger: this.$parent.passenger_info,
							bus_model_column_id: this.$parent.seat_selected.id,
							trip_id: this.$parent.payloads.trip_id,
							arrival_id: this.$parent.payloads.arrival_id,
							departure_id: this.$parent.payloads.departure_id,
							payment_method: this.$parent.payment.payment_method,
							total_sale: this.$parent.totalSale,
							has_voucher: !_.isEmpty(this.$parent.voucher),
							voucher_code: !_.isEmpty(this.$parent.voucher) ? this.$parent.voucher.code : this.$parent.voucher,
							action: this.payment.payment_method,

							trip_time_id: this.$parent.payloads.time_id,
							driver_id: this.$parent.payloads.driver_id,
							type_of_ticket: this.$parent.payloads.type_of_ticket,
							transaction_number: this.payment.transaction_number,
						}

						axios.post(this.$parent.paymentFormUrl, payloads)
							.then(response => {
								this.$parent.showModal = true;
								this.$parent.modalMessage = 'Link sent to customer';

								if(this.payment.payment_method != 'Credit Card') {
									this.$parent.modalTitle = 'Reservation success.';
									// this.$parent.$parent.toggled();
									this.$parent.step = 1;
									this.$parent.payloads = {};
									this.$parent.price = {};
									this.$parent.availableTrip = {};
									this.$parent.bus = [];
									this.$parent.seat_selected = {};
									this.$parent.passenger_info = {};
									this.$parent.payment = {};
									this.$parent.voucher = null;
									this.$parent.totalSale = 0;
									this.$parent.bus_info = [];
									this.$parent.$parent.$parent.$children[3].fetch();
								} else {
									var $this = this;
									
									this.$parent.modalTitle = 'Payment link sent success.';
									this.$parent.channel = this.$parent.pusher.subscribe('ticketPayment-'+ response.data.ticket.id);

									this.$parent.channel.bind('paidEvent', function(data) {
									  	console.log('payment success')

									  	if(data.success) {
								  			$this.$parent.showModal = true;
								  			$this.$parent.modalMessage = 'Passenger ticket is now paid.';
								  			$this.$parent.modalTitle = 'Ticket paid';
								  			$this.$parent.paidTicket = data.ticket;

								  		  	$this.$emit('nextStep', 6);
									  	}
									});
								}

								this.$parent.loading = false;
							}).catch(errors => {
								this.$parent.loading = false;
							})
					} else {
						this.$emit('nextStep', 6);
					}
				} else {
					axios.post(this.$parent.updateUrl, this.$parent.selectedTicket)
						.then(response => {
							this.$parent.$parent.toggled();
							// this.$parent.$parent.$parent.fetch();
						}).catch(errors => {
							
						})
				}
			},

			validateCoupon() {
				this.$parent.loading = true;

				var payload = {
					code: this.code,
					trip_date: this.$parent.payloads.trip.date,
					route_id: this.$parent.payloads.trip.route_id,
					passenger: this.$parent.passenger_info.first_name+' '+this.$parent.passenger_info.last_name
				}
				axios.post(this.$parent.voucherValidateUrl, payload)
					.then(response => {
						this.$parent.loading = false;
						this.voucher = response.data.coupon;
						this.discount = response.data.discount;
						this.$parent.showModal = true;
						this.$parent.modalMessage = response.data.message; 
						this.$parent.modalTitle = response.data.title; 
					}).catch(errors => {
						this.$parent.loading = false;
					})
			}


			// paymentFormHandler() {
			// 	var payloads = {
			// 		passenger: this.$parent.passenger_info,
			// 		bus_model_column_id: this.$parent.seat_selected.id,
			// 		trip_id: this.$parent.payloads.trip_id,
			// 		arrival_id: this.$parent.payloads.arrival_id,
			// 		departure_id: this.$parent.payloads.departure_id,
			// 		payment_method: this.payment.payment_method,
			// 		total_sale: this.totalSale,
			// 	}

			// 	axios.post(this.$parent.paymentFormUrl, payloads)
			// 		.then(response => {
			// 			this.$parent.$parent.toggled();
			// 			this.$parent.$parent.$parent.$children[3].fetch();
			// 		}).catch(errors => {

			// 		})
			// }
		}
	}
</script>