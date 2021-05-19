<template>
	<div>
	    <div v-if="display" class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
	        <div class="max-h-screen max-w-5xl mx-auto my-6 relative w-full">
	            <!--content-->

	            <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
	                <!--header-->
	                
                    <div class="flex items-start justify-between p-5 border-b border-solid border-gray-300 rounded-t">
                        <h3 class="text-3xl font-semibold">
                           Passenger Info
                        </h3>
                        <a href="#" @click="closeModal">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </a>
                    </div>

	                <!--body-->
	                <div class="relative p-6 flex-auto">
	                    <div class="gap-2 grid grid-cols-3 pl-4 pr-4">
	                    	<div class="col-span-1 sm:col-span-1">
	                    		<label for="first_name" class="block font-medium font-semibold text-gray-500">First Name</label>
	                    		<input type="text" name="first_name" v-model="passenger.first_name" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" :disabled="disabled">
	                    	</div>
	                    	<div class="col-span-1 sm:col-span-1">
	                    		<label for="last_name" class="block font-medium font-semibold text-gray-500">Last Name</label>
	                    		<input type="text" name="last_name" v-model="passenger.last_name" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" :disabled="disabled">
	                    	</div>
	                    	<div class="col-span-1 sm:col-span-1">
	                    		<label for="gender" class="block font-medium font-semibold text-gray-500">Gender</label>
	                    		<select name="gender" v-model="passenger.gender" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" :disabled="disabled">
	                    			<option value="Male">Male</option>
	                    			<option value="Female">Female</option>
	                    			<option value="Others">Others</option>
	                    		</select>
	                    	</div>
	                    	<div class="col-span-1 sm:col-span-1">
	                    		<label for="phone_number" class="block font-medium font-semibold text-gray-500">Phone Number <b class="text-red-500">*</b></label>
	                    		<input type="text" name="phone_number" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" ref="phoneNumber" v-model="passenger.phone_number" @input="handlePhoneFormat" :disabled="disabled">
	                    	</div>
	                    	<div class="col-span-1 sm:col-span-1">
	                    		<label for="email" class="block font-medium font-semibold text-gray-500">Email</label>
	                    		<input type="text" name="email" v-model="passenger.email" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" :disabled="disabled">
	                    	</div>
	                    	<div class="col-span-1 sm:col-span-1">
	                    		<label for="ticket_type" class="block font-medium font-semibold text-gray-500">Ticket Type</label>
	                    		<select name="ticket_type" v-model="passenger.ticket_type_id" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" :disabled="disabled">
	                    			<option v-for="type in ticket_types" :value="type.id">{{ type.name }}</option>
	                    		</select>
	                    	</div>
	                    	<div class="col-span-1 sm:col-span-1">
	                    		<label for="no_of_bags" class="block font-medium font-semibold text-gray-500">No. of Bags <b class="text-red-500">*</b></label>
	                    		<input type="number" name="no_of_bags" v-model="passenger.no_of_bags" min="0" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" :disabled="disabled">
	                    	</div>
	                    	<div class="col-span-1 sm:col-span-1">
	                    		<label for="luggage_no" class="block font-medium font-semibold text-gray-500">Luggage No.</label>
	                    		<input type="number" name="luggage_no" v-model="passenger.luggage_no" min="0" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" :disabled="disabled">
	                    	</div>

	                    	<div class="col-span-full sm:col-span-full">
	                    		<label>
	                    			<input type="checkbox" name="with_infant" v-model="passenger.with_infant" class="inline-flex duration-150 ease-in-out focus:border-blue-300 focus:outline-none focus:shadow-outline-blue form-input leading-none mx-auto my-3 rounded shadow-sm transition" :disabled="disabled">Infant Travelling with adult?
	                    		</label>
	                    	</div>

	                    	<div class="col-span-1 sm:col-span-1" v-if="passenger.with_infant">
	                    		<label for="infant_firstname" class="block font-medium font-semibold text-gray-500">First Name</label>
	                    		<input type="text" name="infant_firstname" v-model="passenger.infant_firstname" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" :disabled="disabled">
	                    	</div>
	                    	<div class="col-span-1 sm:col-span-1" v-if="passenger.with_infant">
	                    		<label for="infant_lastname" class="block font-medium font-semibold text-gray-500">Last Name</label>
	                    		<input type="text" name="infant_lastname" v-model="passenger.infant_lastname" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" :disabled="disabled">
	                    	</div>
	                    	<div class="col-span-1 sm:col-span-1" v-if="passenger.with_infant">
	                    		<label for="infant_gender" class="block font-medium font-semibold text-gray-500">Gender</label>
	                    		<select name="infant_gender" v-model="passenger.infant_gender" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" :disabled="disabled">
	                    			<option value="Male">Male</option>
	                    			<option value="Female">Female</option>
	                    			<option value="Others">Others</option>
	                    		</select>
	                    	</div>

	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div v-if="display" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
	</div>
</template>

<script type="text/javascript">
	export default {
		name: 'PassengerInfoModal',
		props: {

			footerText: String,
			bodyMessage: String,
			headerTitle: String,
			show: {
				type: Boolean,
				default: false
			},
			passenger: Object,
			ticket_types: Array,

			disabled: {
				default: true,
				type: Boolean
			}
		},

		data() {
			return {
				display: this.show
			}
		},

		watch: {
			show(val) {
				this.display = val;
			}
		},

		methods: {
			closeModal() {
				this.$emit('closeModal');
				this.display = false
			},

			handlePhoneFormat(e) {
				var x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,4})/);
				e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
				this.passenger.phone_number = e.target.value;
			},
		},
	}
</script>