<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">
                <span class="font-semibold mr-3">{{__('Frequent Traveler')}}</span>
            </div>
        </div>

        <div class="mt-12 mx-auto">
            <data-table v-slot="{ params, setParam, data, links, meta, next, prev, loading }"
                        :searches="{{json_encode($searches)}}"
                        url="{{route('frequent-traveler.fetch')}}"
            >
                <filter-table v-slot="{ toggledState, display, search, field }">

                    <x-table :headers="$headers">
                        {{-- <x-slot name="filter">
                            <tab v-slot="{ selected, menuChangedFrequentTraveler }" default-selected="all">
                                <div class="hidden sm:block mb-3 px-2">
                                    <nav class="flex">
                                        <a href="#" @click="menuChangedFrequentTraveler('all')" class="ml-3 bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150  text-sm focus:outline-none" :class="selected === 'all' ? 'bg-darkblue bg-white text-gray-50' : ''">
                                            All
                                        </a>
                                        <a href="#" @click="menuChangedFrequentTraveler('solo')" class="ml-3 bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150  text-sm focus:outline-none" :class="selected === 'solo' ? 'bg-darkblue bg-white text-gray-50' : ''">
                                            Solo Passenger
                                        </a>
                                        <a href="#" @click="menuChangedFrequentTraveler('student')" class="ml-3 bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150  text-sm focus:outline-none" :class="selected === 'student' ? 'bg-darkblue bg-white text-gray-50' : ''">
                                            Solo Student
                                        </a>
                                    </nav>
                                </div>
                            </tab>
                        </x-slot> --}}
                        <x-slot name="body">
                            <tr>
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('name', $event.target.value)" name="name" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('email', $event.target.value)" name="email" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('phone_number', $event.target.value)" name="phone_number" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                <td colspan="2" class="text-center border-b-2 border-gray-300 px-3"></td>
                            </tr>
                            <template v-if="data.length > 0">
                                <tr v-for="(passenger, key) in data" :key="key" class="hover:bg-gray-100 cursor-pointer">
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{passenger.fullname}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{passenger.email}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{passenger.phone_number}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{passenger.f_creation}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        <x-modal :hasFooter="false" maxWidth="max-w-screen-md">
                                            <x-slot name="button">
                                                <a href="#" class="focus:outline-none focus:shadow-outline inline-flex" @click="toggled">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </a>
                                                <x-slot name="title">
                                                    Passenger Information
                                                </x-slot>
                                                <x-slot name="body">
                                                    <div class="grid grid-cols-5 gap-4">
                                                        <div class="col-span-2 sm:col-span-2">
                                                            <x-label class="font-semibold">First name</x-label>
                                                            <x-form-input type="text" v-model="passenger.first_name" readOnly="true"/>
                                                        </div>
                                                        <div class="col-span-2 sm:col-span-2">
                                                            <x-label class="font-semibold">Last name</x-label>
                                                            <x-form-input type="text" v-model="passenger.last_name" readOnly="true" />
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-label class="font-semibold">Gender</x-label>
                                                            <x-form-input type="text" v-model="passenger.gender" readOnly="true" />
                                                        </div>
                                                        <div class="col-span-3 sm:col-span-3">
                                                            <x-label class="font-semibold">Email</x-label>
                                                            <x-form-input type="text" v-model="passenger.email" readOnly="true" />
                                                        </div>
                                                        <div class="col-span-2 sm:col-span-2">
                                                            <x-label class="font-semibold">Phone number</x-label>
                                                            <x-form-input type="text" v-model="passenger.phone_number" readOnly="true" />
                                                        </div>
                                                    </div>
                                                </x-slot>
                                            </x-slot>
                                        </x-modal>
                                    </td>
                                </tr>
                                <!--Pagination-->
                                <tr>
                                    <td colspan="2" class="px-6 py-2 whitespace-no-wrap text-left border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        Showing @{{meta.from}} to @{{meta.to}} of @{{meta.total}}
                                    </td>
                                    <td colspan="6" class="px-6 py-2 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
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
                </filter-table>
            </data-table>
        </div>
    </div>
</x-app-layout>