<template>
	<div>
		<div class="grid grid-cols-2 gap-2 pl-4">
			<div class="col-span-1 sm:col-span-1">

				<div class="grid grid-cols-1 gap-1">
					<div class="col-span-full sm:col-span-full">
						<label for="payment_method" class="block font-medium font-semibold text-gray-500">Do you want to print the Tickets sold?</label>
						<select name="payment_method" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-model="action">
							<option value="Yes">Yes, Print and Notify via SMS</option>
							<option value="NO">No, Notify via SMS the passenger</option>
						</select>
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
				<button tabindex="3" type="button" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out sm:leading-8" @click="paymentFormHandler">
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
				action: 'Yes'
			}
		},

		methods: {
			paymentFormHandler() {
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
				}

				axios.post(this.$parent.paymentFormUrl, payloads)
					.then(response => {

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