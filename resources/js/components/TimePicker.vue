<template>
	<vue-timepicker format="HH:mm:ss" v-model="time" input-class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" drop-direction="up"></vue-timepicker>
</template>
<script type="text/javascript">
	import VueTimepicker from 'vue2-timepicker'
	import 'vue2-timepicker/dist/VueTimepicker.css'

	export default {
		name: 'time-picker',

		props: {
			stop: Number,
			objectName: String,

			value: String
		},

		data() {
			return {
				time: {
					HH: '00',
					mm: '00',
					ss: '00'
				}
			}
		},

		components: { VueTimepicker },

		watch: {
			time(val) {
				this.$parent.stops[this.stop][this.objectName] = val['HH']+':'+val['mm']+':'+val['ss'];
			}
		},

		mounted() {
			setTimeout(() => {
				if(!_.isEmpty(this.value)) {
					this.time = {
						HH: this.value.split(':')[0],
						mm: this.value.split(':')[1],
						ss: this.value.split(':')[2],
					}
				}
			}, 500)
			
		}

	}
</script>