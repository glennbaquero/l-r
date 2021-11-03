<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Trip Management')}}" route="{{ route('trip.index') }}"></x-breadcrumb>
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
                    <toggle-select v-slot="{ display, conditionalFieldToDisplay, toggle, toggleFalse, selectChanged, item }">
                        <form action="{{ route('travel-schedule.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-3 gap-3">
                                <div class="col-span-full sm:col-span-full">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-3 sm:col-span-3">
                                            <x-label for="start_date" class="font-semibold" :dateRange="0">Start Date</x-label>
                                            <x-datepicker name="start_date"/>
                                        </div>

                                        <div class="col-span-3 sm:col-span-3">
                                            <x-label for="end_date" class="font-semibold" :dateRange="0">End Date</x-label>
                                            <x-datepicker name="end_date"/>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-full sm:col-span-full">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="route_id" class="font-semibold">Route</x-label>
                                            <x-select :lists="$routes" name="route_id" oldValue="{{ old('route_id') }}" @change="selectChanged({{$routes}}, $event.target.value, 'route')" selected="none"/>
                                        </div>

                                        {{-- <div class="col-span-2 sm:col-span-2">
                                            <x-label for="company_id" class="font-semibold">Company Interline</x-label>
                                            <x-select :lists="$companies" name="company_id" oldValue="{{ old('company_id') }}"/>
                                        </div> --}}

                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="alias_route" class="font-semibold">Alias Route</x-label>
                                            <x-form-input type="text" name="alias_route" id="alias_route" v-model="item.alias" />
                                        </div>

                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="service_id" class="font-semibold">Service</x-label>
                                            <x-select :lists="$services" name="service_id" oldValue="{{ old('service_id') }}"/>
                                        </div>

                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="transport_type" class="font-semibold">Transport Type</x-label>
                                            <x-select :lists="$transport_types" name="transport_type" identifierValue="name" oldValue="{{ old('transport_type') }}"/>
                                        </div>

                                        {{-- <div class="col-span-2 sm:col-span-2">
                                            <x-label for="bus_id" class="font-semibold">Bus</x-label>
                                            <x-select :lists="$buses" name="bus_id"  oldValue="{{ old('bus_id') }}"/>
                                        </div> --}}

                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="alias_route" class="font-semibold">Max baggage</x-label>
                                            <x-input type="number" min="0" name="max_baggage" id="max_baggage" oldValue="{{ old('max_baggage') }}"/>
                                        </div>

                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="alias_route" class="font-semibold">Additional fee for excess baggage</x-label>
                                            <x-input type="number" min="0" name="additional_bag_fee" id="additional_bag_fee" oldValue="{{ old('additional_bag_fee') }}"/>
                                        </div>

                                        {{-- <div class="col-span-2 sm:col-span-2">
                                            <x-label for="driver_id" class="font-semibold">Driver</x-label>
                                            <x-select :lists="$drivers" name="driver_id" display="fullname"  oldValue="{{ old('driver_id') }}"/>
                                        </div> --}}

                                        {{-- <div class="col-span-full sm:col-span-full">
                                            
                                        </div> --}}

                                        <div class="col-span-3 sm:col-span-3">
                                            <x-label for="discounted_tickets" class="font-semibold mt-2 mb-5">
                                                <input type="checkbox" class="form-input leading-none rounded shadow-sm " name="discounted_tickets" id="discounted_tickets" />
                                                Discounted Ticket
                                            </x-label>
                                            <x-label for="additional_receipt" class="font-semibold">
                                                <input type="checkbox" class="form-input leading-none rounded shadow-sm " name="additional_receipt" id="additional_receipt" />
                                                Additional Receipt/Price breakdown
                                            </x-label>
                                        </div>

                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="show_on_web" class="font-semibold mt-2 mb-5">
                                                <input type="checkbox" class="form-input leading-none rounded shadow-sm " name="show_on_web" id="show_on_web" />
                                                Show On Web
                                            </x-label>
                                            <x-label for="express_trip" class="font-semibold">
                                                <input type="checkbox" class="form-input leading-none rounded shadow-sm " name="express_trip" id="express_trip" />
                                                Express Trip
                                            </x-label>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="col-span-full sm:col-span-full mt-5">
                                    <div class="grid grid-cols-4 gap-2">
                                        <increment v-slot="{ removeHandler, addNewHandler, increment, array, selected }">
                                            <div class="col-span-3 sm:col-span-3">
                                                <x-label for="monday_time" class="font-semibold">
                                                    <input type="checkbox" class="form-input h-5 leading-none mr-2 rounded shadow-sm w-5 " name="monday" id="monday" v-model="selected.monday"/>Monday 
                                                    
                                                    <button type="button" @click="addNewHandler" class="inline-flex items-center justify-center border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-if="selected.monday">
                                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                                    </button>
                                                </x-label>
                                                <div class="grid grid-cols-6 gap-1">
                                                    <template v-if="selected.monday" v-for="(list,key) in array" >
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-label for="monday_time" class="font-semibold">Departure Time</x-label>
                                                            <x-form-input type="time" name="monday_time[]" classAttrib="w-full form-input mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-model="list.value"/>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-label for="monday_arrival_date" class="font-semibold">Arrival Date</x-label>
                                                            <x-form-input type="date" name="monday_arrival_date[]" v-model="list.arrival_date" />
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-label for="monday_arrival_time" class="font-semibold">Arrival Time</x-label>
                                                            <x-form-input type="time" name="monday_arrival_time[]" classAttrib="w-full form-input mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-model="list.arrival_time"/>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1 my-auto">
                                                            <x-label for="monday_time" class="font-semibold">Driver</x-label>
                                                            <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="monday_time_driver[]" v-model="list.driver_id">
                                                                <option value="">Pending driver</option>
                                                                @foreach($drivers as $driver)
                                                                    <option value="{{ $driver->id }}">{{ $driver->fullname }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1 my-auto">
                                                            <x-label for="bus_id" class="font-semibold">Bus</x-label>
                                                            <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="monday_time_bus[]" v-model="list.bus_id">
                                                                <option value="">Pending Bus</option>
                                                                @foreach($buses as $bus)
                                                                    <option value="{{ $bus->id }}">{{ $bus->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-span-1 sm:col-span-1 my-auto">
                                                            <button type="button" @click="removeHandler(key)" v-if="key > 0" class="inline-flex items-center justify-center border border-transparent font-medium rounded-md text-white bg-red-600 focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                                                            </button>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </increment>
                                    </div>
                                    <div class="grid grid-cols-4 gap-2">
                                        <increment v-slot="{ removeHandler, addNewHandler, increment, array, selected }">
                                            <div class="col-span-3 sm:col-span-3">
                                                <x-label for="tuesday_time" class="font-semibold">
                                                    <input type="checkbox" class="form-input h-5 leading-none mr-2 rounded shadow-sm w-5 " name="tuesday" id="tuesday" v-model="selected.tuesday"/>Tuesday
                                                    <button type="button" @click="addNewHandler" class="inline-flex items-center justify-center border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-if="selected.tuesday">
                                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                                    </button>
                                                </x-label>
                                                <div class="grid grid-cols-6 gap-1">
                                                    <template v-if="selected.tuesday" v-for="(list,key) in array" >
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-label for="tuesday_time" class="font-semibold">Departure Time</x-label>
                                                            <x-form-input type="time" name="tuesday_time[]" classAttrib="w-full form-input mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-model="list.value"/>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-label for="tuesday_arrival_date" class="font-semibold">Arrival Date</x-label>
                                                            <x-form-input type="date" name="tuesday_arrival_date[]" v-model="list.arrival_date" />
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-label for="tuesday_arrival_time" class="font-semibold">Arrival Time</x-label>
                                                            <x-form-input type="time" name="tuesday_arrival_time[]" classAttrib="w-full form-input mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-model="list.arrival_time"/>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1 my-auto">
                                                            <x-label for="tuesday_time" class="font-semibold">Driver</x-label>
                                                            <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="tuesday_time_driver[]" v-model="list.driver_id">
                                                                <option value="">Pending driver</option>
                                                                @foreach($drivers as $driver)
                                                                    <option value="{{ $driver->id }}">{{ $driver->fullname }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1 my-auto">
                                                            <x-label for="bus_id" class="font-semibold">Bus</x-label>
                                                            <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="tuesday_time_bus[]" v-model="list.bus_id">
                                                                <option value="">Pending Bus</option>
                                                                @foreach($buses as $bus)
                                                                    <option value="{{ $bus->id }}">{{ $bus->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1 my-auto">
                                                            <button type="button" @click="removeHandler(key)" v-if="key > 0" class="inline-flex items-center justify-center border border-transparent font-medium rounded-md text-white bg-red-600 focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                                                            </button>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </increment>
                                    </div>
                                    <div class="grid grid-cols-4 gap-2">
                                        <increment v-slot="{ removeHandler, addNewHandler, increment, array, selected }">
                                            <div class="col-span-3 sm:col-span-3">
                                                <x-label for="tuesday_time" class="font-semibold">
                                                    <input type="checkbox" class="form-input h-5 leading-none mr-2 rounded shadow-sm w-5 " name="wednesday" id="wednesday" v-model="selected.wednesday"/>Wednesday
                                                    <button type="button" @click="addNewHandler" class="inline-flex items-center justify-center border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-if="selected.wednesday">
                                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                                    </button>
                                                </x-label>
                                                <div class="grid grid-cols-6 gap-1">
                                                    <template v-if="selected.wednesday" v-for="(list,key) in array" >
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-label for="wednesday_time" class="font-semibold">Departure Time</x-label>
                                                            <x-form-input type="time" name="wednesday_time[]" classAttrib="w-full form-input mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-model="list.value"/>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-label for="wednesday_arrival_date" class="font-semibold">Arrival Date</x-label>
                                                            <x-form-input type="date" name="wednesday_arrival_date[]" v-model="list.arrival_date" />
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-label for="wednesday_arrival_time" class="font-semibold">Arrival Time</x-label>
                                                            <x-form-input type="time" name="wednesday_arrival_time[]" classAttrib="w-full form-input mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-model="list.arrival_time"/>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1 my-auto">
                                                            <x-label for="wednesday_time_driver" class="font-semibold">Driver</x-label>
                                                            <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="wednesday_time_driver[]" v-model="list.driver_id">
                                                                <option value="">Pending driver</option>
                                                                @foreach($drivers as $driver)
                                                                    <option value="{{ $driver->id }}">{{ $driver->fullname }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1 my-auto">
                                                            <x-label for="bus_id" class="font-semibold">Bus</x-label>
                                                            <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="wednesday_time_bus[]" v-model="list.bus_id">
                                                                <option value="">Pending Bus</option>
                                                                @foreach($buses as $bus)
                                                                    <option value="{{ $bus->id }}">{{ $bus->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1 my-auto">
                                                            <button type="button" @click="removeHandler(key)" v-if="key > 0" class="inline-flex items-center justify-center border border-transparent font-medium rounded-md text-white bg-red-600 focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                                                            </button>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </increment>
                                    </div>
                                    <div class="grid grid-cols-4 gap-2">
                                        <increment v-slot="{ removeHandler, addNewHandler, increment, array, selected }">
                                            <div class="col-span-3 sm:col-span-3">
                                                <x-label for="thursday_time" class="font-semibold">
                                                    <input type="checkbox" class="form-input h-5 leading-none mr-2 rounded shadow-sm w-5 " name="thursday" id="thursday" v-model="selected.thursday"/>Thursday
                                                    <button type="button" @click="addNewHandler" class="inline-flex items-center justify-center border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-if="selected.thursday">
                                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                                    </button>
                                                </x-label>
                                                <div class="grid grid-cols-6 gap-1">
                                                    <template v-if="selected.thursday" v-for="(list,key) in array" >
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-label for="thursday_time" class="font-semibold">Departure Time</x-label>
                                                            <x-form-input type="time" name="thursday_time[]" classAttrib="w-full form-input mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-model="list.value"/>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-label for="thursday_arrival_date" class="font-semibold">Arrival Date</x-label>
                                                            <x-form-input type="date" name="thursday_arrival_date[]" v-model="list.arrival_date" />
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-label for="thursday_arrival_time" class="font-semibold">Arrival Time</x-label>
                                                            <x-form-input type="time" name="thursday_arrival_time[]" classAttrib="w-full form-input mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-model="list.arrival_time"/>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1 my-auto">
                                                            <x-label for="thursday_time_driver" class="font-semibold">Driver</x-label>
                                                            <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="thursday_time_driver[]" v-model="list.driver_id">
                                                                <option disabled selected>Select driver</option>
                                                                @foreach($drivers as $driver)
                                                                    <option value="{{ $driver->id }}">{{ $driver->fullname }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1 my-auto">
                                                            <x-label for="bus_id" class="font-semibold">Bus</x-label>
                                                            <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="thursday_time_bus[]" v-model="list.bus_id">
                                                                <option value="">Pending Bus</option>
                                                                @foreach($buses as $bus)
                                                                    <option value="{{ $bus->id }}">{{ $bus->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1 my-auto">
                                                            <button type="button" @click="removeHandler(key)" v-if="key > 0" class="inline-flex items-center justify-center border border-transparent font-medium rounded-md text-white bg-red-600 focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                                                            </button>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </increment>
                                    </div>
                                    <div class="grid grid-cols-4 gap-2">
                                        <increment v-slot="{ removeHandler, addNewHandler, increment, array, selected }">
                                            <div class="col-span-3 sm:col-span-3">
                                                <x-label for="friday_time" class="font-semibold">
                                                    <input type="checkbox" class="form-input h-5 leading-none mr-2 rounded shadow-sm w-5 " name="friday" id="friday" v-model="selected.friday"/>Friday
                                                    <button type="button" @click="addNewHandler" class="inline-flex items-center justify-center border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-if="selected.friday">
                                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                                    </button>
                                                </x-label>
                                                <div class="grid grid-cols-6 gap-1">
                                                    <template v-if="selected.friday" v-for="(list,key) in array" >
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-label for="friday_time" class="font-semibold">Departure Time</x-label>
                                                            <x-form-input type="time" name="friday_time[]" classAttrib="w-full form-input mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-model="list.value"/>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-label for="friday_arrival_date" class="font-semibold">Arrival Date</x-label>
                                                            <x-form-input type="date" name="friday_arrival_date[]" v-model="list.arrival_date" />
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-label for="friday_arrival_time" class="font-semibold">Arrival Time</x-label>
                                                            <x-form-input type="time" name="friday_arrival_time[]" classAttrib="w-full form-input mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-model="list.arrival_time"/>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1 my-auto">
                                                            <x-label for="friday_time_driver" class="font-semibold">Driver</x-label>
                                                            <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="friday_time_driver[]" v-model="list.driver_id">
                                                                <option value="">Pending driver</option>
                                                                @foreach($drivers as $driver)
                                                                    <option value="{{ $driver->id }}">{{ $driver->fullname }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1 my-auto">
                                                            <x-label for="bus_id" class="font-semibold">Bus</x-label>
                                                            <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="friday_time_bus[]" v-model="list.bus_id">
                                                                <option value="">Pending Bus</option>
                                                                @foreach($buses as $bus)
                                                                    <option value="{{ $bus->id }}">{{ $bus->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1 my-auto">
                                                            <button type="button" @click="removeHandler(key)" v-if="key > 0" class="inline-flex items-center justify-center border border-transparent font-medium rounded-md text-white bg-red-600 focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                                                            </button>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </increment>
                                    </div>
                                    <div class="grid grid-cols-4 gap-2">
                                        <increment v-slot="{ removeHandler, addNewHandler, increment, array, selected }">
                                            <div class="col-span-3 sm:col-span-3">
                                                <x-label for="saturday_time" class="font-semibold">
                                                    <input type="checkbox" class="form-input h-5 leading-none mr-2 rounded shadow-sm w-5 " name="saturday" id="saturday" v-model="selected.saturday"/>Saturday
                                                    <button type="button" @click="addNewHandler" class="inline-flex items-center justify-center border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-if="selected.saturday">
                                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                                    </button>
                                                </x-label>
                                                <div class="grid grid-cols-6 gap-1">
                                                    <template v-if="selected.saturday" v-for="(list,key) in array" >
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-label for="saturday_time" class="font-semibold">Departure Time</x-label>
                                                            <x-form-input type="time" name="saturday_time[]" classAttrib="w-full form-input mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-model="list.value"/>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-label for="saturday_arrival_date" class="font-semibold">Arrival Date</x-label>
                                                            <x-form-input type="date" name="saturday_arrival_date[]" v-model="list.arrival_date" />
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-label for="saturday_arrival_time" class="font-semibold">Arrival Time</x-label>
                                                            <x-form-input type="time" name="saturday_arrival_time[]" classAttrib="w-full form-input mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-model="list.arrival_time"/>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1 my-auto">
                                                            <x-label for="saturday_time_driver" class="font-semibold">Driver</x-label>
                                                            <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="saturday_time_driver[]" v-model="list.driver_id">
                                                                <option value="">Pending driver</option>
                                                                @foreach($drivers as $driver)
                                                                    <option value="{{ $driver->id }}">{{ $driver->fullname }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1 my-auto">
                                                            <x-label for="bus_id" class="font-semibold">Bus</x-label>
                                                            <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="saturday_time_bus[]" v-model="list.bus_id">
                                                                <option value="">Pending Bus</option>
                                                                @foreach($buses as $bus)
                                                                    <option value="{{ $bus->id }}">{{ $bus->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1 my-auto">
                                                            <button type="button" @click="removeHandler(key)" v-if="key > 0" class="inline-flex items-center justify-center border border-transparent font-medium rounded-md text-white bg-red-600 focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                                                            </button>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </increment>
                                    </div>
                                    <div class="grid grid-cols-4 gap-2">
                                        <increment v-slot="{ removeHandler, addNewHandler, increment, array, selected }">
                                            <div class="col-span-3 sm:col-span-3">
                                                <x-label for="sunday_time" class="font-semibold">
                                                    <input type="checkbox" class="form-input h-5 leading-none mr-2 rounded shadow-sm w-5 " name="sunday" id="sunday" v-model="selected.sunday"/>Sunday
                                                    <button type="button" @click="addNewHandler" class="inline-flex items-center justify-center border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-if="selected.sunday">
                                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                                    </button>
                                                </x-label>
                                                <div class="grid grid-cols-6 gap-1">
                                                    <template v-if="selected.sunday" v-for="(list,key) in array" >
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-label for="sunday_time" class="font-semibold">Departure Time</x-label>
                                                            <x-form-input type="time" name="sunday_time[]" classAttrib="w-full form-input mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-model="list.value"/>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-label for="sunday_arrival_date" class="font-semibold">Arrival Date</x-label>
                                                            <x-form-input type="date" name="sunday_arrival_date[]" v-model="list.arrival_date" />
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1">
                                                            <x-label for="sunday_arrival_time" class="font-semibold">Arrival Time</x-label>
                                                            <x-form-input type="time" name="sunday_arrival_time[]" classAttrib="w-full form-input mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-model="list.arrival_time"/>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1 my-auto">
                                                            <x-label for="sunday_time_driver" class="font-semibold">Driver</x-label>
                                                            <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="sunday_time_driver[]" v-model="list.driver_id">
                                                                <option value="">Pending driver</option>
                                                                @foreach($drivers as $driver)
                                                                    <option value="{{ $driver->id }}">{{ $driver->fullname }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1 my-auto">
                                                            <x-label for="bus_id" class="font-semibold">Bus</x-label>
                                                            <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="sunday_time_bus[]" v-model="list.bus_id">
                                                                <option value="">Pending Bus</option>
                                                                @foreach($buses as $bus)
                                                                    <option value="{{ $bus->id }}">{{ $bus->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-span-1 sm:col-span-1 my-auto">
                                                            <button type="button" @click="removeHandler(key)" v-if="key > 0" class="inline-flex items-center justify-center border border-transparent font-medium rounded-md text-white bg-red-600 focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                                                            </button>
                                                        </div>
                                                    </template>
                                                </div>
                                            </div>
                                        </increment>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-5 text-left">
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36">
                                    Save
                                </button>
                            </div>
                        </form>
                    </toggle-select>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>