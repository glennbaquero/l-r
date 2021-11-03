<template>
	<div>
		<div class="text-center">
			<label>{{ bus_info }}</label>
		</div>
		<div class="px-4 py-4 rounded-md text-center">
			<div class="gap-4 grid grid-cols-3">
				<div class="border px-4 py-4 col-span-2 rounded-md w-full shadow-md">
					<table class="w-full">
						<tr v-for="row in bus_model" class="h-10">
						    <td v-for="column in row" class=" bg-center bg-contain bg-no-repeat h-5 w-5" :style="{ backgroundImage: 'url(' + column.image_path + ')', transform: 'rotate('+column.orientation+'deg)', cursor: column.label != '' ? 'pointer' : '' }" @click="selectedSeatHandler(column)">
						    	<label class="bg-transparent border-transparent focus:border-blue-300 font-black px-0 py-0 rounded shadow-sm text-black text-center transition w-5 text-xs">{{ column.label }}</label>
						    </td>
						</tr>
					</table>
				</div>
				<div class="col-span-1">
			        <div class="grid grid-cols-10 gap-4">
		                <div class="bg-gray-300 col-span-1 h-3 mx-auto my-auto rounded-xl w-3"></div>
		                <label> Available</label>
			        </div>
			        <div class="grid grid-cols-10 gap-4">
		                <div class="bg-green-400 col-span-1 h-3 mx-auto my-auto rounded-xl w-3"></div>
		                <label> Reserved</label>
			        </div>
			        <div class="grid grid-cols-10 gap-4">
		                <div class="bg-red-400 col-span-1 h-3 mx-auto my-auto rounded-xl w-3"></div>
		                <label> Sold</label>
			        </div>
			        <div class="grid grid-cols-12">
		                <div class="bg-yellow-400 col-span-1 h-3 my-auto rounded-xl w-3"></div>
		                <label class="col-span-5">Double Sold</label>
			        </div>
			        <div class="grid grid-cols-10 gap-4">
		                <div class="bg-lightblue col-span-1 h-3 mx-auto my-auto rounded-xl w-3"></div>
		                <label> Selected</label>
			        </div>
				</div>
			</div>
		</div>


		<div class="gap-4 grid grid-cols-6 pl-4">
			<div class="col-span-1 sm:col-span-1">
				<button tabindex="3" type="button" class="w-full flex justify-center py-2 px-4 border border-lighterblue text-sm font-medium rounded text-black bg-transparent hover:bg-lighterblue hover:text-white focus:outline-none focus:border-transparent focus:shadow-outline-transparent active:bg-transparent focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out sm:leading-8" @click="$emit('backToForm', 1)">
				    Back
				</button>
			</div>
			<div class="col-span-1 sm:col-span-1">
				<button tabindex="3" type="button" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out sm:leading-8" :disabled="disabledNextButton" @click="nextFormHandler">
				    Next
				</button>
			</div>
		</div>

		<div class="grid grid-cols-3 gap-4  col-start-3 sm:col-start-3">
			<div class="col-span-full sm:col-span-full text-right">
				<label for="departure" class="font-semibold">Price: {{ totalPrice }}</label>
			</div>
		</div>


		<passenger-info-modal 
			:passenger="passenger"
			:show="showModal"
			:ticket_types="ticket_types"
			@closeModal="showModal = false"
		></passenger-info-modal>

		<confirmation-modal
			:bodyMessage="confirmationModalMessage"
			:headerTitle="confirmationModalTitle"
			:show="showConfirmationModal"
			@closeModal="showConfirmationModal = false"
			:has-footer="true"
		>
			<template v-slot:footerButton>
				<div class="gap-2 grid grid-cols-2 pl-4">
					<div class="col-span-1 sm:col-span-1">
						<button tabindex="3" type="button" class="w-full flex justify-center py-2 px-4 border border-lighterblue text-sm font-medium rounded text-black bg-transparent hover:bg-lighterblue hover:text-white focus:outline-none focus:border-transparent focus:shadow-outline-transparent active:bg-transparent focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out sm:leading-8" @click="showConfirmationModal = false">
						    No
						</button>
					</div>
					<div class="col-span-1 sm:col-span-1">
						<button tabindex="3" type="button" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out sm:leading-8" @click="processSeat">
						    Yes
						</button>
					</div>
				</div>
			</template>
			
		</confirmation-modal>
	</div>

</template>
<script type="text/javascript">

	import PassengerInfoModal from './PassengerInfoModal.vue'
	import ConfirmationModal from '../Modal.vue';
	
	export default {
		props: {
			bus: Array
		},

		data() {
			return {
				bus_model: [],
				duplicated_bus_model: [],
				selected_seat: {},

				old_selected_seat: {},
				passenger: {},
				showModal: false,
				ticket_types: [],
				confirmationModalMessage: '',
				confirmationModalTitle: '',
				showConfirmationModal: false,

				item: null
			}
		},

		computed: {
			disabledNextButton() {
				if(this.$parent.edit) {
					return false;
				}

				if(!_.isEmpty(this.selected_seat)){ return false; }


				return true;
			},

			totalPrice() {
				if(!_.isEmpty(this.$parent.price)) {
					let total = 0;

					switch(this.$parent.payloads.type_of_ticket) {
						case 'adult':
							total = parseFloat(this.$parent.price.adult_one_way);
							break;
						case 'senior':
							total = parseFloat(this.$parent.price.senior_one_way);
							break;
						case 'child':
							total = parseFloat(this.$parent.price.child_one_way);
							break;

					}
					// total = parseFloat(this.$parent.price.departure_price) + parseFloat(this.$parent.price.arrival_price);

					return total.toFixed(2);
				}

				return "0.00";
			},

			bus_info() {
				return this.$parent.bus_info.name + "|" + this.$parent.bus_info.plate;
			}
		},


		components: {
			PassengerInfoModal,
			ConfirmationModal
		},

		mounted() {
			this.bus_model = this.bus;
		},

		methods: {
			selectedSeatHandler(item) {
				this.item = item;

				if(item.label != '' && !item.is_reserved) {
					_.each(this.bus_model, (row) => {
						_.each(row, (column) => {
							if(!_.isEmpty(this.old_selected_seat) && this.old_selected_seat.id === column.id) {
								column.image_path = this.old_selected_seat.image_path;
							}
						})
					})


					if(!item.image_path.includes('icons/handicap.png')) {
						this.old_selected_seat.id = item.id;
						this.old_selected_seat.image_path = item.image_path;

						this.selected_seat = item;
						item.image_path = 'icons/selected_seat.png';
					} else {
						this.showConfirmationModal = true;
						this.confirmationModalMessage = 'Are you sure you want to select a handicap seat?';
						this.confirmationModalTitle = 'Confirmation';
					}
					// item.image_path = 'icons/seat_selected.png';
				}

				if(!_.isEmpty(item.passenger)) {
					this.passenger = item.passenger;
					this.showModal = true;
					this.ticket_types = this.$parent.ticket_types
				}
				
			},

			processSeat() {
				this.showConfirmationModal = false;

				this.old_selected_seat.id = this.item.id;
				this.old_selected_seat.image_path = this.item.image_path;

				this.selected_seat = this.item;
				this.item.image_path = 'icons/selected_seat.png';
			},

			nextFormHandler() {
				this.$parent.seat_selected = this.selected_seat;

				if(this.$parent.edit) {
					this.$parent.selectedTicket.seat_id = !_.isEmpty(this.selected_seat) ? this.selected_seat.id : this.$parent.selectedTicket.seat_id;
				}

				this.$emit('nextStep', 4);
			}
		}
	}
</script>