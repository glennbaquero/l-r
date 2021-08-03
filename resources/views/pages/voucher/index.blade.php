<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">
                <span class="font-semibold mr-3">{{__('Voucher Management')}}</span>
            </div>
            {{-- <div class="flex text-base items-center">
                <a href="{{ route('voucher.create') }}" class="inline-flex font-normal items-center px-4 py-2 border border-transparent text-base leading-4 font-medium rounded-md text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue transition ease-in-out duration-150">
                    {{__('New Voucher')}}
                </a>
            </div> --}}
        </div>
        <div class="flex items-center mt-4">
            <div class="flex text-base items-center">
                <a href="{{ route('voucher.create') }}" class="inline-flex font-normal items-center px-4 py-2 border border-transparent text-base leading-4 font-medium rounded-md text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue transition ease-in-out duration-150">
                    {{__('New Voucher')}}
                </a>
            </div>
        </div>

        <div class="mt-12 mx-auto">
            <tab v-slot="{ selected, menuChangedVoucherTable }" default-selected="Amount">
                <div>
                    <div class="hidden sm:block px-5 mb-4">
                        <nav class="flex">
                            <a href="#" @click="menuChangedVoucherTable('Amount')" class="bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150  text-sm focus:outline-none" :class="selected === 'Amount' ? 'bg-darkblue bg-white text-gray-50' : ''">
                                Amount
                            </a>
                            <a href="#" @click="menuChangedVoucherTable('Max. Courtesy Ticket')" class="ml-3 bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150  text-sm focus:outline-none" :class="selected === 'Max. Courtesy Ticket' ? 'bg-darkblue bg-white text-gray-50' : ''">
                                Max. Courtesy Ticket
                            </a>
                            <a href="#" @click="menuChangedVoucherTable('Max. Ticket % Discount')" class="ml-3 bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150  text-sm focus:outline-none" :class="selected === 'Max. Ticket % Discount' ? 'bg-darkblue bg-white text-gray-50' : ''">
                                Max. Ticket % Discount
                            </a>
                        </nav>

                    </div>
                    <data-table v-slot="{ params, setParam, data, links, meta, next, prev, loading }"
                                :searches="{{json_encode($searches)}}"
                                url="{{route('voucher.fetch')}}"
                    >
                        <div>

                            {{-- Table for Amount --}}
                            <div  v-if="selected == 'Amount'">
                                <x-table :headers="$headers">
                                
                                    <x-slot name="body">
                                        <tr>
                                            <td class="text-center border-b-2 border-gray-300 px-3">
                                                <input @input="setParam('code', $event.target.value)" name="code" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                            </td>
                                            <td class="text-center border-b-2 border-gray-300 px-3"></td>

                                            <td class="text-center border-b-2 border-gray-300 px-3">
                                                <input @input="setParam('passenger', $event.target.value)" name="passenger" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                            </td>
                                            
                                            <td class="text-center border-b-2 border-gray-300 px-3" colspan="4"></td>

                                            <td class="text-center border-b-2 border-gray-300 px-3">
                                                <input @input="setParam('authorized_by', $event.target.value)" name="authorized_by" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                            </td>
                                            
                                            <td class="text-center border-b-2 border-gray-300 px-3" colspan="2"></td>
                                        </tr>
                                        <template v-if="data.length > 0">
                                            <tr v-for="(voucher, key) in data" :key="key" class="hover:bg-gray-100 cursor-pointer">
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.code}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.created_at}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.passenger}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.amount}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.amount_used}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.amount_available}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.expiration_date}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.authorized_by}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.description}}
                                                </td>

                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-500">
                                                    {{-- <delete-button :url="voucher.deleteUrl"></delete-button> --}}
                                                    <a :href="voucher.showUrl" class="focus:outline-none focus:shadow-outline inline-flex">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                    </a>

                                                </td>
                                            </tr>
                                            <!--Pagination-->
                                            <tr>
                                                <td colspan="2" class="px-6 py-2 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    Showing @{{meta.from}} to @{{meta.to}} of @{{meta.total}}
                                                </td>
                                                <td colspan="8" class="px-6 py-2 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
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
                            </div>
                            {{-- END --}}

                            {{-- Table for Max. Courtesy Ticket --}}
                            <div  v-if="selected == 'Max. Courtesy Ticket'">
                                <x-table :headers="$headers_max_courtesy_ticket">
                                    <x-slot name="body">
                                        <tr>
                                            <td class="text-center border-b-2 border-gray-300 px-3">
                                                <input @input="setParam('code', $event.target.value)" name="code" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                            </td>
                                            <td class="text-center border-b-2 border-gray-300 px-3"></td>

                                            <td class="text-center border-b-2 border-gray-300 px-3">
                                                <input @input="setParam('passenger', $event.target.value)" name="passenger" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                            </td>
                                            
                                            <td class="text-center border-b-2 border-gray-300 px-3" colspan="3"></td>

                                            <td class="text-center border-b-2 border-gray-300 px-3">
                                                <input @input="setParam('authorized_by', $event.target.value)" name="authorized_by" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                            </td>
                                            
                                            <td class="text-center border-b-2 border-gray-300 px-3" colspan="2"></td>
                                        </tr>
                                        <template v-if="data.length > 0">
                                            <tr v-for="(voucher, key) in data" :key="key" class="hover:bg-gray-100 cursor-pointer">
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.code}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.created_at}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.passenger}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.no_of_ticket_courtesy_used}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.no_of_ticket_courtesy_available}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.expiration_date}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.authorized_by}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.description}}
                                                </td>

                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-500">
                                                    {{-- <delete-button :url="voucher.deleteUrl"></delete-button> --}}
                                                    <a :href="voucher.showUrl" class="focus:outline-none focus:shadow-outline inline-flex">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                    </a>

                                                </td>
                                            </tr>
                                            <!--Pagination-->
                                            <tr>
                                                <td colspan="2" class="px-6 py-2 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    Showing @{{meta.from}} to @{{meta.to}} of @{{meta.total}}
                                                </td>
                                                <td colspan="8" class="px-6 py-2 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
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
                            </div>
                            {{-- END --}}


                            {{-- Table for Max. Ticket % Discount --}}
                            <div v-if="selected == 'Max. Ticket % Discount'">
                                <x-table :headers="$headers_discount">
                                    <x-slot name="body">
                                        <tr>
                                            <td class="text-center border-b-2 border-gray-300 px-3">
                                                <input @input="setParam('code', $event.target.value)" name="code" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                            </td>
                                            <td class="text-center border-b-2 border-gray-300 px-3"></td>

                                            <td class="text-center border-b-2 border-gray-300 px-3">
                                                <input @input="setParam('passenger', $event.target.value)" name="passenger" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                            </td>
                                            
                                            <td class="text-center border-b-2 border-gray-300 px-3" colspan="5"></td>

                                            <td class="text-center border-b-2 border-gray-300 px-3">
                                                <input @input="setParam('authorized_by', $event.target.value)" name="authorized_by" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                            </td>
                                            
                                            <td class="text-center border-b-2 border-gray-300 px-3" colspan="2"></td>
                                        </tr>
                                        <template v-if="data.length > 0">
                                            <tr v-for="(voucher, key) in data" :key="key" class="hover:bg-gray-100 cursor-pointer">
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.code}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.created_at}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.passenger}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.discount_percent}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.max_no_of_discount_ticket}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.no_of_discount_ticket_used}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.no_of_discount_ticket_avaiable}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.expiration_date}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.authorized_by}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{voucher.description}}
                                                </td>

                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-500">
                                                    {{-- <delete-button :url="voucher.deleteUrl"></delete-button> --}}
                                                    <a :href="voucher.showUrl" class="focus:outline-none focus:shadow-outline inline-flex">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                    </a>

                                                </td>
                                            </tr>
                                            <!--Pagination-->
                                            <tr>
                                                <td colspan="2" class="px-6 py-2 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    Showing @{{meta.from}} to @{{meta.to}} of @{{meta.total}}
                                                </td>
                                                <td colspan="8" class="px-6 py-2 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
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
                            </div>
                            
                            {{-- END --}}
                        </div>
                        
                    </data-table>
                </div>
                
            </tab>
        </div>
    </div>
</x-app-layout>