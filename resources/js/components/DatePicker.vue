<template>
	<vue2-datepicker v-model="date" type="date" format="YYYY-MM-DD" input-class='form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent' :input-attr="attr"></vue2-datepicker>
</template>
<script>
	import Vue2DatePicker from 'vue2-datepicker';
  	import 'vue2-datepicker/index.css';

	export default {
		name: 'DatePicker',

		components: { 'vue2-datepicker': Vue2DatePicker },

		props: {
			name: String,
			item: {
				default: null,
				type: Object
			}
		},

		data() {
			return {
				date: null,
				attr: {
					name: this.name,
					value: this.item[this.name]
				}
			}
		},

		watch: {
			date(val) {
				this.attr = {
					name: this.name,
					value: this.formattedDate
				}
			}
		},

		computed: {
			formattedDate() {
				return moment(this.date).format('YYYY-MM-DD');
			}
		},


	}
</script>