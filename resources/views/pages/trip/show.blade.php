<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Trip Management')}}" currentPage="Show" route="{{ route('trip.index') }}"> 
                    <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    {{ $trip->route->name }}
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
                    <toggle-select v-slot="{ display, conditionalFieldToDisplay, toggle, toggleFalse, selectChanged, item }" :items="{{$routes}}" :selected-value="{{ $trip->route_id }}" type="route">

                        <form action="{{ route('trip.update', $trip->id) }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-6 gap-2">

                                <div class="col-span-3 sm:col-span-3">
                                    <x-label for="route_id" class="font-semibold">Route</x-label>
                                    <x-select :lists="$routes" name="route_id" oldValue="{{ old('route_id') }}" @change="selectChanged({{$routes}}, $event.target.value, 'route')" :selected="$trip->route_id"/>
                                </div>

                                {{-- <div class="col-span-2 sm:col-span-2">
                                    <x-label for="company_id" class="font-semibold">Company Interline</x-label>
                                    <x-select :lists="$companies" name="company_id" :selected="$trip->company_id"/>
                                </div> --}}

                                <div class="col-span-3 sm:col-span-3">
                                    <x-label for="alias_route" class="font-semibold">Alias Route</x-label>
                                    <x-form-input type="text" name="alias_route" id="alias_route" v-model="item.alias" />
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="alias_route" class="font-semibold">Max baggage</x-label>
                                    <x-input type="number" min="0" name="max_baggage" id="max_baggage" value="{{ $trip->max_baggage }}" />
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="alias_route" class="font-semibold">Additional fee for excess baggage</x-label>
                                    <x-input type="number" min="0" name="additional_bag_fee" id="additional_bag_fee" value="{{ $trip->additional_bag_fee }}"/>
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="date" class="font-semibold">Date</x-label>
                                    <x-datepicker name="date" :item="$trip"/>
                                </div>

                                {{-- <div class="col-span-1 sm:col-span-1">
                                    <x-label for="time" class="font-semibold">Time</x-label>
                                    <x-form-input type="time" name="time" value="{{ $trip->time }}" />
                                </div> --}}

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="service_id" class="font-semibold">Service</x-label>
                                    <x-select :lists="$services" name="service_id" :selected="$trip->service_id"/>
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="transport_type" class="font-semibold">Transport Type</x-label>
                                    <x-select :lists="$transport_types" name="transport_type" identifierValue="name" oldValue="{{ old('transport_type') }}" @change="selectChanged({{$routes}}, $event.target.value, 'transport_type')" :selected="$trip->transport_type"/>
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="bus_id" class="font-semibold">Bus</x-label>
                                    <x-select :lists="$buses" name="bus_id" :selected="$trip->bus_id"/>
                                </div>

                                {{-- <div class="col-span-2 sm:col-span-2">
                                    <x-label for="crew_id" class="font-semibold">Crew</x-label>
                                    <x-select :lists="$crews" name="crew_id" :selected="$trip->crew_id"/>
                                </div> --}}

                                {{-- <div class="col-span-2 sm:col-span-2">
                                    <x-label for="driver_id" class="font-semibold">Driver</x-label>
                                    <x-select :lists="$drivers" name="driver_id" display="fullname" :selected="$trip->driver_id"/>
                                </div> --}}

                                <div class="col-span-2 sm:col-span-2" v-if="item.has_main_co_driver">
                                    <x-label for="main_co_driver_id" class="font-semibold">Main Co-Driver</x-label>
                                    <x-select :lists="$drivers" name="main_co_driver_id" display="fullname" :selected="$trip->main_co_driver_id"/>
                                </div>

                                {{-- <div class="col-span-2 sm:col-span-2">
                                    <template v-if="display">
                                        <x-label for="secondary_co_driver_id" class="font-semibold">Secondary Co-Driver</x-label>
                                        <x-select :lists="$drivers" name="secondary_co_driver_id" display="fullname" :selected="$trip->secondary_co_driver_id"/>
                                    </template>
                                </div> --}}

                                <div class="col-span-2 sm:col-span-2" v-if="item.has_assistant">
                                    <x-label for="assistant_id" class="font-semibold">Assistant</x-label>
                                    <x-select :lists="$assistants" name="assistant_id" :selected="$trip->assistant_id"/>
                                </div>

                                <div class="col-span-6 sm:col-span-6">
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="discounted_tickets" class="font-semibold mt-2 mb-5">
                                        <input type="checkbox" class="form-input bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="discounted_tickets" id="discounted_tickets" {{ $trip->discounted_tickets ? 'checked' : '' }}/>
                                        Discounted Ticket
                                    </x-label>
                                    <x-label for="additional_receipt" class="font-semibold">
                                        <input type="checkbox" class="form-input bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="additional_receipt" id="additional_receipt" {{ $trip->additional_receipt ? 'checked' : '' }}/>
                                        Additional Receipt/Price breakdown
                                    </x-label>
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="show_on_web" class="font-semibold mt-2 mb-5">
                                        <input type="checkbox" class="form-input bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="show_on_web" id="show_on_web" {{ $trip->show_on_web ? 'checked' : '' }}/>
                                        Show On Web
                                    </x-label>
                                    {{-- <x-label for="express_trip" class="font-semibold">
                                        <input type="checkbox" class="form-input bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="express_trip" id="express_trip" {{ $trip->express_trip ? 'checked' : '' }}/>
                                        Express Trip
                                    </x-label> --}}
                                </div>

                                <increment v-slot="{ removeHandler, addNewHandler, increment, array, selected }" :data="{{ $trip->times }}">
                                    <div class="col-span-6 sm:col-span-6">
                                        <button type="button" @click="addNewHandler" class="inline-flex items-center justify-center border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                        </button>

                                        <div class="grid grid-cols-6 gap-1">
                                            <template v-for="(list,key) in array" >
                                                <div class="col-span-1 sm:col-span-1">
                                                    <x-label for="time" class="font-semibold">Departure Time</x-label>
                                                    <x-form-input type="time" name="time_list[]" classAttrib="w-full form-input mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-model="list.time"/>
                                                    <input type="hidden" name="new[]" v-model="list.new">
                                                    <input type="hidden" name="ids[]" v-model="list.id">
                                                </div>
                                                <div class="col-span-1 sm:col-span-1">
                                                    <x-label for="arrival_date" class="font-semibold">Arrival Date</x-label>
                                                    <x-form-input type="date" name="arrival_date[]" v-model="list.arrival_date" />
                                                </div>
                                                <div class="col-span-1 sm:col-span-1">
                                                    <x-label for="arrival_time" class="font-semibold">Arrival Time</x-label>
                                                    <x-form-input type="time" name="arrival_time[]" classAttrib="w-full form-input mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-model="list.arrival_time"/>
                                                </div>
                                                <div class="col-span-1 sm:col-span-1 my-auto">
                                                    <x-label for="driver_list" class="font-semibold">Driver</x-label>
                                                    <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="driver_list[]" v-model="list.driver_id">
                                                        <option value="null">Pending driver</option>
                                                        @foreach($drivers as $driver)
                                                            <option value="{{ $driver->id }}">{{ $driver->fullname }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-span-1 sm:col-span-1 my-auto">
                                                    <x-label for="bus_id" class="font-semibold">Bus</x-label>
                                                    <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="bus_list[]" v-model="list.bus_id">
                                                        <option value="null">Pending Bus</option>
                                                        @foreach($buses as $bus)
                                                            <option value="{{ $bus->id }}">{{ $bus->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-span-1 sm:col-span-1 my-auto">
                                                    <button type="button" @click="removeHandler(key, list)" v-if="key > 0" class="inline-flex items-center justify-center border border-transparent font-medium rounded-md text-white bg-red-600 focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                                                    </button>
                                                </div>
                                            </template>
                                        </div>
                                    </div>
                                </increment>


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