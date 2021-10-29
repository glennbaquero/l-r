<template>
	<div class="mx-auto w-full">
	    <div class="bg-white shadow sm:rounded-lg">
	        <div class="px-4 py-5 sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-full sm:col-span-full text-center">
                        <p>Enter</p>
                        <label for="senior_roundtrip" class="font-semibold">Transaction Number/Reference Number </label>
                        <p>or</p>
                        <label for="senior_roundtrip" class="font-semibold">Ticket Number</label>
                        <input type="text" name="" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" placeholder="---" v-model="payloads.transaction_number">
                    </div>
                </div>
                <div class="mt-5 text-left">
                    <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-full" @click="actionHandler">
                        Search
                    </button>
                </div>
	        </div>
	    </div>

	    <loading
	    	:show="loading"
	    ></loading>


	    <modal
	    	:bodyMessage="modalMessage"
	    	:headerTitle="modalTitle"
	    	:show="showModal"
	    	@closeModal="showModal = false"
	    ></modal>
	</div>
</template>
<script type="text/javascript">
	import Loading from './Loading.vue';
	import Modal from './Modal.vue';

	export default {
		name: 'EnterTransactionNumber',

		props: {
			url: String
		},

		data() {
			return {
				payloads: {},
				loading: false,
				modalMessage: '',
				modalTitle: '',
				showModal: false,
			}
		},


		render() {
		    return this.$scopedSlots.default({
		    	//
		    });
		},
		
		components: {
			Loading,
		    Modal,
		},


		methods: {
			actionHandler() {
				this.loading = true;
			    axios.post(this.url, this.payloads)
			    	.then(response => {
			    		this.loading = false;
			    		this.modalTitle = 'Transaction/Reference Number Found';
			    		this.modalMessage = 'Passenger ticket is validated. Ticket is now boarded.';
			    		this.showModal = true;
			    	}).catch((errors) => {
			    		this.loading = false;
			    		this.modalTitle = 'Ooops';
			    		this.modalMessage = 'Transaction/Reference number not found.';
			    		this.showModal = true;
			    	})
			}
		}
	}
</script>