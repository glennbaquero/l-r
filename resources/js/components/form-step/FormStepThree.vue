<template>
	<div>
		<div class="mt-5 px-4 py-4 rounded-md text-center">
			<div class="gap-4 grid grid-cols-3">
				<div class="border px-4 py-4 col-span-2 rounded-md w-full shadow-md">
					<table class="w-full">
						<tr v-for="row in bus_model">
						    <td v-for="column in row" class=" bg-center bg-contain bg-no-repeat h-5 px-4 w-5" :style="{ backgroundImage: 'url(' + column.image_path + ')', transform: 'rotate('+column.orientation+'deg)', cursor: column.label != '' ? 'pointer' : '' }" @click="selectedSeatHandler(column)">
						    	<!-- <label class="bg-transparent border-transparent focus:border-blue-300 font-black px-0 py-0 rounded shadow-sm text-black text-center transition w-5">{{ column.label }}</label> -->
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
				<button tabindex="3" type="button" class="w-full flex justify-center py-2 px-4 border border-lighterblue text-sm font-medium rounded text-black bg-transparent hover:bg-lighterblue hover:text-white focus:outline-none focus:border-transparent focus:shadow-outline-transparent active:bg-transparent focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out sm:leading-8" @click="$emit('backToForm', 2)">
				    Back
				</button>
			</div>
			<div class="col-span-1 sm:col-span-1">
				<button tabindex="3" type="button" class="w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out sm:leading-8" :disabled="disabledNextButton" @click="nextFormHandler">
				    Next
				</button>
			</div>
		</div>
	</div>

</template>
<script type="text/javascript">
	export default {
		props: {
			bus: Array
		},

		data() {
			return {
				bus_model: [],
				duplicated_bus_model: [],
				selected_seat: {},

				old_selected_seat: {}
			}
		},

		computed: {
			disabledNextButton() {
				if(!_.isEmpty(this.selected_seat)) return false;

				return true;
			}
		},

		mounted() {
			this.bus_model = this.bus;
		},

		methods: {
			selectedSeatHandler(item) {

				if(item.label != '' && !item.is_reserved) {
					_.each(this.bus_model, (row) => {
						_.each(row, (column) => {
							if(!_.isEmpty(this.old_selected_seat) && this.old_selected_seat.id === column.id) {
								console.log(column.image_path);
								column.image_path = this.old_selected_seat.image_path;
							}
						})
					})

					this.old_selected_seat.id = item.id;
					this.old_selected_seat.image_path = item.image_path;

					this.selected_seat = item;
					item.image_path = 'icons/seat_selected.png';
				}
				
			},

			nextFormHandler() {
				this.$parent.seat_selected = this.selected_seat;
				this.$emit('nextStep', 4);
			}
		}
	}
</script>