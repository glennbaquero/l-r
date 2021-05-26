<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">
                <span class="font-semibold mr-3">{{__('Passenger')}}</span>
            </div>
        </div>

        <div class="mt-12 mx-auto">
            <data-table v-slot="{ params, setParam, data, links, meta, next, prev, loading }"
                        :searches="{{json_encode($searches)}}"
                        url="{{route('passenger-report.fetch')}}"
            >
                <filter-table v-slot="{ toggledState, display, search, field }">
                    <pdf-viewer v-slot="{ src, items, getPdfPassenger, viewer_show, loading }" search-url="{{ route('passenger.print') }}">
                        <div>
                        <x-table :headers="$headers">
                            <x-slot name="filter">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-1/4 sm:col-span-1/4">
                                        <x-label for="route" class="font-semibold">Route</x-label>
                                        <x-select :lists="$routes" name="route" v-model="field.route_id"/>
                                    </div>
                                    <div class="col-span-1/4 sm:col-span-1/4">
                                        <x-label for="route" class="font-semibold">Search Type</x-label>
                                        <span class="flex w-full shadow-sm h-11">
                                            <button type="button" @click="toggledState(false)" :class="!display ? 'bg-green-500 text-white' : 'bg-gray-200 text-black'" class="focus:outline-none font-lg justify-center leading-6 px-4 py-2 shadow-sm sm:leading-5 sm:text-md text-base transition w-auto rounded-l-md">
                                                Day
                                            </button>
                                            <button type="button" @click="toggledState(true)" :class="display ? 'bg-green-500 text-white' : 'bg-gray-200 text-black'"  class="focus:outline-none font-lg justify-center leading-6 px-4 py-2 shadow-sm sm:leading-5 sm:text-md text-base transition w-full rounded-r-md">
                                                Date Range
                                            </button>
                                        </span>
                                    </div>
                                    <div class="col-span-1/4 sm:col-span-1/4">
                                        <x-label for="route" class="font-semibold">Select Date</x-label>
                                        <x-datepicker name="date" dateRange="display" class="form-input w-full mx-auto my-2 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent"/>
                                    </div>
                                    <div class="col-span-1/4 sm:col-span-1/4 text-center">
                                        <button type="button" class="bg-lightblue border-transparent h-1/2 hover:bg-lighterblue items-center mt-6 rounded-md text-base text-center text-white w-2/4" @click="search(display)">Search</button>
                                    </div>
                                </div>
                            </x-slot>
                            <x-slot name="body">
                                <tr>
                                    <td class="text-center border-b-2 border-gray-300 px-3"></td>
                                    <td class="text-center border-b-2 border-gray-300 px-3">
                                        <input @input="setParam('route', $event.target.value)" name="route" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                    </td>
                                    <td colspan="2" class="text-center border-b-2 border-gray-300 px-3"></td>
                                    <td class="text-center border-b-2 border-gray-300 px-3">
                                        <input @input="setParam('departure', $event.target.value)" name="departure" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                    </td>
                                    <td class="text-center border-b-2 border-gray-300 px-3">
                                        <input @input="setParam('arrival', $event.target.value)" name="arrival" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                    </td>
                                    <td class="text-center border-b-2 border-gray-300 px-3">
                                        <input @input="setParam('driver', $event.target.value)" name="driver" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                    </td>
                                    <td colspan="6" class="text-center border-b-2 border-gray-300 px-3"></td>
                                </tr>
                                <template v-if="data.length > 0">
                                    <tr v-for="(trip, key) in data" :key="key" class="hover:bg-gray-100 cursor-pointer">
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            @{{trip.departure_date}}
                                        </td>
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            @{{trip.route}}
                                        </td>
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            @{{trip.bus}}
                                        </td>
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            @{{trip.services}}
                                        </td>
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            @{{trip.departure}}
                                        </td>
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            @{{trip.arrival}}
                                        </td>
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            @{{trip.driver}}
                                        </td>
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            <x-modal :hasFooter="false">
                                                <x-slot name="button">
                                                    <a href="#" class="focus:outline-none focus:shadow-outline inline-flex text-blue-400 underline" @click="toggled()">
                                                        @{{trip.total}}
                                                    </a>
                                                </x-slot>

                                                <x-slot name="title">
                                                    Passenger List
                                                </x-slot>

                                                <x-slot name="body">
                                                    <data-table v-slot="{ params, setParam, data, links, meta, next, prev }"
                                                                :searches="{{json_encode($searches)}}"
                                                                :url="trip.fetchTotalPassengerUrl"
                                                    >
                                                        <x-table :headers="$passenger_reports_header">
                                                            <x-slot name="body">
                                                                <tr>
                                                                    <td colspan="2" class="text-center border-b-2 border-gray-300 px-3"></td>
                                                                </tr>
                                                                <template v-if="data.length > 0">
                                                                    <tr v-for="(ticket, key) in data" :key="key" class="hover:bg-gray-100 cursor-pointer">
                                                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                                            @{{ticket.passenger}}
                                                                        </td>
                                                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                                            @{{ticket.seat}}
                                                                        </td>
                                                                        {{-- <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-500"> --}}
                                                                            {{-- <delete-button :url="printer.deleteUrl"></delete-button> --}}
                                                                           {{--  <a :href="printer.showUrl" class="focus:outline-none focus:shadow-outline inline-flex">
                                                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                                            </a> --}}

                                                                        {{-- </td> --}}
                                                                    </tr>
                                                                    <!--Pagination-->
                                                                    <tr>
                                                                        <td colspan="1" class="px-6 py-2 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                                            Showing @{{meta.from}} to @{{meta.to}} of @{{meta.total}}
                                                                        </td>
                                                                        <td colspan="1" class="px-6 py-2 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                                            <button @click="prev" class="relative inline-flex items-center px-4 py-2 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 disabled:opacity-50" :disabled="!links.prev">
                                                                                Previous
                                                                            </button>
                                                                            <button @click="next" class="ml-3 relative inline-flex items-center px-4 py-2 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 disabled:opacity-50" :disabled="!links.next">
                                                                                Next
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                </template>
                                                                <template v-else>
                                                                    <tr>
                                                                        <td colspan="8" class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                                            No Record . . .
                                                                        </td>
                                                                    </tr>
                                                                </template>
                                                            </x-slot>
                                                        </x-table>
                                                    </data-table>
                                                </x-slot>
                                            </x-modal>
                                        </td>
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            @{{trip.free}}
                                        </td>
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            <x-modal :hasFooter="false">
                                                <x-slot name="button">
                                                    <a href="#" class="focus:outline-none focus:shadow-outline inline-flex text-blue-400 underline" @click="toggled()">
                                                        @{{trip.sold}}
                                                    </a>
                                                </x-slot>

                                                <x-slot name="title">
                                                    Passenger List
                                                </x-slot>

                                                <x-slot name="body">
                                                    <data-table v-slot="{ params, setParam, data, links, meta, next, prev }"
                                                                :searches="{{json_encode($searches)}}"
                                                                :url="trip.fetchSoldPassengerUrl"
                                                    >
                                                        <x-table :headers="$passenger_reports_header">
                                                            <x-slot name="body">
                                                                <tr>
                                                                    <td colspan="2" class="text-center border-b-2 border-gray-300 px-3"></td>
                                                                </tr>
                                                                <template v-if="data.length > 0">
                                                                    <tr v-for="(ticket, key) in data" :key="key" class="hover:bg-gray-100 cursor-pointer">
                                                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                                            @{{ticket.passenger}}
                                                                        </td>
                                                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                                            @{{ticket.seat}}
                                                                        </td>
                                                                        {{-- <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-500"> --}}
                                                                            {{-- <delete-button :url="printer.deleteUrl"></delete-button> --}}
                                                                           {{--  <a :href="printer.showUrl" class="focus:outline-none focus:shadow-outline inline-flex">
                                                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                                            </a> --}}

                                                                        {{-- </td> --}}
                                                                    </tr>
                                                                    <!--Pagination-->
                                                                    <tr>
                                                                        <td colspan="1" class="px-6 py-2 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                                            Showing @{{meta.from}} to @{{meta.to}} of @{{meta.total}}
                                                                        </td>
                                                                        <td colspan="1" class="px-6 py-2 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                                            <button @click="prev" class="relative inline-flex items-center px-4 py-2 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 disabled:opacity-50" :disabled="!links.prev">
                                                                                Previous
                                                                            </button>
                                                                            <button @click="next" class="ml-3 relative inline-flex items-center px-4 py-2 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 disabled:opacity-50" :disabled="!links.next">
                                                                                Next
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                </template>
                                                                <template v-else>
                                                                    <tr>
                                                                        <td colspan="8" class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                                            No Record . . .
                                                                        </td>
                                                                    </tr>
                                                                </template>
                                                            </x-slot>
                                                        </x-table>
                                                    </data-table>
                                                </x-slot>
                                            </x-modal>
                                        </td>
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            <x-modal :hasFooter="false">
                                                <x-slot name="button">
                                                    <a href="#" class="focus:outline-none focus:shadow-outline inline-flex text-blue-400 underline" @click="toggled()">
                                                        @{{trip.boarded}}
                                                    </a>
                                                </x-slot>

                                                <x-slot name="title">
                                                    Passenger List
                                                </x-slot>

                                                <x-slot name="body">
                                                    <data-table v-slot="{ params, setParam, data, links, meta, next, prev }"
                                                                :searches="{{json_encode($searches)}}"
                                                                :url="trip.fetchBoardedPassengerUrl"
                                                    >
                                                        <x-table :headers="$passenger_reports_header">
                                                            <x-slot name="body">
                                                                <tr>
                                                                    <td colspan="2" class="text-center border-b-2 border-gray-300 px-3"></td>
                                                                </tr>
                                                                <template v-if="data.length > 0">
                                                                    <tr v-for="(ticket, key) in data" :key="key" class="hover:bg-gray-100 cursor-pointer">
                                                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                                            @{{ticket.passenger}}
                                                                        </td>
                                                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                                            @{{ticket.seat}}
                                                                        </td>
                                                                        {{-- <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-500"> --}}
                                                                            {{-- <delete-button :url="printer.deleteUrl"></delete-button> --}}
                                                                           {{--  <a :href="printer.showUrl" class="focus:outline-none focus:shadow-outline inline-flex">
                                                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                                            </a> --}}

                                                                        {{-- </td> --}}
                                                                    </tr>
                                                                    <!--Pagination-->
                                                                    <tr>
                                                                        <td colspan="1" class="px-6 py-2 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                                            Showing @{{meta.from}} to @{{meta.to}} of @{{meta.total}}
                                                                        </td>
                                                                        <td colspan="1" class="px-6 py-2 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                                            <button @click="prev" class="relative inline-flex items-center px-4 py-2 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 disabled:opacity-50" :disabled="!links.prev">
                                                                                Previous
                                                                            </button>
                                                                            <button @click="next" class="ml-3 relative inline-flex items-center px-4 py-2 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 disabled:opacity-50" :disabled="!links.next">
                                                                                Next
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                </template>
                                                                <template v-else>
                                                                    <tr>
                                                                        <td colspan="8" class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                                            No Record . . .
                                                                        </td>
                                                                    </tr>
                                                                </template>
                                                            </x-slot>
                                                        </x-table>
                                                    </data-table>
                                                </x-slot>
                                            </x-modal>
                                        </td>
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            
                                            <x-modal :hasFooter="false">
                                                <x-slot name="button">
                                                    <a href="#" class="focus:outline-none focus:shadow-outline inline-flex text-blue-400 underline" @click="toggled()">
                                                        @{{trip.reserved}}
                                                    </a>
                                                </x-slot>

                                                <x-slot name="title">
                                                    Passenger List
                                                </x-slot>

                                                <x-slot name="body">
                                                    <data-table v-slot="{ params, setParam, data, links, meta, next, prev }"
                                                                :searches="{{json_encode($searches)}}"
                                                                :url="trip.fetchReservedPassengerUrl"
                                                    >
                                                        <x-table :headers="$passenger_reports_header">
                                                            <x-slot name="body">
                                                                <tr>
                                                                    <td colspan="2" class="text-center border-b-2 border-gray-300 px-3"></td>
                                                                </tr>
                                                                <template v-if="data.length > 0">
                                                                    <tr v-for="(ticket, key) in data" :key="key" class="hover:bg-gray-100 cursor-pointer">
                                                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                                            @{{ticket.passenger}}
                                                                        </td>
                                                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                                            @{{ticket.seat}}
                                                                        </td>
                                                                        {{-- <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-500"> --}}
                                                                            {{-- <delete-button :url="printer.deleteUrl"></delete-button> --}}
                                                                           {{--  <a :href="printer.showUrl" class="focus:outline-none focus:shadow-outline inline-flex">
                                                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                                            </a> --}}

                                                                        {{-- </td> --}}
                                                                    </tr>
                                                                    <!--Pagination-->
                                                                    <tr>
                                                                        <td colspan="1" class="px-6 py-2 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                                            Showing @{{meta.from}} to @{{meta.to}} of @{{meta.total}}
                                                                        </td>
                                                                        <td colspan="1" class="px-6 py-2 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                                            <button @click="prev" class="relative inline-flex items-center px-4 py-2 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 disabled:opacity-50" :disabled="!links.prev">
                                                                                Previous
                                                                            </button>
                                                                            <button @click="next" class="ml-3 relative inline-flex items-center px-4 py-2 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 disabled:opacity-50" :disabled="!links.next">
                                                                                Next
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                </template>
                                                                <template v-else>
                                                                    <tr>
                                                                        <td colspan="8" class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                                            No Record . . .
                                                                        </td>
                                                                    </tr>
                                                                </template>
                                                            </x-slot>
                                                        </x-table>
                                                    </data-table>
                                                </x-slot>
                                            </x-modal>
                                        </td>
                                        
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-500">
                                            <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" @change="getPdfPassenger($event.target.value, trip.id, trip.route_id)">
                                                <option disabled selected>Select your option</option>
                                                <option value="Operators Manifest">Operators Manifest</option>
                                                <option value="Simplified Driver Manifest">Simplified Driver Manifest</option>
                                                <option value="Passenger Manifest">Passenger Manifest</option>
                                                <option value="Manifest without Stop Hours">Manifest without Stop Hours</option>
                                                <option value="Passenger Manifest with Price">Passenger Manifest with Price</option>
                                                <option value="List of All Ticket States">List of All Ticket States</option>
                                                <option value="Boarded Passenger List">Boarded Passenger List</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <!--Pagination-->
                                    <tr>
                                        <td colspan="3" class="px-6 py-2 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            Showing @{{meta.from}} to @{{meta.to}} of @{{meta.total}}
                                        </td>
                                        <td colspan="10" class="px-6 py-2 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            <button @click="prev" class="relative inline-flex items-center px-4 py-2 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 disabled:opacity-50" :disabled="!links.prev">
                                                Previous
                                            </button>
                                            <button @click="next" class="ml-3 relative inline-flex items-center px-4 py-2 text-sm leading-5 font-medium rounded-md text-gray-700 bg-white hover:text-gray-500 focus:outline-none focus:shadow-outline-blue focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 disabled:opacity-50" :disabled="!links.next">
                                                Next
                                            </button>
                                        </td>
                                    </tr>
                                </template>
                                <template v-else>
                                    <tr>
                                        <td colspan="13" class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            No Record . . .
                                        </td>
                                    </tr>
                                </template>
                            </x-slot>
                        </x-table>

                        <div class="col-span-3 sm:col-span-3">
                            <iframe src="{{ asset('storage/report.pdf') }}" class="w-full h-screen" id="pdf_viewer" v-show="viewer_show"></iframe>
                        </div>
                        </div>
                    </pdf-viewer>
                </filter-table>
            </data-table>
        </div>
    </div>
</x-app-layout>