<template>
	<div>
		<div class="grid grid-cols-2 gap-2 pl-4">
			<div class="col-span-1 sm:col-span-1">

				<div class="grid grid-cols-1 gap-1">
					<div class="col-span-full sm:col-span-full">
						<label for="payment_method" class="block font-medium font-semibold text-gray-500">Do you want to print the Tickets sold?</label>
						<select name="payment_method" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-model="action">
							<option value="Print and email">Print and email/SMS</option>
							<option value="Print only">Print only</option>
							<option value="Confirmation only" v-if="$parent.payment.payment_method != 'Credit Card'">Confirmation only</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="gap-4 grid grid-cols-6 pl-4 mt-5">
			<div class="col-span-1 sm:col-span-1" v-if="$parent.payment.payment_method != 'Credit Card'">
				<button tabindex="3" type="button" class="w-full flex justify-center py-2 px-4 border border-lighterblue text-sm font-medium rounded text-black bg-transparent hover:bg-lighterblue hover:text-white focus:outline-none focus:border-transparent focus:shadow-outline-transparent active:bg-transparent focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out sm:leading-8" @click="$emit('backToForm', 5)">
				    Back
				</button>
			</div>
			<div class="col-span-1 sm:col-span-1">
				<button tabindex="3" type="button" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out sm:leading-8" @click="confirmationHandler">
				    Confirm
				</button>
			</div>
		</div>
	</div>
</template>
<script type="text/javascript">
	export default {
		name: 'FinalForm',

		data() {
			return {
				action: 'Print and email'
			}
		},

		methods: {
			confirmationHandler() {
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
					action: this.action,

					trip_time_id: this.$parent.payloads.time_id,
					driver_id: this.$parent.payloads.driver_id,
					type_of_ticket: this.$parent.payloads.type_of_ticket,
				}

				var url = this.$parent.paymentFormUrl;

				if(this.$parent.payment.payment_method == 'Credit Card') {
					payloads = {
						id: this.$parent.paidTicket.id,
						action: this.action
					}

					url = this.$parent.notifyPassengerUrl;
				}


				axios.post(url, payloads)
					.then(response => {

						if(response.data.ticket_info_url) {
							window.open(response.data.ticket_info_url,'_blank');
						}
						
						if(response.data.print_url) {
							window.open(response.data.print_url,'_blank');
						}

						this.$parent.$parent.toggled();
						this.$parent.$parent.$parent.$children[3].fetch();
					}).catch(errors => {
						this.$parent.loading = false;
					})

				
			}
		}
	}
</script>