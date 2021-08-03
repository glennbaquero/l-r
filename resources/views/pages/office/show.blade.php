<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Office Management')}}" currentPage="Show" route="{{ route('office.index') }}"> 
                    <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    {{ $office->name }}
                </x-breadcrumb>
            </div>
        </div>
        @if(Session::has('success'))
            <x-alert message="{{ Session::get('success') }}" />
        @elseif(Session::has('errors'))
            <x-alert message="Error encountered" type="error" >
                @if ($errors->any())
                    <ul class="list-inside list-disc text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </x-alert>
        @endif

        <div class="mt-12 mx-auto w-3/4">
            <div class="bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    
                    <google-auto-complete v-slot="{ address }" :item="{{$office}}">
                        <form action="{{ route('office.update', $office->id) }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">

                                    <x-label for="name" class="font-semibold">Name</x-label>
                                    <x-form-input type="text" name="name" id="name" value="{{ $office->name }}" />
                                </div>
                                {{-- <div class="col-span-6 sm:col-span-3">
                                    <x-label for="office_no" class="font-semibold">Office Number</x-label>
                                    <x-form-input type="text" name="office_no" id="office_no" value="{{ $office->office_no }}" />
                                </div> --}}
                                <div class="col-span-6 sm:col-span-3">
                                    {{-- <x-label for="ledger_transaction" class="font-semibold">Ledger Transaction</x-label>
                                    <x-form-input type="text" name="ledger_transaction" id="ledger_transaction" value="{{ $office->ledger_transaction }}" /> --}}
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="address_line_1" class="font-semibold">Address</x-label>
                                    <x-form-input type="text" id="autocomplete" name="address_line_1" v-model="address.address_line_1"/>
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="city" class="font-semibold">City</x-label>
                                    {{-- <x-form-input type="text" name="city" id="city" v-model="address.city" /> --}}
                                    <multi-select :items="{{ $cities }}" label="name" :multiple="false" name="city" name_2="departure_city_id" :value-name="true" :selected-value="address.city" v-slot="{ selected }"></multi-select>
                                </div>

                                {{-- <div class="col-span-6 sm:col-span-3">
                                    <x-label for="city" class="font-semibold">Departure City</x-label>
                                    <multi-select :items="{{ $cities }}" label="name" :multiple="false" name="city" name_2="departure_city_id" :value-name="true" :selected-value="address.city" v-slot="{ selected }"></multi-select>
                                </div>
                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="arrival_city_id" class="font-semibold">Arrival City</x-label>
                                    <multi-select :items="{{ $cities }}" label="name" :multiple="false"  name="arrival_city_id" selected-value="{{ $office->arrival_city_id }}" v-slot="{ selected }"></multi-select>
                                </div> --}}
                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="state" class="font-semibold">State</x-label>
                                    <x-select :lists="$states" name="state_name" identifierValue="name" v-model="address.state_name"/>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="zip" class="font-semibold">Zip Code/Postal Code</x-label>
                                    <x-form-input type="text" name="zip" id="zip" v-model="address.postal_code" />
                                </div>

                                <phone-number v-slot="{ handlePhoneFormat }">
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-label for="phone_number" class="font-semibold">Phone Number</x-label>
                                        <x-form-input type="text" name="phone_number" id="phone_number" @input="handlePhoneFormat" value="{{ $office->phone_number }}" />
                                    </div>
                                </phone-number>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="ticket_sold_color" class="font-semibold">Tickets sold color</x-label>
                                    <x-form-input type="text" name="ticket_sold_color" id="ticket_sold_color" value="{{ $office->ticket_sold_color }}" />
                                </div>

                                <div class="col-span-3 sm:col-span-3">
                                    <x-switch label="Main stop office" name="main_stop_office" type="modified" rightLabel="Deactivate" leftLabel="Activate" :item="$office"/>
                                </div>
                                <div class="col-span-3 sm:col-span-3">
                                    <x-switch label="Boarding/Landing" name="boarding_landing" :item="$office"/>
                                </div>

                                <div class="col-span-3 sm:col-span-3">
                                    <x-switch label="Pre Printed vouchers" name="pre_printed_voucher" :item="$office"/>
                                </div>

                                <div class="col-span-3 sm:col-span-3">
                                    <x-switch label="Shipping office" name="shipping_office" :item="$office"/>
                                </div>
                            </div>

                            <toggle-select v-slot="{ display, conditionalFieldToDisplay, toggle, toggleFalse, selectChanged }" :items="{{$office_types}}" :selected-value="{{ $office->office_type_id }}" type="office">
                                <div class="grid grid-cols-6 gap-6 mt-6">
                                    <div class="col-span-12 sm:col-span-12">
                                        <x-label for="office_type_id" class="font-semibold">Office Type</x-label>
                                        <x-select :lists="$office_types" name="office_type_id" @change="selectChanged({{$office_types}}, $event.target.value, 'office')" :selected="$office->office_type_id"/>
                                    </div>

                                    <div class="col-span-4 sm:col-span-4" v-if="display">
                                        <x-switch label="Collect commission only" name="collect_commission_only" :item="$office"/>
                                    </div>
                                    <div class="col-span-4 sm:col-span-4" v-if="display">
                                        <x-switch label="Pays net amount" name="pays_net_amount" :item="$office"/>
                                    </div>
                                    <div class="col-span-4 sm:col-span-4" v-if="display">
                                        <x-switch label="Commission Type" name="commission_type" type="modified" rightLabel="M" leftLabel="P" :item="$office"/>
                                    </div>
                                    <div class="col-span-4 sm:col-span-4" v-if="display">
                                        <x-switch label="Hide Price" name="hide_price" :item="$office"/>
                                    </div>
                                    <div class="col-span-4 sm:col-span-4" v-if="display">
                                        <x-switch label="Print to capture" name="print_to_capture" :item="$office"/>
                                    </div>
                                    <div class="col-span-4 sm:col-span-4" v-if="display">
                                        <x-switch label="Sell Remote Tickets" name="sell_remote_tickets" :item="$office"/>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3" v-if="display">
                                        <x-label for="commission" class="font-semibold">Commission</x-label>
                                        <x-form-input type="number" name="commission" id="commission" value="{{ $office->commission }}" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3" v-if="conditionalFieldToDisplay">
                                        <x-label for="main_agency" class="font-semibold">Main Agency</x-label>
                                        <x-select :lists="$agencies" name="main_agency" :selected="$office->main_agency"/>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3" v-if="display">
                                        <x-label for="main_terminal_id" class="font-semibold">Main Terminal</x-label>
                                        <x-select :lists="$terminals" name="main_terminal_id" :selected="$office->main_terminal_id"/>
                                    </div>

                                    <div :class="!conditionalFieldToDisplay ? 'sm:col-span-6 col-span-9' : 'sm:col-span-3 col-span-6'" v-if="display">
                                        <x-label for="using_van" class="font-semibold">Using Van</x-label>
                                        <x-form-input type="number" name="using_van" id="using_van" value="{{ $office->using_van }}" />
                                    </div>
                                </div>
                            </toggle-select>

                            <div style="width: 100%; height: 50vh">
                                <input type="hidden" name="latitude" id="latitude" :value="address.latitude">
                                <input type="hidden" name="longitude" id="longitude" :value="address.longitude">
                                <google-map :origin="address" :destination="address" v-slot="{ directionsURL, hasOrigin }">
                                    <iframe v-if="hasOrigin" style="height: 100%; width: 100%" id="map" :src="directionsURL" frameborder="0"></iframe>
                                </google-map>
                            </div>
                            

                            <div class="mt-5 text-left">
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36">
                                    Save
                                </button>
                            </div>
                        </form>
                    </google-auto-complete>
                </div>
            </div>
        </div>

        <div class="mt-12 mx-auto">
            <data-table v-slot="{ params, setParam, data, links, meta, next, prev, selectAllHandler, loading }"
                        :searches="{{json_encode($searches)}}"
                        url="{{route('ticket.fetch', [$office->id, 'office_view'])}}"
            >
                <x-table :headers="$headers">
                    <x-slot name="body">
                        <tr>
                            <td colspan="13" class="text-center border-b-2 border-gray-300 px-3"></td>
                        </tr>
                        <template v-if="data.length > 0">
                            <tr v-for="(ticket, key) in data" :key="key" class="hover:bg-gray-100 cursor-pointer">
                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{ticket.ticket}}
                                </td>
                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{ticket.purchase_date}}
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
                                    @{{ticket.passenger}}
                                </td>
                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{ticket.office}}
                                </td>
                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{ticket.amount}}
                                </td>
                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{ticket.commssion}}
                                </td>
                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{ticket.receivable}}
                                </td>
                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{ticket.amount_paid}}
                                </td>
                                <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                    @{{ticket.balance}}
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
                                <td colspan="13" class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
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