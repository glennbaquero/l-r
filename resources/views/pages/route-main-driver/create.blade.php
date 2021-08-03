<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Route And Main Driver')}}" route="{{ route('route-main-driver.index') }}"></x-breadcrumb>
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

                            <form action="{{ route('route-main-driver.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="type" :value="selected">
                                
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-2 sm:col-span-2">
                                        <x-label for="type_of_record" class="font-semibold">Type Of Record</x-label>
                                        <x-form-input type="text" name="type_of_record" value="{{ old('type_of_record') }}" />
                                    </div>

                                    <div class="col-span-2 sm:col-span-2" v-if="selected == 'Voucher of Route'">
                                        <x-label for="voucher_type" class="font-semibold">Type</x-label>
                                        <x-select :lists="$types" name="voucher_type" display="label" identifierValue="label" oldValue="{{ old('voucher_type') }}"/>
                                    </div>

                                    <div class="col-span-2 sm:col-span-2">
                                        <x-label for="series" class="font-semibold">Series</x-label>
                                        <x-form-input type="text" name="series" value="{{ old('series') }}" />
                                    </div>
                                    <div class="col-span-2 sm:col-span-2">
                                        <x-label for="correlative" class="font-semibold">Correlative</x-label>
                                        <x-form-input type="text" name="correlative" value="{{ old('correlative') }}" />
                                    </div>

                                    <div class="col-span-2 sm:col-span-2" v-if="selected == 'Ticket of Route'">
                                        <x-label for="first_name" class="font-semibold">First Name</x-label>
                                        <x-form-input type="text" name="first_name" value="{{ old('first_name') }}" />
                                    </div>
                                    <div class="col-span-2 sm:col-span-2" v-if="selected == 'Ticket of Route'">
                                        <x-label for="last_name" class="font-semibold">Last Name</x-label>
                                        <x-form-input type="text" name="last_name" value="{{ old('last_name') }}" />
                                    </div>

                                    <div class="col-span-2 sm:col-span-2" v-if="selected == 'Ticket of Route'">
                                        <x-label for="driver_id" class="font-semibold">Driver</x-label>
                                        <x-select :lists="$drivers" name="driver_id" display="fullname" />
                                    </div>

                                    <div class="col-span-2 sm:col-span-2" v-if="selected == 'Ticket of Route'">
                                        <x-label for="departure_id" class="font-semibold">Departure</x-label>
                                        <x-select :lists="$cities" name="departure_id" />
                                    </div>

                                    <div class="col-span-2 sm:col-span-2" v-if="selected == 'Ticket of Route'">
                                        <x-label for="arrival_id" class="font-semibold">Arrival</x-label>
                                        <x-select :lists="$cities" name="arrival_id" />
                                    </div>

                                    <div class="col-span-2 sm:col-span-2" v-if="selected == 'Ticket of Route'">
                                        <x-label for="travel_date" class="font-semibold">Travel Date</x-label>
                                        <x-datepicker name="travel_date"/>
                                    </div>

                                    <div class="col-span-2 sm:col-span-2" v-if="selected == 'Ticket of Route'">
                                        <x-label for="time" class="font-semibold">Time</x-label>
                                        <x-datepicker name="time" type="time" format="hh:mm"/>
                                    </div>

                                    <div class="col-span-2 sm:col-span-2">
                                        <x-label for="issued_date" class="font-semibold">Issued Date</x-label>
                                        <x-datepicker name="issued_date"/>
                                    </div>

                                    <div class="col-span-2 sm:col-span-2" v-if="selected == 'Ticket of Route'">
                                        <x-label for="seat" class="font-semibold">Seat</x-label>
                                        <x-form-input type="text" name="seat" value="{{ old('seat') }}" />
                                    </div>

                                    <div class="col-span-2 sm:col-span-2"  v-if="selected == 'Ticket of Route'">
                                        <x-label for="state" class="font-semibold">State</x-label>
                                        <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="state">
                                            <option disabled selected>Select your option</option>
                                            <option value="Sold">Sold</option>
                                            <option value="Cancelled">Cancelled</option>
                                            <option value="To collect">To collect</option>
                                        </select>
                                    </div>

                                    <div class="col-span-2 sm:col-span-2"  v-if="selected != 'Ticket of Route'">
                                        <x-label for="state" class="font-semibold">State</x-label>
                                        <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="state">
                                            <option disabled selected>Select your option</option>
                                            <option value="Registered">Registered</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>
                                    </div>

                                    <div class="col-span-2 sm:col-span-2">
                                        <x-label for="price" class="font-semibold">Price</x-label>
                                        <x-form-input type="number" min="0" step="any" name="price" value="{{ old('price') }}" />
                                    </div>

                                    <div class="col-span-2 sm:col-span-2">
                                        <x-label for="code_reference" class="font-semibold">Code Reference</x-label>
                                        <x-form-input type="text" name="code_reference" value="{{ old('code_reference') }}" />
                                    </div>

                                </div>

                                <div class="grid grid-cols-6 gap-6" v-if="selected != 'Ticket of Route'">
                                    <div class="col-span-full sm:col-span-full">
                                        <x-label for="description" class="font-semibold">Description</x-label>
                                        <x-text-area name="description" id="description"/>
                                    </div>
                                </div>

                                <div class="mt-5 text-left">
                                    <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36">
                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </tab>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>