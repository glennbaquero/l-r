<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">
                <span class="font-semibold mr-3">{{__('Tickets Support')}}</span>
            </div>
        </div>

        <div class="mt-12 mx-auto">
            <data-table v-slot="{ params, setParam, data, links, meta, next, prev, loading }"
                        :searches="{{json_encode($searches)}}"
                        url="{{route('ticket-support.fetch')}}"
            >
                <filter-table v-slot="{ toggledState, display, search, field, ticketSupportSearch }">
                    <x-table :headers="$headers">
                        <x-slot name="filter">
                            <tab v-slot="{ selected, menuChanged }" default-selected="User Registration">
                                <div class="hidden sm:block ml-16 px-5">
                                    <nav class="flex">
                                        <a href="#" @click="menuChanged('Ticket ID')" class="bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150  text-sm focus:outline-none" :class="selected === 'Ticket ID' ? 'bg-darkblue bg-white text-gray-50' : ''">
                                            Ticket ID
                                        </a>
                                        <a href="#" @click="menuChanged('Document # or Name')" class="ml-3 bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150  text-sm focus:outline-none" :class="selected === 'Document # or Name' ? 'bg-darkblue bg-white text-gray-50' : ''">
                                            Document # or Name
                                        </a>
                                        <a href="#" @click="menuChanged('Web Code')" class="ml-3 bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150  text-sm focus:outline-none" :class="selected === 'Web Code' ? 'bg-darkblue bg-white text-gray-50' : ''">
                                            Web Code
                                        </a>
                                        <a href="#" @click="menuChanged('# Voucher')" class="ml-3 bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150  text-sm focus:outline-none" :class="selected === '# Voucher' ? 'bg-darkblue bg-white text-gray-50' : ''">
                                            # Voucher
                                        </a>
                                        <a href="#" @click="menuChanged('Agent')" class="ml-3 bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150  text-sm focus:outline-none" :class="selected === 'Agent' ? 'bg-darkblue bg-white text-gray-50' : ''">
                                            Agent
                                        </a>
                                        <a href="#" @click="menuChanged('User Registration')" class="ml-3 bg-white inline-flex items-center px-6 py-3 border border-darkblue text-base leading-6 font-medium rounded-md focus:outline-none focus:border-darkblue focus:shadow-outline-blue  transition ease-in-out duration-150  text-sm focus:outline-none" :class="selected === 'User Registration' ? 'bg-darkblue bg-white text-gray-50' : ''">
                                            User Registration
                                        </a>
                                    </nav>

                                    <div class="px-5 py-5" v-if="selected === 'User Registration'">
                                        <div class="grid grid-cols-5 gap-2">
                                            <div class="col-span-1 sm:col-span-1">
                                                <x-label for="name" class="font-semibold">Username</x-label>
                                                <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-model="field.user">
                                                    <option disabled selected>Select your option</option>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->fullname }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-span-1 sm:col-span-1">
                                                <x-label for="name" class="font-semibold">Date Box</x-label>
                                                <input type="date" v-model="field.date_box" class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" />
                                            </div>
                                            <div class="col-span-1 sm:col-span-1">
                                                <x-label for="name" class="font-semibold">Purchase Date</x-label>
                                                <input type="date" v-model="field.purchase_date" class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" />
                                            </div>
                                            <div class="col-span-1 sm:col-span-1">
                                                <x-label for="name" class="font-semibold">Ticket State</x-label>
                                                <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-model="field.state">
                                                    <option disabled selected>Select your option</option>
                                                    <option value="Todos">Todos</option>
                                                    <option value="Normal">Normal</option>
                                                    <option value="Cancelled">Cancelled</option>
                                                    <option value="Reservation Canceled">Reservation Canceled</option>
                                                    <option value="Expired">Expired</option>
                                                    <option value="Opened">Opened</option>
                                                    <option value="Open Expired">Open Expired</option>
                                                    <option value="Reserved">Reserved</option>
                                                    <option value="Reserve Expired">Reserve Expired</option>
                                                    <option value="Sold out">Sold out</option>
                                                    <option value="Agent Sold">Agent Sold</option>
                                                    <option value="Approached">Approached</option>
                                                    <option value="No Approached">No Approached</option>
                                                    <option value="Reprinted">Reprinted</option>
                                                    <option value="Courtesy">Courtesy</option>
                                                    <option value="Selected">Selected</option>
                                                    <option value="Used">Used</option>
                                                    <option value="Externally Transferred">Externally Transferred</option>
                                                    <option value="Web sale">Web sale</option>
                                                </select>
                                            </div>
                                            <div class="col-span-1 mx-auto my-auto sm:col-span-1">
                                                <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36" @click="ticketSupportSearch">
                                                    Search
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-5 py-5" v-if="selected != 'User Registration'">
                                        <div class="grid grid-cols-5 gap-2">
                                            <div class="col-span-1 sm:col-span-1" v-if="selected === 'Agent'">
                                                <x-label for="name" class="font-semibold">Search</x-label>
                                                <x-form-input v-model="field.agent"/>
                                            </div>
                                            <div class="col-span-1 sm:col-span-1" v-if="selected === '# Voucher'">
                                                <x-label for="name" class="font-semibold">Search</x-label>
                                                <x-form-input v-model="field.voucher"/>
                                            </div>
                                            <div class="col-span-1 sm:col-span-1" v-if="selected === 'Web Code'">
                                                <x-label for="name" class="font-semibold">Search</x-label>
                                                <x-form-input v-model="field.web_code"/>
                                            </div>
                                            <div class="col-span-1 sm:col-span-1" v-if="selected === 'Document # or Name'">
                                                <x-label for="name" class="font-semibold">Search</x-label>
                                                <x-form-input v-model="field.document"/>
                                            </div>

                                            <div class="col-span-1 sm:col-span-1" v-if="selected === 'Document # or Name'">
                                                <x-label for="name" class="font-semibold">Ticket State</x-label>
                                                <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-model="field.state">
                                                    <option disabled selected>Select your option</option>
                                                    <option value="Todos">Todos</option>
                                                    <option value="Normal">Normal</option>
                                                    <option value="Cancelled">Cancelled</option>
                                                    <option value="Reservation Canceled">Reservation Canceled</option>
                                                    <option value="Expired">Expired</option>
                                                    <option value="Opened">Opened</option>
                                                    <option value="Open Expired">Open Expired</option>
                                                    <option value="Reserved">Reserved</option>
                                                    <option value="Reserve Expired">Reserve Expired</option>
                                                    <option value="Sold out">Sold out</option>
                                                    <option value="Agent Sold">Agent Sold</option>
                                                    <option value="Approached">Approached</option>
                                                    <option value="No Approached">No Approached</option>
                                                    <option value="Reprinted">Reprinted</option>
                                                    <option value="Courtesy">Courtesy</option>
                                                    <option value="Selected">Selected</option>
                                                    <option value="Used">Used</option>
                                                    <option value="Externally Transferred">Externally Transferred</option>
                                                    <option value="Web sale">Web sale</option>
                                                </select>
                                            </div>
                                            <div class="col-span-1 sm:col-span-1" v-if="selected === 'Ticket ID'">
                                                <x-label for="name" class="font-semibold">Search</x-label>
                                                <x-form-input v-model="field.id"/>
                                            </div>

                                            <div class="col-span-1 mx-auto my-auto sm:col-span-1">
                                                <button type="button" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36" @click="ticketSupportSearch">
                                                    Search
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tab>
                        </x-slot>
                        <x-slot name="body">
                            <tr>
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('id', $event.target.value)" name="id" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('purchase_date', $event.target.value)" name="purchase_date" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('passenger', $event.target.value)" name="passenger" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('phone_number', $event.target.value)" name="phone_number" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('email', $event.target.value)" name="email" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('document', $event.target.value)" name="document" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('departure', $event.target.value)" name="departure" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('arrival', $event.target.value)" name="arrival" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                <td colspan="4" class="text-center border-b-2 border-gray-300 px-3"></td>
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('price', $event.target.value)" name="price" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('seat', $event.target.value)" name="seat" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                <td class="text-center border-b-2 border-gray-300 px-3">
                                    <input @input="setParam('travel_date', $event.target.value)" name="travel_date" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" />
                                </td>
                                <td colspan="4" class="text-center border-b-2 border-gray-300 px-3"></td>
                            </tr>
                            <template v-if="data.length > 0">
                                <tr v-for="(ticket, key) in data" :key="key" class="hover:bg-gray-100 cursor-pointer">
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.id}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.purchase_date}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.passenger}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.phone_number}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.email}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.document}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.departure}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.arrival}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.price}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.seat}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.travel_date}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.state}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.seller}}
                                    </td>
                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                        @{{ticket.office}}
                                    </td>

                                    <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-500">
                                        {{-- <delete-button :url="baggage.deleteUrl"></delete-button> --}}
                                        <x-modal :hasFooter="false" maxWidth="max-w-screen-md">
                                            <x-slot name="button">
                                                <a href="#" class="focus:outline-none focus:shadow-outline inline-flex" @click="toggled">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                                </a>
                                                <x-slot name="title">
                                                    Ticket Information
                                                </x-slot>
                                                <x-slot name="body">
                                                    <div class="grid grid-cols-4 gap-4">
                                                        <div class="col-span-1 my-auto sm:col-span-1 text-right">
                                                            <x-label class="font-semibold">Price</x-label>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-form-input type="text" v-model="ticket.total_sale" />
                                                        </div>
                                                        <div class="col-span-1 my-auto sm:col-span-1 text-right">
                                                            <x-label class="font-semibold">Passenger</x-label>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-form-input type="text" v-model="ticket.passenger" />
                                                        </div>
                                                        <div class="col-span-1 my-auto sm:col-span-1 text-right">
                                                            <x-label class="font-semibold">Method Of Payment</x-label>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-form-input type="text" v-model="ticket.payment_method" />
                                                        </div>
                                                        <div class="col-span-1 my-auto sm:col-span-1 text-right">
                                                            <x-label class="font-semibold">Status of Ticket</x-label>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-form-input type="text" v-model="ticket.status" />
                                                        </div>
                                                        <div class="col-span-1 my-auto sm:col-span-1 text-right">
                                                            <x-label class="font-semibold">Ticket Type</x-label>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-form-input type="text" v-model="ticket.ticket_type" />
                                                        </div>
                                                        <div class="col-span-1 my-auto sm:col-span-1 text-right">
                                                            <x-label class="font-semibold">User Registration</x-label>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-form-input type="text" v-model="ticket.seller" />
                                                        </div>
                                                        <div class="col-span-1 my-auto sm:col-span-1 text-right">
                                                            <x-label class="font-semibold">User Cancellation</x-label>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-form-input type="text" v-model="ticket.seller" />
                                                        </div>
                                                        <div class="col-span-1 my-auto sm:col-span-1 text-right">
                                                            <x-label class="font-semibold">Remote Sale</x-label>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-form-input type="text" v-model="ticket.state" />
                                                        </div>
                                                        <div class="col-span-1 my-auto sm:col-span-1 text-right">
                                                            <x-label class="font-semibold">User Confirmation RS</x-label>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-form-input type="text" v-model="ticket.state" />
                                                        </div>
                                                        <div class="col-span-1 my-auto sm:col-span-1 text-right">
                                                            <x-label class="font-semibold">User Reservation</x-label>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-form-input type="text" v-model="ticket.state" />
                                                        </div>
                                                        <div class="col-span-1 my-auto sm:col-span-1 text-right">
                                                            <x-label class="font-semibold">Reservation Date</x-label>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-form-input type="text" v-model="ticket.reservation_date" />
                                                        </div>
                                                        <div class="col-span-1 my-auto sm:col-span-1 text-right">
                                                            <x-label class="font-semibold">Sale Type</x-label>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-form-input type="text" v-model="ticket.state" />
                                                        </div>
                                                        <div class="col-span-1 my-auto sm:col-span-1 text-right">
                                                            <x-label class="font-semibold">Agency Name</x-label>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-form-input type="text" v-model="ticket.state" />
                                                        </div>
                                                        <div class="col-span-1 my-auto sm:col-span-1 text-right">
                                                            <x-label class="font-semibold">Agency Code</x-label>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-form-input type="text" v-model="ticket.state" />
                                                        </div>
                                                        <div class="col-span-1 my-auto sm:col-span-1 text-right">
                                                            <x-label class="font-semibold">Percentage</x-label>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-form-input type="text" v-model="ticket.state" />
                                                        </div>
                                                        <div class="col-span-1 my-auto sm:col-span-1 text-right">
                                                            <x-label class="font-semibold">Agent Amount</x-label>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-form-input type="text" v-model="ticket.state" />
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
                                    <td colspan="13" class="px-6 py-2 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
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
                                    <td colspan="14" class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
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