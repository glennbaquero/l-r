<template>
	<div>
        <stepper :step="step"></stepper>

		<form-step-one
			v-if="step === 1"
			:cities="cities"
			@nextStep="nextStep(...arguments)"
			:office-id="officeId"
		></form-step-one>

		<form-step-two
			v-if="step === 2"
			:trips="availableTrip"
			@backToForm="backToForm(...arguments)"
			@nextStep="nextStep(...arguments)"
		></form-step-two>

		<form-step-three
			v-if="step === 3"
			:bus="bus"
			@backToForm="backToForm(...arguments)"
			@nextStep="nextStep(...arguments)"
		></form-step-three>

		<form-step-four
			v-if="step === 4"
			:ticket_types="ticket_types"
			@backToForm="backToForm(...arguments)"
			@nextStep="nextStep(...arguments)"
		></form-step-four>

		<form-step-five
			v-if="step === 5"
			@backToForm="backToForm(...arguments)"
			@nextStep="nextStep(...arguments)"
		></form-step-five>

		<final-form
			v-if="step === 6"
			@backToForm="backToForm(...arguments)"
		></final-form>

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
<script>
	import FormStepOne from './form-step/FormStepOne.vue';
	import FormStepTwo from './form-step/FormStepTwo.vue';
	import FormStepThree from './form-step/FormStepThree.vue';
	import FormStepFour from './form-step/FormStepFour.vue';
	import FormStepFive from './form-step/FormStepFive.vue';
	import FinalForm from './form-step/FinalForm.vue';
	import Stepper from './form-step/Stepper.vue';
	import Loading from './Loading.vue';
	import Modal from './Modal.vue';

	export default {
		name: 'Ticket',

		data() {
			return {
				step: 1,

				payloads: {},
				price: {},

				availableTrip: [],
				bus: [],
				bus_info: [],
				seat_selected: {},
				passenger_info: {},

				payment:{},
				voucher: null,
				totalSale: 0,
				loading: false,
				modalMessage: '',
				modalTitle: '',
				showModal: false,

				pusher: null,
				channel: null,

				paidTicket: {},
			}
		},

		props: {
			cities: Array,
			ticket_types: Array,
			findAvailableTripUrl: String,
			fetchBusUrl: String,
			searchPassengerUrl: String,
			paymentFormUrl: String,
			voucherValidateUrl: String,
			getTripTimeUrl: String,
			getAvailableBusUrl: String,
			notifyPassengerUrl: String,
			updateUrl: String,
			selectedTicket: Object,
			officeId: Number,

			edit: {
				type: Boolean,
				default: false
			}
		},

		render() {
		    return this.$scopedSlots.default({
		    	//
		    });
		},

		components: {
			FormStepOne,
			FormStepTwo,
			FormStepThree,
			FormStepFour,
			FormStepFive,
			FinalForm,
			Stepper,
			Loading,
		    Modal,
		},

		mounted() {
			this.pusher = new Pusher('a31ead8c74664bc1acb9', {
		      cluster: 'ap1'
		    });
		},

		methods: {
			nextStep(step) {
				this.step = step
			},

			backToForm(step) {
				this.step = step
			}
		}
	}
</script>