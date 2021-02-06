<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">
                <span class="font-semibold mr-3">{{__('Office Management')}}</span>
            </div>
            <div class="flex text-base items-center">
                <button type="button" class="inline-flex font-normal items-center px-4 py-2 border border-transparent text-base leading-4 font-medium rounded-md text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue transition ease-in-out duration-150 mr-3">
                    {{__('New Office')}}
                </button>
                <button type="button" class="inline-flex font-normal items-center px-4 py-2 border border-transparent text-base leading-4 font-medium rounded-md text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue transition ease-in-out duration-150">
                    {{__('Allocation of Manual Tickets')}}
                </button>
            </div>
        </div>

        <div class="mt-12 mx-auto">
            <data-table v-slot="{ params, setParam, data, links, meta, next, prev }"
                        :searches="{{json_encode($searches)}}"
                        url="{{route('office.fetch')}}"
            >
                <x-table :headers="$headers">
                    <x-slot name="body">
                        <tr>
                            <td class="text-center border-b-2 border-gray-300 px-3">
                                <input @input="setParam('office_no', $event.target.value)" name="office_no" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                            </td>
                            <td class="text-center border-b-2 border-gray-300 px-3">
                                <input @input="setParam('name', $event.target.value)" name="name" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                            </td>
                            <td class="text-center border-b-2 border-gray-300 px-3">
                                <input @input="setParam('address', $event.target.value)" name="address" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                            </td>
                            <td class="text-center border-b-2 border-gray-300 px-3">
                                <input @input="setParam('phone_number', $event.target.value)" name="phone_number" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                            </td>
                            <td class="text-center border-b-2 border-gray-300 px-3">
                                <input @input="setParam('city', $event.target.value)" name="city" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                            </td>
                            <td class="text-center border-b-2 border-gray-300 px-3">
                                <input @input="setParam('state', $event.target.value)" name="state" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                            </td>
                            <td class="text-center border-b-2 border-gray-300 px-3">
                                <input @input="setParam('office_type', $event.target.value)" name="office_type" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                            </td>
                            <td colspan="2" class="border-b-2 border-gray-300"></td>
                        </tr>
                        <template v-if="data.length > 0">
                            <tr v-for="(office, key) in data" :key="key" class="hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{office.office_no}}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{office.name}}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{office.address_line_1}}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{office.phone_number}}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{office.city}}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{office.state}}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{office.office_type}}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{office.status}}
                                </td>
                                <td class="px-6 py-4 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{office.office_no}}
                                </td>
                            </tr>
                            <!--Pagination-->
                            <tr>
                                <td colspan="7" class="px-6 py-4 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    Showing @{{meta.from}} to @{{meta.to}} of @{{meta.total}}
                                </td>
                                <td colspan="2" class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
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
                                <td colspan="9" class="px-6 py-4 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
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