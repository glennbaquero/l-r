<template>
	<div>
		<form-step-one
			v-if="step === 1"
			:cities="cities"
			@nextStep="nextStep(...arguments)"
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
		></form-step-five>
	</div>
</template>
<script>
	import FormStepOne from './form-step/FormStepOne.vue';
	import FormStepTwo from './form-step/FormStepTwo.vue';
	import FormStepThree from './form-step/FormStepThree.vue';
	import FormStepFour from './form-step/FormStepFour.vue';
	import FormStepFive from './form-step/FormStepFive.vue';

	export default {
		name: 'Ticket',

		data() {
			return {
				step: 1,

				payloads: {},
				price: {},

				availableTrip: [],
				bus: [],
				seat_selected: {},
				passenger_info: {},
			}
		},

		props: {
			cities: Array,
			ticket_types: Array,
			findAvailableTripUrl: String,
			fetchBusUrl: String,
			searchPassengerUrl: String,
			paymentFormUrl: String,
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