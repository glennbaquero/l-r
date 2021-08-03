<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Office Management')}}" route="{{ route('office.index') }}"></x-breadcrumb>
            </div>
        </div>


        @if(Session::get('errors'))
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

                    <google-auto-complete v-slot="{ address }">
                        <form action="{{ route('office.store') }}" method="POST" >
                            @csrf
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">

                                    <x-label for="name" class="font-semibold">Name</x-label>
                                    <x-form-input type="text" name="name" id="name" value="{{ old('name') }}" />
                                </div>
                                {{-- <div class="col-span-6 sm:col-span-3">
                                    <x-label for="office_no" class="font-semibold">Office Number</x-label>
                                    <x-form-input type="text" name="office_no" id="office_no" value="{{ old('office_no') }}" />
                                </div> --}}
                                <div class="col-span-6 sm:col-span-3">
                                    {{-- <x-label for="ledger_transaction" class="font-semibold">Ledger Transaction</x-label>
                                    <x-form-input type="text" name="ledger_transaction" id="ledger_transaction" value="{{ old('ledger_transaction') }}" /> --}}
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="address_line_1" class="font-semibold">Address</x-label>
                                    <x-form-input type="text" id="autocomplete" name="address_line_1" v-model="address.address_line_1" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="city" class="font-semibold">City</x-label>
                                    {{-- <x-form-input type="text" name="city" id="city" v-model="address.city" /> --}}

                                    <multi-select :items="{{ $cities }}" label="name" :multiple="false"  name="city" name_2="departure_city_id" :value-name="true" v-slot="{ selected }" :selected-value="address.city" find-value="name"></multi-select>
                                </div>
                                {{-- <div class="col-span-6 sm:col-span-3">
                                    <x-label for="arrival_city_id" class="font-semibold">Arrival City</x-label>
                                    <multi-select :items="{{ $cities }}" label="name" :multiple="false"  name="arrival_city_id" v-slot="{ selected }"></multi-select>
                                </div> --}}
                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="state_name" class="font-semibold">State</x-label>
                                    <x-select :lists="$states" name="state_name" identifierValue="name" v-model="address.state_name"/>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="zip" class="font-semibold">Zip Code/Postal Code</x-label>
                                    <x-form-input type="text" name="zip" id="zip" v-model="address.postal_code" />
                                </div>

                                <phone-number v-slot="{ handlePhoneFormat }">
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-label for="phone_number" class="font-semibold">Phone Number</x-label>
                                        <x-form-input type="text" name="phone_number" id="phone_number" @input="handlePhoneFormat" value="{{ old('phone_number') }}" />
                                    </div>
                                </phone-number>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="ticket_sold_color" class="font-semibold">Tickets sold color</x-label>
                                    <x-form-input type="text" name="ticket_sold_color" id="ticket_sold_color" value="{{ old('ticket_sold_color') }}" />
                                </div>

                                <div class="col-span-3 sm:col-span-3">
                                    <x-switch label="Main stop office" name="main_stop_office" type="modified" rightLabel="Deactivate" leftLabel="Activate"/>
                                </div>
                                <div class="col-span-3 sm:col-span-3">
                                    <x-switch label="Boarding/Landing" name="boarding_landing" />
                                </div>

                                <div class="col-span-3 sm:col-span-3">
                                    <x-switch label="Pre Printed vouchers" name="pre_printed_voucher" />
                                </div>

                                <div class="col-span-3 sm:col-span-3">
                                    <x-switch label="Shipping office" name="shipping_office" />
                                </div>
                            </div>

                            <toggle-select v-slot="{ display, conditionalFieldToDisplay, toggle, toggleFalse, selectChanged }">
                                <div class="grid grid-cols-6 gap-6 mt-6">
                                    <div class="col-span-12 sm:col-span-12">
                                        <x-label for="office_type_id" class="font-semibold">Office Type</x-label>
                                        <x-select :lists="$office_types" name="office_type_id" @change="selectChanged({{$office_types}}, $event.target.value, 'office')"/>
                                    </div>

                                    <div class="col-span-4 sm:col-span-4" v-if="display">
                                        <x-switch label="Collect commission only" name="collect_commission_only"/>
                                    </div>
                                    <div class="col-span-4 sm:col-span-4" v-if="display">
                                        <x-switch label="Pays net amount" name="pays_net_amount"/>
                                    </div>
                                    <div class="col-span-4 sm:col-span-4" v-if="display">
                                        <x-switch label="Commission Type" name="commission_type" type="modified" rightLabel="M" leftLabel="P" />
                                    </div>
                                    <div class="col-span-4 sm:col-span-4" v-if="display">
                                        <x-switch label="Hide Price" name="hide_price"/>
                                    </div>
                                    <div class="col-span-4 sm:col-span-4" v-if="display">
                                        <x-switch label="Print to capture" name="print_to_capture"/>
                                    </div>
                                    <div class="col-span-4 sm:col-span-4" v-if="display">
                                        <x-switch label="Sell Remote Tickets" name="sell_remote_tickets"/>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3" v-if="display">
                                        <x-label for="commission" class="font-semibold">Commission</x-label>
                                        <x-form-input type="number" name="commission" id="commission" value="{{ old('commission') }}" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3" v-if="conditionalFieldToDisplay">
                                        <x-label for="main_agency" class="font-semibold">Main Agency</x-label>
                                        <x-select :lists="$agencies" name="main_agency"/>
                                    </div>
                                    <div class="col-span-6 sm:col-span-3" v-if="display">
                                        <x-label for="main_terminal_id" class="font-semibold">Main Terminal</x-label>
                                        <x-select :lists="$terminals" name="main_terminal_id"/>
                                    </div>

                                    <div :class="!conditionalFieldToDisplay ? 'sm:col-span-6 col-span-9' : 'sm:col-span-3 col-span-6'" v-if="display">
                                        <x-label for="using_van" class="font-semibold">Using Van</x-label>
                                        <x-form-input type="number" name="using_van" id="using_van" value="{{ old('using_van') }}" />
                                    </div>
                                </div>
                            </toggle-select>

                            <div style="width: 100%; height: 50vh">
                                <input type="hidden" name="latitude" id="latitude" value="{{old('latitude')}}">
                                <input type="hidden" name="longitude" id="longitude" value="{{old('longitude')}}">
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
    </div>
</x-app-layout>