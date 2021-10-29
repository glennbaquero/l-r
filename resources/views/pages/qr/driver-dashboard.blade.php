<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6 text-sm p-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">
                <span class="">{{__('Welcome')}}</span>
                <span class="font-semibold">{{auth()->user()->fullname}}</span>,
            </div>
        </div>

        <div class="mt-10">
            <x-modal :hasFooter="false" maxWidth="max-w-4xl text-black">
                <x-slot name="button">
                    <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-full" @click="toggled">
                        Open QR Scanner
                    </button>
                </x-slot>

                <x-slot name="title">
                    Scan QR
                </x-slot>

                <x-slot name="body">
                    <qr-scanner></qr-scanner>
                </x-slot>
            </x-modal>
        </div>

        <div class="mt-2">
            <x-modal :hasFooter="false" maxWidth="max-w-4xl text-black">
                <x-slot name="button">
                    <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-full" @click="toggled">
                        Enter Transaction/Reference Number or Ticket Number
                    </button>
                </x-slot>

                {{-- <x-slot name="title">
                    Transaction/Reference Number or Ticket Number
                </x-slot> --}}

                <x-slot name="body">
                    <enter-transaction-number
                        url="{{ route('driver.validate-transaction-number') }}"
                    ></enter-transaction-number>
                </x-slot>
            </x-modal>
        </div>

        <div class="mt-12 mx-auto">
            <data-table v-slot="{ params, setParam, data, links, meta, next, prev, loading }"
                        :searches="{{json_encode($searches)}}"
                        url="{{route('ticket.fetch')}}"
            >
                <filter-table v-slot="{ toggledState, display, search, field, searchWithoutDate }">
                    <x-table :headers="$headers">
                        <x-slot name="body">
                            <tr>
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('ticket_number', $event.target.value)" name="ticket_number" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('passenger', $event.target.value)" name="passenger" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('departure', $event.target.value)" name="departure" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('arrival', $event.target.value)" name="arrival" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                <td colspan="2" class="text-center border-b-2 border-gray-300 px-3"></td>
                            </tr>
                            <template v-if="data.length > 0">
                                <tr v-for="(ticket, key) in data" :key="key" class="hover:bg-gray-100 cursor-pointer">
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.ticket_number}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.passenger}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.departure}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.arrival}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.seat}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.status}}
                                    </td>
                                </tr>
                                <!--Pagination-->
                                <tr>
                                    <td colspan="2" class="px-6 py-2 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        Showing @{{meta.from}} to @{{meta.to}} of @{{meta.total}}
                                    </td>
                                    <td colspan="9" class="px-6 py-2 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
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
                                    <td colspan="10" class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
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
