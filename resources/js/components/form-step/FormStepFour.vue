<template>
	<div>
		<div class="gap-2 grid grid-cols-3 pl-4 pr-4">
			<div class="col-span-1 col-start-2 sm:col-span-1 sm:col-start-2">
				<input type="text" name="search_passenger" class="border-l-0 border-r-0 border-t-0 duration-150 ease-in-out leading-none mx-auto my-3 px-3 py-2 shadow-sm text-center transition w-full" placeholder="Search Passenger" @input="searchPassengerHandler($event.target.value)" autocomplete="off">
				<div class="absolute bg-white mb-1 py-2 rounded shadow-lg text-base text-left w-5/12 w-auto z-50" :class="!passengers.length ? 'hidden' : 'block'"> <!-- hidden -->
		          <div class="bg-transparent block cursor-pointer font-normal hover:bg-blue-400 hover:text-white px-4 py-2 text-sm w-full whitespace-nowrap" v-for="passenger in passengers" @click="selectedPassenger(passenger)">
		            {{ passenger.first_name }} {{ passenger.last_name }}
		          </div>
		        </div>
			</div>
		</div>
		<div class="gap-2 grid grid-cols-3 pl-4 pr-4">


			<div class="col-span-1 sm:col-span-1">
				<label for="first_name" class="block font-medium font-semibold text-gray-500">First Name</label>
				<input type="text" name="first_name" v-model="passenger_info.first_name" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent">
			</div>
			<div class="col-span-1 sm:col-span-1">
				<label for="last_name" class="block font-medium font-semibold text-gray-500">Last Name</label>
				<input type="text" name="last_name" v-model="passenger_info.last_name" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent">
			</div>
			<div class="col-span-1 sm:col-span-1">
				<label for="gender" class="block font-medium font-semibold text-gray-500">Gender</label>
				<select name="gender" v-model="passenger_info.gender" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent">
					<option value="Male">Male</option>
					<option value="Female">Female</option>
					<option value="Others">Others</option>
				</select>
			</div>
			<div class="col-span-1 sm:col-span-1">
				<label for="cellphone_number" class="block font-medium font-semibold text-gray-500">Phone Number <b class="text-red-500">*</b></label>
				<input type="text" name="cellphone_number" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" ref="phoneNumber" @input="handlePhoneFormat" v-model="passenger_info.cellphone_number">
			</div>
			<div class="col-span-1 sm:col-span-1">
				<label for="email" class="block font-medium font-semibold text-gray-500">Email</label>
				<input type="text" name="email" v-model="passenger_info.email" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent">
			</div>
			<div class="col-span-1 sm:col-span-1">
				<label for="ticket_type" class="block font-medium font-semibold text-gray-500">Ticket Type</label>
				<select name="ticket_type" v-model="passenger_info.ticket_type" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent">
					<option v-for="type in ticket_types" :value="type">{{ type.name }}</option>
				</select>
			</div>
			<div class="col-span-1 sm:col-span-1">
				<label for="no_of_bags" class="block font-medium font-semibold text-gray-500">No. of Bags</label>
				<input type="number" name="no_of_bags" v-model="passenger_info.no_of_bags" min="0" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent">
			</div>
			<!-- <div class="col-span-1 sm:col-span-1">
				<label for="luggage_no" class="block font-medium font-semibold text-gray-500">Luggage No.</label>
				<input type="number" name="luggage_no" v-model="passenger_info.luggage_no" min="0" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent">
			</div> -->

			<div class="col-span-full sm:col-span-full">
				<label>
					<input type="checkbox" name="with_infant" v-model="passenger_info.with_infant" class="inline-flex duration-150 ease-in-out focus:border-blue-300 focus:outline-none focus:shadow-outline-blue form-input leading-none mx-auto my-3 rounded shadow-sm transition">Infant Travelling with adult?
				</label>
			</div>

			<div class="col-span-1 sm:col-span-1" v-if="passenger_info.with_infant">
				<label for="infant_firstname" class="block font-medium font-semibold text-gray-500">First Name</label>
				<input type="text" name="infant_firstname" v-model="passenger_info.infant_firstname" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent">
			</div>
			<div class="col-span-1 sm:col-span-1" v-if="passenger_info.with_infant">
				<label for="infant_lastname" class="block font-medium font-semibold text-gray-500">Last Name</label>
				<input type="text" name="infant_lastname" v-model="passenger_info.infant_lastname" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent">
			</div>
			<div class="col-span-1 sm:col-span-1" v-if="passenger_info.with_infant">
				<label for="infant_gender" class="block font-medium font-semibold text-gray-500">Gender</label>
				<select name="infant_gender" v-model="passenger_info.infant_gender" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent">
					<option value="Male">Male</option>
					<option value="Female">Female</option>
					<option value="Others">Others</option>
				</select>
			</div>

		</div>

		<div class="gap-4 grid grid-cols-6 pl-4 mt-5">
			<div class="col-span-1 sm:col-span-1">
				<button tabindex="3" type="button" class="w-full flex justify-center py-2 px-4 border border-lighterblue text-sm font-medium rounded text-black bg-transparent hover:bg-lighterblue hover:text-white focus:outline-none focus:border-transparent focus:shadow-outline-transparent active:bg-transparent focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out sm:leading-8" @click="$emit('backToForm', 1)">
				    Back
				</button>
			</div>
			<div class="col-span-1 sm:col-span-1" v-if="!disabledNextButton">
				<button tabindex="3" type="button" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out sm:leading-8" @click="nextFormHandler">
				    Next
				</button>
			</div>
		</div>

		<div class="grid grid-cols-3 gap-4">
			<div class="col-span-full sm:col-span-full text-right">
				<label class="font-semibold">Price: {{ totalPrice }} | Free Baggage Fee For: {{ freeBaggageFor }} | Extra Charge: {{ totalExtraCharge }}</label>
			</div>
		</div>
	</div>
</template>
<script type="text/javascript">
	export default {
		props: {
			ticket_types: Array
		},

		data() {
			return {
				passenger_info: {
					first_name: '',
					last_name: '',
					gender: 'Male',
					cellphone_number: '',
					email: '',
					ticket_type: {},
					no_of_bags: 0,
					luggage_no: 0,

					with_infant: false,
					infant_firstname: '',
					infant_lastname: '',
					infant_gender: 'Male',
				},

				passengers: []
			}
		},

		computed: {
			disabledNextButton() {
				if(!_.isEmpty(this.passenger_info.first_name) && !_.isEmpty(this.passenger_info.last_name) && !_.isEmpty(this.passenger_info.cellphone_number)
					&& !_.isEmpty(this.passenger_info.ticket_type)) {
					return false;	
				} 

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

					// check if max baggage is exceed
					
					if(this.$parent.payloads.trip.max_baggage < this.passenger_info.no_of_bags) {
						total = total + ((this.passenger_info.no_of_bags - this.$parent.payloads.trip.max_baggage) * parseFloat(this.$parent.payloads.trip.additional_bag_fee));
					}

					return total.toFixed(2);
				}

				return "0.00";
			},

			totalExtraCharge() {

				let total = 0;

				// check if max baggage is exceed
				
				if(this.$parent.payloads.trip.max_baggage < this.passenger_info.no_of_bags) {
					total = (this.passenger_info.no_of_bags - this.$parent.payloads.trip.max_baggage) * parseFloat(this.$parent.payloads.trip.additional_bag_fee);

					return total.toFixed(2);
				}

				return "0.00";
			},

			freeBaggageFor() {
				return this.$parent.payloads.trip.max_baggage;
			}

		},

		mounted() {
			if(!_.isEmpty(this.$parent.selectedTicket)) {
				this.passenger_info = this.$parent.selectedTicket.passenger_info

				// setTimeout(() => {
				// 	this.canEdit = true;
				// }, 500)
			} else {
				this.passenger_info = !_.isEmpty(this.$parent.passenger_info) ? this.$parent.passenger_info : this.passenger_info;
			}
 		},

		methods: {
			handlePhoneFormat(e) {
				var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
				e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
				this.passenger_info.cellphone_number = e.target.value;
			},

			nextFormHandler() {
				this.$parent.passenger_info = this.passenger_info;
				this.$emit('nextStep', 5);
			},

			searchPassengerHandler: _.debounce(function(value) {
				this.searchPassenger(value);
	        }, 1000),

			searchPassenger(value) {
				this.$parent.loading = true;
				axios.post(this.$parent.searchPassengerUrl, { search: value })
					.then(response => {
						this.passengers = response.data.passengers;
						this.$parent.loading = false;
					}).catch(errors => {
						this.$parent.loading = false;
					})
			},

			selectedPassenger(passenger) {
				this.passenger_info.first_name = passenger.first_name;
				this.passenger_info.last_name = passenger.last_name;
				this.passenger_info.gender = passenger.gender;
				this.passenger_info.cellphone_number = passenger.cellphone_number;
				this.passenger_info.email = passenger.email;
				this.passenger_info.ticket_type = _.find(this.ticket_types, (type) => { return type.id == passenger.ticket_type_id}) ;
				this.passenger_info.with_infant = passenger.with_infant;
				this.passenger_info.infant_firstname = passenger.infant_firstname;
				this.passenger_info.infant_lastname = passenger.infant_lastname;
				this.passenger_info.infant_gender = passenger.infant_gender;

				this.$refs.phoneNumber.value = passenger.cellphone_number;

				this.passengers = [];
			}
		}
	}
</script>