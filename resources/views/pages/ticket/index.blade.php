<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">
                <span class="font-semibold mr-3">{{__('Ticket Management')}}</span>
            </div>
            {{-- <div class="flex text-base items-center">
                <x-modal :hasFooter="false" maxWidth="max-w-4xl">
                    <x-slot name="button">
                        <a href="#" class="inline-flex font-normal items-center px-4 py-2 border border-transparent text-base leading-4 font-medium rounded-md text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue transition ease-in-out duration-150" @click="toggled()">
                            {{__('New Ticket')}}
                        </a>
                    </x-slot>

                    <x-slot name="body">
                        <ticket
                            :cities="{{ $cities }}"
                            :ticket_types="{{ $ticket_types }}"
                            find-available-trip-url="{{ route('ticket.find-available-trip') }}"
                            fetch-bus-url="{{ route('ticket.fetch-bus') }}"
                            search-passenger-url="{{ route('ticket.fetch-passengers') }}"
                            payment-form-url="{{ route('ticket.store') }}"
                            voucher-validate-url="{{ route('ticket.voucher-validate') }}"
                        ></ticket>
                    </x-slot>

                </x-modal>
            </div>--}}
        </div>
        <div class="flex items-center mt-4">
            <div class="flex text-base items-center">
                <x-modal :hasFooter="false" maxWidth="max-w-4xl" :enableDisplay="true">
                    <x-slot name="button">
                        <a href="#" class="inline-flex font-normal items-center px-4 py-2 border border-transparent text-base leading-4 font-medium rounded-md text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue transition ease-in-out duration-150" @click="toggled()">
                            {{__('New Ticket')}}
                        </a>
                    </x-slot>

                    <x-slot name="body">
                        <ticket
                            :cities="{{ $cities }}"
                            :ticket_types="{{ $ticket_types }}"
                            find-available-trip-url="{{ route('ticket.find-available-trip') }}"
                            fetch-bus-url="{{ route('ticket.fetch-bus') }}"
                            search-passenger-url="{{ route('ticket.fetch-passengers') }}"
                            payment-form-url="{{ route('ticket.store') }}"
                            voucher-validate-url="{{ route('ticket.voucher-validate') }}"
                            :office-id="{{ auth()->user()->office->departure->id }}"
                        ></ticket>
                    </x-slot>

                </x-modal>
            </div>
        </div>

        <div class="mt-12 mx-auto">
            <data-table v-slot="{ params, setParam, data, links, meta, next, prev, selectAllHandler, loading }"
                        :searches="{{json_encode($searches)}}"
                        url="{{route('ticket.fetch')}}"
            >
                <x-table :headers="$headers" canSelectMultiple="true">
                    <x-slot name="body">
                        <tr>
                            <td class="text-center border-b-2 border-gray-300 px-3">
                            </td>
                            <td class="text-center border-b-2 border-gray-300 px-3">
                                <input @input="setParam('departure', $event.target.value)" name="departure" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                            </td>
                            <td class="text-center border-b-2 border-gray-300 px-3">
                                <input @input="setParam('arrival', $event.target.value)" name="arrival" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                            </td>
                            <td class="text-center border-b-2 border-gray-300 px-3">
                                <input type="date" @input="setParam('travel_date', $event.target.value)" class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" />
                            </td>
                            <td colspan="1" class="text-center border-b-2 border-gray-300 px-3"></td>
                            <td class="text-center border-b-2 border-gray-300 px-3">
                                <input @input="setParam('passenger', $event.target.value)" name="passenger" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                            </td>
                            <td colspan="3" class="text-center border-b-2 border-gray-300 px-3"></td>
                        </tr>
                        <template v-if="data.length > 0">
                            <tr v-for="(ticket, key) in data" :key="key" class="hover:bg-gray-100 cursor-pointer">
                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    <input type="checkbox" class="inline-flex duration-150 ease-in-out focus:border-blue-300 focus:outline-none focus:shadow-outline-blue form-input leading-none mx-auto my-3 rounded shadow-sm transition" v-model="ticket.is_selected">
                                </td>
                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{ticket.departure}}
                                </td>
                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{ticket.arrival}}
                                </td>
                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{ticket.travel_date}}
                                </td>
                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{ticket.seat}}
                                </td>
                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{ticket.passenger}}
                                </td>
                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{ticket.type}}
                                </td>
                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{ticket.price}}
                                </td>
                                {{-- <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{ticket.t_or}}
                                </td>
                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{ticket.t_des}}
                                </td> --}}

                                <td class="px-6 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 font-medium text-gray-500 flex py-5">
                                    <a title="Print Ticket" :href="ticket.printUrl" target="_blank" class="focus:outline-none focus:shadow-outline inline-flex">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                    </a>
                                    {{-- <a title="Cancel Ticket" :href="ticket.cancelUrl" class="focus:outline-none focus:shadow-outline inline-flex" v-if="!ticket.is_cancelled">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </a> --}}

                                    <x-modal :hasFooter="false" maxWidth="max-w-4xl">
                                        <x-slot name="button">
                                            <a title="Edit Ticket" href="#" class="focus:outline-none focus:shadow-outline inline-flex" @click="toggled()">
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                                            </a>
                                        </x-slot>

                                        <x-slot name="body">
                                            <ticket
                                                :edit="true"
                                                :selected-ticket="ticket"
                                                :cities="{{ $cities }}"
                                                :ticket_types="{{ $ticket_types }}"
                                                :update-url="ticket.updateUrl"
                                                find-available-trip-url="{{ route('ticket.find-available-trip') }}"
                                                fetch-bus-url="{{ route('ticket.fetch-bus') }}"
                                                search-passenger-url="{{ route('ticket.fetch-passengers') }}"
                                                payment-form-url="{{ route('ticket.store') }}"
                                                voucher-validate-url="{{ route('ticket.voucher-validate') }}"
                                            ></ticket>
                                        </x-slot>

                                    </x-modal>
                                    {{-- <a title="Change Payment Type" :href="ticket.cancelUrl" class="focus:outline-none focus:shadow-outline inline-flex">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                                    </a> --}}
                                    {{-- <a title="Change Ticket Seat" :href="ticket.cancelUrl" class="focus:outline-none focus:shadow-outline inline-flex">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 12a1 1 0 102 0V6.414l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L5 6.414V12zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"></path></svg>
                                    </a> --}}

                                    <x-modal :hasFooter="false" maxWidth="max-w-4xl">
                                        <x-slot name="button">
                                            <a title="Send Email" href="#" class="focus:outline-none focus:shadow-outline inline-flex" @click="toggled()">
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M14.243 5.757a6 6 0 10-.986 9.284 1 1 0 111.087 1.678A8 8 0 1118 10a3 3 0 01-4.8 2.401A4 4 0 1114 10a1 1 0 102 0c0-1.537-.586-3.07-1.757-4.243zM12 10a2 2 0 10-4 0 2 2 0 004 0z" clip-rule="evenodd"></path></svg>
                                            </a>
                                        </x-slot>

                                        <x-slot name="title">
                                            Email Passenger
                                        </x-slot>

                                        <x-slot name="body">
                                            <form-data v-slot="{ actionHandler, payload, result }" :url="ticket.sendEmailUrl">
                                                <div>
                                                    <loading></loading>
                                                    <div class="grid grid-cols-6 gap-6">
                                                        <div class="col-span-3 sm:col-span-3">
                                                            <x-label for="subject" class="font-semibold">Subject</x-label>
                                                            <x-form-input type="text" name="subject" id="subject" v-model="payload.subject" />
                                                        </div>

                                                        <div class="col-span-full sm:col-span-full">
                                                            <x-label for="message" class="font-semibold">Message</x-label>
                                                            <x-text-area name="message" id="message" v-model="payload.message"/>
                                                        </div>
                                                    </div>
                                                    <div class="mt-5 text-right">
                                                        <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36" @click="actionHandler">
                                                            Send
                                                        </button>
                                                    </div>
                                                </div>
                                            </form-data>
                                        </x-slot>

                                    </x-modal>
                                    {{-- <a title="Ticket Info" :href="ticket.cancelUrl" class="focus:outline-none focus:shadow-outline inline-flex">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                                    </a> --}}
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
            </data-table>
        </div>
    </div>
</x-app-layout>