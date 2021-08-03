<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">
                <span class="font-semibold mr-3">{{__('Route and Main Driver')}}</span>
            </div>
           {{--  <div class="flex text-base items-center">
                <a href="{{ route('route-main-driver.create') }}" class="inline-flex font-normal items-center px-4 py-2 border border-transparent text-base leading-4 font-medium rounded-md text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue transition ease-in-out duration-150">
                    {{__('New Route and Main Driver')}}
                </a>
            </div> --}}
        </div>
        <div class="flex items-center mt-4">
            <div class="flex text-base items-center">
                <a href="{{ route('route-main-driver.create') }}" class="inline-flex font-normal items-center px-4 py-2 border border-transparent text-base leading-4 font-medium rounded-md text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue transition ease-in-out duration-150">
                    {{__('New Route and Main Driver')}}
                </a>
            </div>
        </div>

        <div class="mt-12 mx-auto">
            <tab v-slot="{ selected, menuChanged }" default-selected="Ticket of Route">
                <div>
                    <div class="hidden sm:block px-5 mb-4">
                        <nav class="flex">
                            <a href="#" @click="menuChanged('Ticket of Route')" class="bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150  text-sm focus:outline-none" :class="selected === 'Ticket of Route' ? 'bg-darkblue bg-white text-gray-50' : ''">
                                Ticket of Route
                            </a>
                            <a href="#" @click="menuChanged('Voucher of Route')" class="ml-3 bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150  text-sm focus:outline-none" :class="selected === 'Voucher of Route' ? 'bg-darkblue bg-white text-gray-50' : ''">
                                Voucher of Route
                            </a>
                            <a href="#" @click="menuChanged('Excess Luggage of Route')" class="ml-3 bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150  text-sm focus:outline-none" :class="selected === 'Excess Luggage of Route' ? 'bg-darkblue bg-white text-gray-50' : ''">
                                Excess Luggage of Route
                            </a>
                        </nav>

                    </div>
                    <data-table v-slot="{ params, setParam, data, links, meta, next, prev, loading }"
                                :searches="{{json_encode($searches)}}"
                                url="{{route('route-main-driver.fetch')}}"
                    >
                        <div>

                            {{-- Table for Ticket of Route --}}
                            <div  v-if="selected == 'Ticket of Route'">
                                <x-table :headers="$headers">
                                
                                    <x-slot name="body">
                                        <tr>
                                            <td class="text-center border-b-2 border-gray-300 px-3" colspan="13"></td>
                                        </tr>
                                        <template v-if="data.length > 0">
                                            <tr v-for="(item, key) in data" :key="key" class="hover:bg-gray-100 cursor-pointer">
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.code_reference}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.departure}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.arrival}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.driver}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.issue_date}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.seat}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.travel_date}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.seat}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.series}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.correlative}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.price}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.currency}}
                                                </td>

                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-500">
                                                    <delete-button :url="item.deleteUrl"></delete-button>
                                                    <a :href="item.showUrl" class="focus:outline-none focus:shadow-outline inline-flex">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                    </a>

                                                </td>
                                            </tr>
                                            <!--Pagination-->
                                            <tr>
                                                <td colspan="2" class="px-6 py-2 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    Showing @{{meta.from}} to @{{meta.to}} of @{{meta.total}}
                                                </td>
                                                <td colspan="11" class="px-6 py-2 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
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

                            {{-- Table for Voucher of Route --}}
                            <div  v-if="selected == 'Voucher of Route'">
                                <x-table :headers="$headers_voucher_route">
                                    <x-slot name="body">
                                        <tr>
                                            <td class="text-center border-b-2 border-gray-300 px-3" colspan="11"></td>
                                        </tr>
                                        <template v-if="data.length > 0">
                                            <tr v-for="(item, key) in data" :key="key" class="hover:bg-gray-100 cursor-pointer">
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.code_reference}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.issued_date}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.state}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.document_type}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.voucher_type}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.description}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.series}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.correlative}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.price}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.currency}}
                                                </td>

                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-500">
                                                    {{-- <delete-button :url="item.deleteUrl"></delete-button> --}}
                                                    <a :href="item.showUrl" class="focus:outline-none focus:shadow-outline inline-flex">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                    </a>

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
                            </div>
                            {{-- END --}}


                            {{-- Table for Excess Luggage of Route --}}
                            <div v-if="selected == 'Excess Luggage of Route'">
                                <x-table :headers="$headers_excess_luggage">
                                    <x-slot name="body">
                                        <tr>
                                            <td class="text-center border-b-2 border-gray-300 px-3" colspan="9"></td>
                                        </tr>
                                        <template v-if="data.length > 0">
                                            <tr v-for="(item, key) in data" :key="key" class="hover:bg-gray-100 cursor-pointer">
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.issued_date}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.state}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.document_type}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.description}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.series}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.correlative}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.price}}
                                                </td>
                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                                    @{{item.currency}}
                                                </td>

                                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-500">
                                                    {{-- <delete-button :url="item.deleteUrl"></delete-button> --}}
                                                    <a :href="item.showUrl" class="focus:outline-none focus:shadow-outline inline-flex">
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
                            </div>
                            
                            {{-- END --}}
                        </div>
                        
                    </data-table>
                </div>
                
            </tab>
        </div>
    </div>
</x-app-layout>