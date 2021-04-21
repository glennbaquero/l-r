<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">
                <span class="font-semibold mr-3">{{__('Group Privileges Management')}}</span>
            </div>
            {{-- <div class="flex text-base items-center">
                <a href="{{ route('group-privilege.create') }}" class="inline-flex font-normal items-center px-4 py-2 border border-transparent text-base leading-4 font-medium rounded-md text-white bg-lightblue hover:bg-lighterblue focus:outline-none focus:border-lighterblue focus:shadow-outline-lighterblue active:bg-lighterblue transition ease-in-out duration-150">
                    {{__('New Privilege')}}
                </a>
            </div> --}}
        </div>

        <div class="mt-12 mx-auto">
            <data-table v-slot="{ params, setParam, data, links, meta, next, prev, loading }"
                        :searches="{{json_encode($searches)}}"
                        url="{{route('group-privilege.fetch')}}"
            >
                <x-table :headers="$headers">
                    <x-slot name="body">
                        <tr>
                            <td class="text-center border-b-2 border-gray-300 px-3">
                                <input @input="setParam('menu', $event.target.value)" name="menu" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                            </td>
                            <td colspan="{{ count($headers) }}" class="text-center border-b-2 border-gray-300 px-3"></td>
                        </tr>
                        <template v-if="data.length > 0">
                            <tr v-for="(privilege, key) in data" :key="key" class="hover:bg-gray-100 cursor-pointer">
                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{privilege.menu}}
                                </td>

                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900" v-for="value in privilege.group_values">
                                    <toggle v-slot="{ update }">
                                        <span @click="update('group-privilege/update/'+value.id+'/'+privilege.id)" :class="{ 'bg-red-500': !value.selected, 'bg-green-500': value.selected }" class="relative inline-block flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:shadow-outline" role="checkbox" tabindex="0">
                                            <span aria-hidden="true" :class="{'-ml-5': !value.selected, 'ml-5': value.selected}" class="inline-block h-5 w-5 rounded-full bg-white shadow transform transition ease-in-out duration-200"></span>
                                        </span>
                                    </toggle>
                                </td>
                                
                            </tr>

                            <!--Pagination-->
                            <tr>
                                <td colspan="5" class="px-6 py-2 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    Showing @{{meta.from}} to @{{meta.to}} of @{{meta.total}}
                                </td>
                                <td colspan="2" class="px-6 py-2 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
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
                                <td colspan="{{ count($headers) }}" class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
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