<template>
	<form @submit.prevent="submit" method="GET" action="javascript:void(0)">
		<slot></slot>


		<div class="mt-5 text-right">
		    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36">
		        Save
		    </button>
		</div>
	</form>
</template>

<script>
	export default {
		name: 'FormData',

		props: {
			submitUrl: String,
		},


		render() {
		    return this.$scopedSlots.default({
		        submit: this.submit
		    });
		},

		methods: {
			submit() {

				let form = event.target;
				let params = new FormData(form);

				axios.post(this.submitUrl, params)
					.then(response => {
						if(response.data.redirect) {
							setTimeout(() => {
								window.location.href = response.data.redirect;
							}, 2000)
						}
					}).catch(error => {
						//
					})
			}
		}
	}
</script>