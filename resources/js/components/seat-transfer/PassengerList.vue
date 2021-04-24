<template>
	<div class="flex flex-col">
	    <div class="-my-2 lg:-mx-8 lg:px-8 max-w-full overflow-x-auto py-2 sm:-mx-6 sm:px-6">
	        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
	            <table class="min-w-full text-xs">
	                <thead>
	                    <tr class="text-center">
                            <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-50 leading-4 text-gray-500 uppercase tracking-wider font-bold">
                                ID
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-50 leading-4 text-gray-500 uppercase tracking-wider font-bold">
                                Departure
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-50 leading-4 text-gray-500 uppercase tracking-wider font-bold">
                                Arrival
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-50 leading-4 text-gray-500 uppercase tracking-wider font-bold">
                                Seat
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-50 leading-4 text-gray-500 uppercase tracking-wider font-bold">
                                Ticket Type
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-50 leading-4 text-gray-500 uppercase tracking-wider font-bold">
                                Passenger
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-50 leading-4 text-gray-500 uppercase tracking-wider font-bold">
                                Seller
                            </th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-50 leading-4 text-gray-500 uppercase tracking-wider font-bold">
                                Office
                            </th>
	                    </tr>
	                </thead>
	                <tbody class="bg-white">
	                    <tr v-for="(ticket, key) in tickets" :key="key" class="hover:bg-gray-100 cursor-pointer">
	                    	<td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
	                    		{{ ticket.id }}
	                    	</td>
	                    	<td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
	                    		{{ ticket.departure }}
	                    	</td>
	                    	<td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
	                    		{{ ticket.arrival }}
	                    	</td>
	                    	<td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
	                    		{{ ticket.seat }}
	                    	</td>
	                    	<td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
	                    		{{ ticket.ticket_type }}
	                    	</td>
	                    	<td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
	                    		{{ ticket.passenger }}
	                    	</td>
	                    	<td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
	                    		{{ ticket.seller }}
	                    	</td>
	                    	<td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
	                    		{{ ticket.office }}
	                    	</td>
	                    </tr>
	                </tbody>
	            </table>
	        </div>
	    </div>
	</div>
</template>

<script type="text/javascript">
	export default {
		props: {
			tickets: Array
		}
	}
</script>