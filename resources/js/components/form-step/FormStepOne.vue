<template>
	<div class="grid grid-cols-2 gap-2">
		<div class="col-span-1 sm:col-span-1">
		    <label for="departure" class="font-semibold">Departure</label>
		    <v-select
		    	class="my-3"
		        v-model="item.departure" 
		        :options="cities"
		        label="name"
			    @input="selectedChanged"
		        >
		    </v-select>
		</div>
		<div class="col-span-1 sm:col-span-1">
		    <label for="departure" class="font-semibold">Arrival</label>
		    <v-select
		    	class="my-3"
		        v-model="item.arrival" 
		        :options="cities"
		        label="name"
			    @input="selectedChanged"
		        >
		    </v-select>
		</div>

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
				<button tabindex="3" type="button" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out sm:leading-8" @click="nextForm" :disabled="disabledNextButton">
				    Next
				</button>
			</div>
			<div class="col-span-1 sm:col-span-1">
				<button tabindex="3" type="button" class="w-full flex justify-center py-2 px-4 border border-lighterblue text-sm font-medium rounded text-black bg-transparent hover:bg-lighterblue hover:text-white focus:outline-none focus:border-transparent focus:shadow-outline-transparent active:bg-transparent focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out sm:leading-8" @click="closeModal">
				    Cancel
				</button>
			</div>
		</div>
		
	</div>
</template>
<script type="text/javascript">
	import Vselect from "vue-select";
	import "vue-select/dist/vue-select.css";

	export default {
		props: {
			cities: Array
		},

		data() {
			return {
				item: {
					trip: {}
				},
				trips: [],

				canEdit: false,
				disabled: false
			}
		},

		components: {
		    'v-select' : Vselect,
		},

		watch: {
			'item.departure'(val) {
				if(this.canEdit) {
					this.item.departure_id = val.id;
				}
			},

			'item.arrival'(val) {
				if(this.canEdit) {
					this.item.arrival_id = val.id;
				}
			},

			'item.trip'(val) {
				this.item.trip_id = val.id;
			},
		},

		computed: {
			disabledNextButton() {
				if(!_.isEmpty(this.item) && this.item.arrival_id && this.item.departure_id && !_.isEmpty(this.item.trip)) return false;

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
			}
		},

		mounted() {
			if(!_.isEmpty(this.$parent.selectedTicket)) {
				this.item = this.$parent.selectedTicket
				this.selectedChanged();
			}
			
			setTimeout(() => {
				this.canEdit = true;
			}, 500)
		},

		methods: {
			closeModal() {
				this.$parent.$parent.toggled();
			},

			nextForm() {
				var bus_finder_payloads = {
					trip: this.item.trip,
					trip_id: this.item.trip.id,
					departure_id: this.item.departure_id,
					arrival_id: this.item.arrival_id,
				}

				// if(_.isEmpty(this.$parent.selectedTicket)) {

					this.$parent.loading = true;

					axios.post(this.$parent.fetchBusUrl, bus_finder_payloads)
						.then(response => {
							this.$parent.bus = response.data.bus_model;

							setTimeout(() => {
								this.$parent.payloads = this.item;
								this.$parent.payloads.trip = this.item.trip;
								this.$parent.payloads.trip_id = this.item.trip_id;

								this.$emit('nextStep', 3);
								this.$parent.loading = false;
							}, 500)
						}).catch(error => {
							this.$parent.loading = false;
						})
				// } else {
				// 	this.$emit('nextStep', 3);
				// }

				// axios.post(this.$parent.findAvailableTripUrl, this.item)
				// 	.then(response => {
						
				// 		this.$parent.availableTrip = response.data.trips;
				// 		this.$parent.price = response.data.price;
						
				// 		setTimeout(() => {
				// 			this.$parent.payloads = this.item;
				// 			this.$emit('nextStep', 2)
				// 			this.$parent.loading = false;
				// 		}, 500)
				// 	}).catch(errors => {
				// 		this.$parent.loading = false;
				// 	})

			},

			selectedChanged() {
				this.$parent.loading = true;
				axios.post(this.$parent.findAvailableTripUrl, this.item)
					.then(response => {
						
						this.trips = response.data.trips;
						this.$parent.availableTrip = response.data.trips;
						this.$parent.price = response.data.price;
						this.$parent.loading = false;
						
					}).catch(errors => {
						this.$parent.loading = false;
						this.$parent.modalMessage = errors.response.data.errors.error[0];
						this.$parent.modalTitle = 'Ooops! Something went wrong.';
						this.$parent.showModal = true;
					})
			}
		}
	}
</script>