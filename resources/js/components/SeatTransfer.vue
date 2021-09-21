<template>
	<div class="px-4 py-5 sm:p-6">
		<div class="grid grid-cols-3 gap-3">
			<div class="col-span-1 sm:col-span-1">
				<div class="hidden sm:block ml-16 px-5">
				    <nav class="flex">
				        <a href="#" @click="selectedType('Route')" class="border duration-150 ease-in-out focus:outline-none inline-flex items-center leading-6 px-6 py-3 rounded-l-md text-base  text-sm transition" :class="type == 'Route' ? 'bg-green-600 text-gray-50' : 'bg-gray-200 text-black'">
				            Route
				        </a>
				        <a href="#" @click="selectedType('Alias')" class="duration-150 ease-in-out focus:outline-none focus:shadow-outline-blue inline-flex items-center leading-6 px-6 py-3 rounded-r-md text-base text-sm transition" :class="type == 'Alias' ? 'bg-green-600 text-gray-50' : 'bg-gray-200 text-black'">
				            Alias
				        </a>
				    </nav>
				</div>
			</div>
			<div class="col-span-1 sm:col-span-1">
				<label class="block font-medium text-sm text-gray-700">Departure:</label>
				<v-select
					class="my-3"
				    v-model="selected.departure" 
				    :options="cities"
				    label="name"
				    >
				</v-select>
			</div>
			<div class="col-span-1 sm:col-span-1">
				<label class="block font-medium text-sm text-gray-700">Arrival:</label>
				<v-select
					class="my-3"
				    v-model="selected.arrival" 
				    :options="cities"
				    label="name"
				    >
				</v-select>

			</div>
			<div class="col-start-2 sm:col-start-2">
				
				<label class="block font-medium text-sm text-gray-700">Travel Origin:</label>

				<vue2-datepicker v-if="!show.travelOriginList" v-model="travelOrigin.date" type="date" format="YYYY-MM-DD" input-class="form-input w-full mx-auto my-3 py-2 px-3 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-gray-300" @change="getOriginTrip"></vue2-datepicker>

				<v-select
					v-if="show.travelOriginList"
					class="my-3"
				    v-model="selectedTravel.origin" 
				    :options="travelOrigin.trip"
				    label="display"
				    >
				</v-select>
			</div>
			<div class="col-span-1 sm:col-span-1">
				<label class="block font-medium text-sm text-gray-700">Travel Destination:</label>

				<vue2-datepicker v-if="!show.travelDestinationList" v-model="travelDestination.date" type="date" format="YYYY-MM-DD" input-class="form-input w-full mx-auto my-3 py-2 px-3 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-gray-300" @change="getDestinationTrip"></vue2-datepicker>

				<v-select
					v-if="show.travelDestinationList"
					class="my-3"
				    v-model="selectedTravel.destination" 
				    :options="travelDestination.trip"
				    label="display"
				    >
				</v-select>
			</div>
		</div>
		<div class="grid grid-cols-12 gap-6">

			<!-- Origin Bus Model -->
			<div class="col-span-5 sm:col-span-5">
				<label>{{ selectedTravel.origin.display }}</label>

				<div class="mt-5 px-4 py-4 rounded-md text-center" v-if="bus.origin.length">
					<div class="gap-2 grid grid-cols-4">

						<div class="border px-4 py-4 col-span-full rounded-md w-full shadow-md">
							<table class="w-full">
								<tr v-for="row in bus.origin" class="h-10">
								    <td v-for="column in row" class=" bg-center bg-contain bg-no-repeat h-5 pr-10 w-5" :style="{ backgroundImage: 'url(' + column.image_path + ')', transform: 'rotate('+column.orientation+'deg)', cursor: column.label != '' ? 'pointer' : '' }" @click="selectSeat('origin', column)">
								    	<label :class="column.label != '' ? 'cursor-pointer' : ''" class="bg-transparent border-transparent focus:border-blue-300 font-black px-0 py-0 rounded shadow-sm text-black text-center transition w-5" @click="selectSeat('origin', column)">
								    		{{ column.label }}
								    	</label>
								    </td>
								</tr>
							</table>
						</div>

				        <div class="col-span-1 sm:col-span-1 mt-3">
			                <div class="bg-gray-300 col-span-1 h-3 mx-auto my-auto rounded-xl w-3"></div>
			                <label> Available</label>
				        </div>
				        <div class="col-span-1 sm:col-span-1 mt-3">
			                <div class="bg-green-400 col-span-1 h-3 mx-auto my-auto rounded-xl w-3"></div>
			                <label> Reserved</label>
				        </div>
				        <div class="col-span-1 sm:col-span-1 mt-3">
			                <div class="bg-red-400 col-span-1 h-3 mx-auto my-auto rounded-xl w-3"></div>
			                <label> Sold</label>
				        </div>
				        <div class="col-span-1 sm:col-span-1 mt-3">
			                <div class="bg-yellow-400 col-span-1 h-3 mx-auto my-auto rounded-xl w-3"></div>
			                <label>Double Sold</label>
				        </div>

				        <div class="col-span-full sm:col-span-full">
				        	<button class="bg-lighterblue text-gray-50 duration-150 ease-in-out focus:outline-none focus:shadow-outline-blue inline-flex items-center leading-6 px-6 py-3 rounded-md text-base text-sm transition" @click="showPassengerListHandler('origin')">
				        	    Sold Tickets
				        	</button>
				        </div>

				        
						
					</div>
				</div>
			</div>

			<!-- Transfer Buttons -->
			<div class="col-span-2 sm:col-span-2 text-center">
				<template v-if="bus.destination.length && bus.origin.length && !selectedSeat.destination.is_reserved && selectedSeat.origin.is_reserved">
					<p class="mt-24">Origin to Destination</p>
					<button class="bg-green-600 text-gray-50 border py-3 rounded text-xs w-full"  @click="transferSeat('origin')">
						{{ transferOriginToDestinationButtonLabel }}
					</button>
				</template>
				<template v-if="bus.destination.length && bus.origin.length && !selectedSeat.origin.is_reserved && selectedSeat.destination.is_reserved">
					<p class="mt-24">Destination to Origin</p>
					<button class="bg-gray-200 text-black border py-3 rounded text-xs w-full"  @click="transferSeat('destination')">
						{{ transferDestinationToOriginButtonLabel }}
					</button>
				</template>
				
			</div>

			<!-- Destination Bus Model -->
			<div class="col-span-5 sm:col-span-5">
				<label>{{ selectedTravel.destination.display }}</label>
				<div class="mt-5 px-4 py-4 rounded-md text-center" v-if="bus.destination.length">
					<div class="gap-2 grid grid-cols-4">

						<div class="border px-4 py-4 col-span-full rounded-md w-full shadow-md">
							<table class="w-full">
								<tr v-for="row in bus.destination" class="h-10">
								    <td v-for="column in row" class="bg-center bg-contain bg-no-repeat h-5 pr-10 w-5" :style="{ backgroundImage: 'url(' + column.image_path + ')', transform: 'rotate('+column.orientation+'deg)', cursor: column.label != '' ? 'pointer' : '' }" @click="selectSeat('destination', column)">
								    	<label :class="column.label != '' ? 'cursor-pointer' : ''" class="bg-transparent border-transparent focus:border-blue-300 font-black px-0 py-0 rounded shadow-sm text-black text-center transition w-5" @click="selectSeat('destination', column)">
								    		{{ column.label }}
								    	</label>
								    </td>
								</tr>
							</table>
						</div>

				        <div class="col-span-1 sm:col-span-1">
			                <div class="bg-gray-300 col-span-1 h-3 mx-auto my-auto rounded-xl w-3"></div>
			                <label> Available</label>
				        </div>
				        <div class="col-span-1 sm:col-span-1">
			                <div class="bg-green-400 col-span-1 h-3 mx-auto my-auto rounded-xl w-3"></div>
			                <label> Reserved</label>
				        </div>
				        <div class="col-span-1 sm:col-span-1">
			                <div class="bg-red-400 col-span-1 h-3 mx-auto my-auto rounded-xl w-3"></div>
			                <label> Sold</label>
				        </div>
				        <div class="col-span-1 sm:col-span-1">
			                <div class="bg-yellow-400 col-span-1 h-3 mx-auto my-auto rounded-xl w-3"></div>
			                <label>Double Sold</label>
				        </div>
				        <div class="col-span-full sm:col-span-full">
				        	<button class="bg-lighterblue text-gray-50 duration-150 ease-in-out focus:outline-none focus:shadow-outline-blue inline-flex items-center leading-6 px-6 py-3 rounded-md text-base text-sm transition" @click="showPassengerListHandler('destination')">
				        	    Sold Tickets
				        	</button>
				        </div>
						
					</div>
				</div>
			</div>
			
		</div>

		<div class="grid grid-cols-12 gap-3">
			<div class="col-span-6 sm:col-span-6">
				<passenger-list
					v-if="showPassengerList.origin"
					:tickets="selectedTravel.origin.tickets"
				></passenger-list>
			</div>
			<div class="col-span-6 sm:col-span-6">
				<passenger-list
					v-if="showPassengerList.destination"
					:tickets="selectedTravel.destination.tickets"
				></passenger-list>
			</div>
		</div>
		<modal
			:bodyMessage="modalMessage"
			:headerTitle="modalTitle"
			:show="showModal"
			@closeModal="showModal = false"
		></modal>

		<loading :show="loading"></loading>
	</div>
</template>

<script type="text/javascript">
	import Vselect from "vue-select";
	import "vue-select/dist/vue-select.css";
	import Vue2DatePicker from 'vue2-datepicker';
  	import 'vue2-datepicker/index.css';
	import Modal from './Modal.vue';
	import PassengerList from './seat-transfer/PassengerList.vue';
	import Loading from './Loading.vue';

	export default {
		name: 'SeatTransfer',

		props: {
			fetchTripUrl: String,
			destinationFetchUrl: String,
			generateBusUrl: String,
			seatUpdateUrl: String,
			cities: Array
		},

		data() {
			return {
				type: 'Route',
				selected: {
					origin: null,
					departure: null,
				},

				travelOrigin: {
					date: null,
					trip: null
				},

				travelDestination: {
					date: null,
					trip: null
				},

				show: {
					travelDestinationList: false,
					travelOriginList: false,
				},

				selectedTravel: {
					origin: {
						display: null
					},
					destination: {
						display: null
					},
				},

				bus: {
					origin: [],
					destination: []
				},

				selectedSeat: {
					origin: {},
					destination: {}
				},

				showModal: false,
				modalMessage: null,
				modalTitle: null,

				showPassengerList: {
					origin: false,
					destination: false
				},

				loading: false
			}
		},

		components: {
		    'v-select' : Vselect,
		    'vue2-datepicker': Vue2DatePicker,
		    Modal,
		    PassengerList,
		    Loading,
		},

		computed: {
			formattedDateOrigin() {
				var date =  moment(this.travelOrigin.date).format('YYYY-MM-DD');
				return date;
			},
			formattedDateDestination() {
				var date =  moment(this.travelDestination.date).format('YYYY-MM-DD');
				return date;
			},

			transferOriginToDestinationButtonLabel() {
				if(!_.isEmpty(this.selectedSeat.origin) && !_.isEmpty(this.selectedSeat.destination)) {
					return "Transfer seat " + this.selectedSeat.origin.label +" to seat "+ this.selectedSeat.destination.label;
				}
				return 'Select a seat';

			},

			transferDestinationToOriginButtonLabel() {
				if(!_.isEmpty(this.selectedSeat.origin) && !_.isEmpty(this.selectedSeat.destination)) {
					return "Transfer seat "+ this.selectedSeat.destination.label  +" to seat "+ this.selectedSeat.origin.label;
				}
				
				return 'Select a seat';
			}

		},

		watch: {
			'selectedTravel.origin'(val) {
				if(!val) {
					this.selectedTravel.origin = {
						display: null
					}

					this.travelOrigin.date = null

					this.show.travelOriginList = false;
					this.bus.origin = [];
				} else {
					this.generateBus(val, 'origin');
				}

			},

			'selectedTravel.destination'(val) {
				if(!val) {
					this.selectedTravel.destination = {
						display: null
					}

					this.travelDestination.date = null

					this.show.travelDestinationList = false;
					this.bus.destination = [];
				} else {
					this.generateBus(val, 'destination');
				}
			}
		},

		methods: {
			selectedType(type) {
				this.type = type;
			},

			getOriginTrip() {
				this.loading = true;
				var payloads = {
					'type': 'origin',
					'id': this.selected.departure.id,
					'date': this.formattedDateOrigin
				};

				axios.post(this.fetchTripUrl, payloads)
					.then(response => {
						this.show.travelOriginList = !_.isEmpty(response.data.trips);
						this.travelOrigin.trip = response.data.trips;
						this.loading = false;
					}).catch(errors => {
						this.loading = false;
					})
			},

			getDestinationTrip() {
					this.loading = true;
				var payloads = {
					'type': 'departure',
					'id': this.selected.arrival.id,
					'date': this.formattedDateDestination
				};

				axios.post(this.fetchTripUrl, payloads)
					.then(response => {
						this.show.travelDestinationList = !_.isEmpty(response.data.trips);
						this.travelDestination.trip = response.data.trips;
						this.loading = false;
					}).catch(errors => {
						this.loading = false;
					})
			},

			generateBus(selected_trip, type) {
				this.loading = true;
				var payloads = {
					'trip_id': selected_trip.id
				}

				axios.post(this.generateBusUrl, payloads)
					.then(response => {
						this.bus[type] = response.data.bus_model;
						this.loading = false;
					}).catch(errors => {
						this.loading = false;
					})
			},

			selectSeat(travel, column) {
				this.selectedSeat[travel] = column;
			},


			transferSeat(from) {

				this.loading = true;

				if(this.selectedSeat.destination.is_reserved && from == 'origin') {
					this.modalTitle = 'Oooops!';
					this.modalMessage = 'Selected destination seat is not applicable for transfer, please select other available seat.';
					this.showModal = true;
					return;
				}

				if(this.selectedSeat.origin.is_reserved && from == 'destination') {
					this.modalTitle = 'Oooops!';
					this.modalMessage = 'Selected origin seat is not applicable for transfer, please select other available seat.';
					this.showModal = true;
					return;
				}

				var ticket = from == 'origin' ? this.selectedSeat.origin.ticket.id : this.selectedSeat.destination.ticket.id;

				var payloads = {
					'origin_seat_id': this.selectedSeat.origin.id,
					'destination_seat_id': this.selectedSeat.destination.id,
					'ticket': ticket,
					'from': from,
					'origin_trip_id': this.selectedTravel.origin.id, 
					'destination_trip_id': this.selectedTravel.destination.id, 

					'departure_id': this.selected.departure.id,
					'arrival_id': this.selected.arrival.id
				};


				axios.post(this.seatUpdateUrl, payloads)
					.then(response => {
						this.selectedSeat.destination = {}
						this.selectedSeat.origin = {}
						this.generateBus(this.selectedTravel.origin, 'origin');
						this.generateBus(this.selectedTravel.destination, 'destination');
						this.loading = false;
					}).catch(errors => {
						this.loading = false;
					})
			},

			showPassengerListHandler(type) {
				this.showPassengerList[type] = !this.showPassengerList[type];
			}
		}



	}
</script>