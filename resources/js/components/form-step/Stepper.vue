<template>
	<div class="flex items-center mt-4 mb-4 w-90-percent mx-auto">
	    <div class="flex items-center" :class="step >= 1 ? 'text-lighterblue' : 'text-gray-400'">
	        <div class="-ml-10 absolute font-semibold mt-5 text-center text-xs top-0 uppercase w-32">Location</div>
	        <div class="bg-lighterblue border-lighterblue border-2  duration-500 ease-in-out h-8 py-3 rounded-full transition w-8"></div>
	    </div>
	    <div class="flex-auto border-t-2 transition duration-500 ease-in-out" :class="step >= 3 ? 'border-lighterblue' : 'border-gray-300'"></div>
	    <div class="flex items-center":class="step >= 3 ? 'text-lighterblue' : 'text-gray-400'">
	        <div class="-ml-12 absolute font-semibold mt-5 text-center text-xs top-0 uppercase w-32">Seat</div>
	        <div class="border-2  duration-500 ease-in-out h-8 py-3 rounded-full transition w-8" :class="step >= 3 ? 'bg-lighterblue border-lighterblue' : 'bg-gray-300 border-gray-300'"></div>
	    </div>
	    <div class="flex-auto border-t-2 transition duration-500 ease-in-out" :class="step >= 4 ? 'border-lighterblue' : 'border-gray-300'"></div>
	    <div class="flex items-center" :class="step >= 4 ? 'text-lighterblue' : 'text-gray-400'">
	        <div class="-ml-10 absolute font-semibold mt-5 text-center text-xs top-0 uppercase w-32">Information</div>
	        <div class="border-2  duration-500 ease-in-out h-8 py-3 rounded-full transition w-8" :class="step >= 4 ? 'bg-lighterblue border-lighterblue' : 'bg-gray-300 border-gray-300'"></div>
	    </div>
	    <div class="flex-auto border-t-2 transition duration-500 ease-in-out" :class="step >= 5 ? 'border-lighterblue' : 'border-gray-300'"></div>
	    <div class="flex items-center" :class="step >= 5 ? 'text-lighterblue' : 'text-gray-400'">
	        <div class="-ml-12 absolute font-semibold mt-5 text-center text-xs top-0 uppercase w-32">Payment</div>
	        <div class="border-2 duration-500 ease-in-out h-8 py-3 rounded-full transition w-8" :class="step >= 5 ? 'bg-lighterblue border-lighterblue' : 'bg-gray-300 border-gray-300'"></div>
	    </div>
	    <div class="flex-auto border-t-2 transition duration-500 ease-in-out" :class="step >= 6 ? 'border-lighterblue' : 'border-gray-300'"></div>
	    <div class="flex items-center" :class="step >= 6 ? 'text-lighterblue' : 'text-gray-400'">
	        <div class="-ml-12 absolute font-semibold mt-5 text-center text-xs top-0 uppercase w-32">Confirmation</div>
	        <div class="border-2 duration-500 ease-in-out h-8 py-3 rounded-full transition w-8" :class="step >= 6 ? 'bg-lighterblue border-lighterblue' : 'bg-gray-300 border-gray-300'"></div>
	    </div>
	</div>
</template>

<script type="text/javascript">
	export default {
		name: 'Stepper',

		props: {
			step: Number
		}
	}
</script>