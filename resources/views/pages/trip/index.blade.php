<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">
                <span class="font-semibold mr-3">{{__('Trip Management')}}</span>
            </div>
            {{-- <div class="flex text-base items-center mr-3">
                <a href="{{ route('trip.create') }}" class="inline-flex font-normal items-center px-4 py-2 border border-transparent text-base leading-4 font-medium rounded-md text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue transition ease-in-out duration-150">
                    {{__('New Trip')}}
                </a>
            </div>
            <div class="flex text-base items-center">
                <a href="{{ route('travel-schedule.create') }}" class="inline-flex font-normal items-center px-4 py-2 border border-transparent text-base leading-4 font-medium rounded-md text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue transition ease-in-out duration-150">
                    {{__('New Travel Schedule')}}
                </a>
            </div> --}}
        </div>
        <div class="flex items-center mt-4">
            <div class="flex text-base items-center mr-3">
                <a href="{{ route('trip.create') }}" class="inline-flex font-normal items-center px-4 py-2 border border-transparent text-base leading-4 font-medium rounded-md text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue transition ease-in-out duration-150">
                    {{__('New Trip')}}
                </a>
            </div>
            <div class="flex text-base items-center">
                <a href="{{ route('travel-schedule.create') }}" class="inline-flex font-normal items-center px-4 py-2 border border-transparent text-base leading-4 font-medium rounded-md text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue transition ease-in-out duration-150">
                    {{__('New Travel Schedule')}}
                </a>
            </div>
        </div>

        <div class="mt-12 mx-auto">
            <data-table v-slot="{ params, setParam, data, links, meta, next, prev, loading }"
                        :searches="{{json_encode($searches)}}"
                        url="{{route('trip.fetch')}}"
            >
                <filter-table v-slot="{ toggledState, display, search, field }">

                    <x-table :headers="$headers">
                        <x-slot name="filter">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-1/4 sm:col-span-1/4">
                                    <x-label for="departure" class="font-semibold">Departure City</x-label>
                                    <x-select :lists="$cities" name="departure" v-model="field.departure_id"/>
                                </div>
                                <div class="col-span-1/4 sm:col-span-1/4">
                                    <x-label for="arrival" class="font-semibold">Arrival City</x-label>
                                    <x-select :lists="$cities" name="arrival" v-model="field.arrival_id"/>
                                </div>
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
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('id', $event.target.value)" name="id" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('route', $event.target.value)" name="route" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('alias', $event.target.value)" name="alias" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                {{-- <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('bus', $event.target.value)" name="bus" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td> --}}
                                {{-- <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('driver', $event.target.value)" name="driver" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td> --}}
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('date', $event.target.value)" name="date" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                {{-- <td class="text-center border-b-2 border-gray-300 px-3"></td> --}}
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('departure', $event.target.value)" name="departure" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('arrival', $event.target.value)" name="arrival" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                
                                <td class="text-center border-b-2 border-gray-300 px-3"></td>
                            </tr>
                            <template v-if="data.length > 0">
                                <tr v-for="(trip, key) in data" :key="key" class="hover:bg-gray-100 cursor-pointer">
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{trip.id}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{trip.route}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{trip.alias}}
                                    </td>
                                    {{-- <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{trip.bus}}
                                    </td> --}}
                                   {{--  <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{trip.driver}}
                                    </td> --}}
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{trip.date}}
                                    </td>
                                    {{-- <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{trip.time}}
                                    </td> --}}
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{trip.departure}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{trip.arrival}}
                                    </td>
                              
                                   
                                    <td class="px-6 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium text-gray-500 flex py-5">
                                        <delete-button :url="trip.deleteUrl"></delete-button>
                                        <a :href="trip.showUrl" class="focus:outline-none focus:shadow-outline inline-flex">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>

                                    </td>
                                </tr>
                                <!--Pagination-->
                                <tr>
                                    <td colspan="2" class="px-6 py-2 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        Showing @{{meta.from}} to @{{meta.to}} of @{{meta.total}}
                                    </td>
                                    <td colspan="7" class="px-6 py-2 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
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
                                    <td colspan="9" class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        No Record . . .
                                    </td>
                                </tr>
                            </template>
                        </x-slot>
                    </x-table>
                </filter-table>
            </data-table>
        </div>
    </div>
</x-app-layout>