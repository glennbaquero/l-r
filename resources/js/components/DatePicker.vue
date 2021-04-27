<template>
	<vue2-datepicker v-model="date" :type="type" :format="format" :input-class="classAttrib" :input-attr="attr" :range="activateDateRange" @change="datepickerChange"></vue2-datepicker>
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
			},

			type: {
				default: 'date'
			},

			format: {
				default: 'YYYY-MM-DD'
			},

			classAttrib: {
				default: 'form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent'
			},

			dateRange: {
				default: 0,
			}
		},

		data() {
			return {
				date: null,
				attr: {
					name: this.name,
					value: this.item[this.name],

					id: this.name
				}
			}
		},

		watch: {
			date(val) {
				if(!this.dateRange) {
					this.attr = {
						name: this.name,
						value: this.type == 'date' ? this.formattedDate : this.formattedTime,
						id: this.name
					}
				} else {
					this.attr = {
						name: this.name,
						value: this.formattedDate,
						id: this.name
					}
				}
				
			}
		},

		computed: {
			formattedDate() {
				var date =  moment(this.date).format('YYYY-MM-DD');
				if(this.dateRange) {
					date = _.map(this.date, (date) => { 
							  return moment(date).format('YYYY-MM-DD');
							}); 
				}

				return date;
			},

			formattedTime() {
				if(!this.dateRange && this.type == 'time') {
					return moment(this.date).format('hh:mm');
				} else {
					return false;
				}
			},

			activateDateRange() {
				return this.dateRange != 1 ? false : true;
			}
		},

		methods: {
			datepickerChange() {
				setTimeout(() => {
					this.$emit('datePickerChange', this.attr)
				}, 1000)
			}
		}

	}
</script>