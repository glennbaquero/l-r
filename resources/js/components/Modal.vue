<template>
	<div>
	    <div v-if="display" class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
	        <div class="max-h-screen max-w-lg mx-auto my-6 relative w-full">
	            <!--content-->

	            <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
	                <!--header-->
	                
                    <div class="flex items-start justify-between p-5 border-b border-solid border-gray-300 rounded-t">
                        <h3 class="text-3xl font-semibold">
                           {{ headerTitle }}
                        </h3>
                        <a href="#" @click="closeModal">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </a>
                    </div>

	                <!--body-->
	                <div class="relative p-6 flex-auto">
	                    {{ bodyMessage }}
	                </div>

	                <!--footer-->
                    <div class="flex items-center justify-end p-6 border-t border-solid border-gray-300 rounded-b" v-if="hasFooter">
                        {{ footerText }}
                    </div>
	            </div>
	        </div>
	    </div>
	    <div v-if="display" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
	</div>
</template>

<script type="text/javascript">
	export default {
		name: 'Modal',
		props: {
			hasFooter: {
				type: Boolean,
				default: false
			},

			footerText: String,
			bodyMessage: String,
			headerTitle: String,
			show: {
				type: Boolean,
				default: false
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
			}
		}
	}
</script>