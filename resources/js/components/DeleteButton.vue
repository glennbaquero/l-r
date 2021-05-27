<template>
	<div>
		<a href="#" class="focus:outline-none focus:shadow-outline inline-flex" @click="showModal = true">
		
			
		    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
		</a>
		<modal
			bodyMessage="Are you sure you want to continue this?"
			headerTitle="Ooops!"
			:show="showModal"
			:hasFooter="true"
			@closeModal="showModal = false"
		>
			<template v-slot:footerButton>
			    <button class="active:text-gray-700 bg-red-600 duration-150 font-medium inline-flex items-center leading-5 px-4 py-2 relative rounded-md text-sm text-white transition" @click="submit">
			        Confirm
			    </button>
			    <button class="active:text-gray-700 bg-lighterblue duration-150 font-medium inline-flex items-center leading-5 ml-2 px-4 py-2 relative rounded-md text-center text-sm text-white transition" @click="showModal = false">
			        Cancel
			    </button>
			</template>
		</modal>
	</div>
</template>

<script>
	import Modal from './Modal.vue';

	export default {
		name: 'DeleteButton',

		props: {
			url: String,
		},

		data() {
			return {
				showModal: false
			}
		},

		render() {
		    return this.$scopedSlots.default({
		        submit: this.submit
		    });
		},

		components: {
		    Modal,
		},

		methods: {
			submit() {
				this.showModal = false;
				this.$parent.loading = true;
				axios.post(this.url)
					.then(response => {
						this.$parent.fetch();
						this.$parent.loading = false;
					}).catch(error => {
						this.$parent.loading = false;
					})
			}
		}
	}
</script>