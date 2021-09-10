<template>
	<div class="grid grid-cols-2 gap-2">
		<div class="col-span-full sm:col-span-full">
		    <label for="departure" class="font-semibold">Travel Date</label>
		    <v-select
		    	class="my-3"
		        v-model="item.trip" 
		        :options="availableTrips"
		        label="display_trip_name"
		        >
		    </v-select>
		</div>

		<div class="grid grid-cols-3 gap-4">
			<div class="col-span-1 sm:col-span-1">
				<button tabindex="3" type="button" class="w-full flex justify-center py-2 px-4 border border-lighterblue text-sm font-medium rounded text-black bg-transparent hover:bg-lighterblue hover:text-white focus:outline-none focus:border-transparent focus:shadow-outline-transparent active:bg-transparent focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out sm:leading-8" @click="$emit('backToForm', 1)">
				    Back
				</button>
			</div>
			<div class="col-span-1 sm:col-span-1">
				<button tabindex="3" type="button" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out sm:leading-8" @click="nextFormHandler" :disabled="disabledNextButton">
				    Next
				</button>
			</div>
		</div>

		<div class="grid grid-cols-3 gap-4">
			<div class="col-span-full sm:col-span-full text-right">
				<label for="departure" class="font-semibold">Price: {{ totalPrice }}</label>
			</div>
		</div>
	</div>
</template>
<script type="text/javascript">
	import Vselect from "vue-select";
	import "vue-select/dist/vue-select.css";

	export default {

		props: {
			trips: Array
		},

		data() {
			return {
				item: {}
			}
		},

		components: {
		    'v-select' : Vselect,
		},

		computed: {
			disabledNextButton() {
				if(!_.isEmpty(this.item) && this.item.trip_id) return false;

				return true;
			},

			availableTrips() {
				var trips = [];

				_.each(this.trips, (trip) => {
					_.each(trip.trips, (availableTrips) => {
						trips.push(availableTrips);
					})
				})

				return trips;
			},

			totalPrice() {
				if(!_.isEmpty(this.$parent.price.price)) {
					let total = 0;

					total = parseFloat(this.$parent.price.departure_price) + parseFloat(this.$parent.price.arrival_price);

					return total.toFixed(2);
				}

				return "0.00";
			}
		},

		watch: {
			'item.trip'(val) {
				this.item.trip_id = val.id;
			},
		},

		methods: {
			nextFormHandler() {
				axios.post(this.$parent.fetchBusUrl, this.item)
					.then(response => {
						this.$parent.bus = response.data.bus_model;

						setTimeout(() => {
							this.$parent.payloads.trip = this.item.trip;
							this.$parent.payloads.trip_id = this.item.trip_id;

							this.$emit('nextStep', 3);
						}, 500)
					}).catch(error => {

					})
				
			}
		}

	}
</script>