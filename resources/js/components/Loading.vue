<template>
	<div>
		<div class="fixed top-0 left-0 right-0 bottom-0 w-full h-screen z-50 overflow-hidden bg-gray-700 opacity-75 flex flex-col items-center justify-center" v-if="display">
		    <div class="loader ease-linear rounded-full border-4 border-t-4 border-gray-200 h-12 w-12 mb-4"></div>
		</div>
	</div>
</template>

<script type="text/javascript">
	export default {
		name: 'Loading',
		props: {
			show: Boolean
		},

		data() {
			return {
				display: false
			}
		},

		watch: {
			show(val) {
				this.display = val;
			}
		},


		render() {
		    return this.$scopedSlots.default({
		    	loading_state: this.loading_state,
		    });
		},

		mounted() {
			setInterval(() => {

				if(this.loading_state >= 4) {
					this.loading_state = 1;
				} else {
					this.loading_state += 1;
				}
			}, 500)
		}
	}
</script>