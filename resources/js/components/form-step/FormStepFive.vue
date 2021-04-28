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
							<option value="Others">Others</option>
						</select>
					</div>
					<div class="col-span-full sm:col-span-full">
						<label for="cash" class="block font-medium font-semibold text-gray-500">Cash</label>
						<input type="number" name="cash" v-model="payment.cash" min="0" step="any" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent">
					</div>
					<div class="col-span-full sm:col-span-full">
						<label for="cash" class="block font-medium font-semibold text-gray-500">Refunded Amount: {{ refundedAmount }}</label>
					</div>
				</div>
			</div>

			<div class="bg-gradient-to-r col-span-1 from-darkblue ml-20 rounded-lg sm:col-span-1 text-center to-darkblue via-lightblue w-8/12">
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
			<div class="col-span-1 sm:col-span-1">
				<button tabindex="3" type="button" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out sm:leading-8" @click="nextFormHandler">
				    Pay
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
					cash: this.$parent.price.maximum_price,
				},
				code: null,

				voucher: null,
				discount: 0
			}
		},

		computed: {
			refundedAmount() {
				return 0;
			},

			totalSale() {
				var total = 0;
				var price = this.$parent.price;
				var ticket_type = this.$parent.passenger_info.ticket_type;

				if(ticket_type.discount_type == 'Percentage') {
					total = parseFloat(ticket_type.discount) / 100;
					total = this.payment.cash - total;
				} else {
					total = this.payment.cash - parseFloat(ticket_type.discount);
				}

				if(!_.isEmpty(this.voucher)) {
					switch(this.voucher.type_of_voucher) {
						case 'Max. Ticket % Discount': 
							total = this.discount * total;
							break;
						default: 
							total = total - this.discount;
							break;
					}
				}

				return total;
			},

			disabledNextButton() {
				return true;
			}
		},

		methods: {

			nextFormHandler() {

				this.$parent.payment = this.payment;
				this.$parent.totalSale = this.totalSale;
				this.$parent.voucher = this.voucher;
				
				this.$emit('nextStep', 6);
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
						this.voucher = response.data.voucher;
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