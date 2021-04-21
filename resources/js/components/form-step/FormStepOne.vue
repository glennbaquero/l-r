<template>
	<div class="grid grid-cols-2 gap-2">
		<div class="col-span-1 sm:col-span-1">
		    <label for="departure" class="font-semibold">Departure</label>
		    <v-select
		    	class="my-3"
		        v-model="item.departure" 
		        :options="cities"
		        label="name"
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
				item: {}
			}
		},

		components: {
		    'v-select' : Vselect,
		},

		watch: {
			'item.departure'(val) {
				this.item.departure_id = val.id;
			},

			'item.arrival'(val) {
				this.item.arrival_id = val.id;
			}
		},

		computed: {
			disabledNextButton() {
				if(!_.isEmpty(this.item) && this.item.arrival_id && this.item.departure_id) return false;

				return true;
			}
		},

		methods: {
			closeModal() {
				this.$parent.$parent.toggled();
			},

			nextForm() {
				this.$parent.loading = true;
				axios.post(this.$parent.findAvailableTripUrl, this.item)
					.then(response => {
						
						this.$parent.availableTrip = response.data.trips;
						this.$parent.price = response.data.price;
						
						setTimeout(() => {
							this.$parent.payloads = this.item;
							this.$emit('nextStep', 2)
							this.$parent.loading = false;
						}, 500)
					}).catch(errors => {
						this.$parent.loading = false;
					})

			}
		}
	}
</script>