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
                            <div class="grid grid-cols-3 gap-3">

                                <div class="col-span-1 sm:col-span-1">
                                    {{-- <x-select :lists="$routes" name="route_id" oldValue="{{ old('route_id') }}" @change="selectChanged({{$routes}}, $event.target.value, 'route')" selected="none"/> --}}
                                    <div class="col-span-2 sm:col-span-2">
                                        <div class="grid grid-cols-2 gap-2">
                                            <div class="col-span-1/2 sm:col-span-1/2 mt-5">
                                                <x-label for="monday_time" class="font-semibold">
                                                    <input type="checkbox" class="form-input h-5 leading-none mr-2 rounded shadow-sm w-5 " name="monday" id="monday" />Monday
                                                </x-label>
                                            </div>
                                            <div class="col-span-1/2 sm:col-span-1/2">
                                                <x-form-input type="time" name="monday_time" oldValue="{{ old('monday_time') }}"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-2 sm:col-span-2">
                                        <div class="grid grid-cols-2 gap-2">
                                            <div class="col-span-1/2 sm:col-span-1/2 mt-5">
                                                <x-label for="tuesday_time" class="font-semibold">
                                                    <input type="checkbox" class="form-input h-5 leading-none mr-2 rounded shadow-sm w-5" name="tuesday" id="tuesday" />Tuesday
                                                </x-label>
                                            </div>
                                            <div class="col-span-1/2 sm:col-span-1/2">
                                                <x-form-input type="time" name="tuesday_time" oldValue="{{ old('tuesday_time') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-2 sm:col-span-2">
                                        <div class="grid grid-cols-2 gap-2">
                                            <div class="col-span-1/2 sm:col-span-1/2 mt-5">
                                                <x-label for="wednesday_time" class="font-semibold">
                                                    <input type="checkbox" class="form-input h-5 leading-none mr-2 rounded shadow-sm w-5" name="wednesday" id="wednesday" />Wednesday
                                                </x-label>
                                            </div>
                                            <div class="col-span-1/2 sm:col-span-1/2">
                                                <x-form-input type="time" name="wednesday_time" oldValue="{{ old('wednesday_time') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-2 sm:col-span-2">
                                        <div class="grid grid-cols-2 gap-2">
                                            <div class="col-span-1/2 sm:col-span-1/2 mt-5">
                                                <x-label for="thursday_time" class="font-semibold">
                                                    <input type="checkbox" class="form-input h-5 leading-none mr-2 rounded shadow-sm w-5" name="thursday" id="thursday" />Thursday
                                                </x-label>
                                            </div>
                                            <div class="col-span-1/2 sm:col-span-1/2">
                                                <x-form-input type="time" name="thursday_time" oldValue="{{ old('thursday_time') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-2 sm:col-span-2">
                                        <div class="grid grid-cols-2 gap-2">
                                            <div class="col-span-1/2 sm:col-span-1/2 mt-5">
                                                <x-label for="friday_time" class="font-semibold">
                                                    <input type="checkbox" class="form-input h-5 leading-none mr-2 rounded shadow-sm w-5" name="friday" id="friday" />Friday
                                                </x-label>
                                            </div>
                                            <div class="col-span-1/2 sm:col-span-1/2">
                                                <x-form-input type="time" name="friday_time" oldValue="{{ old('friday_time') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-2 sm:col-span-2">
                                        <div class="grid grid-cols-2 gap-2">
                                            <div class="col-span-1/2 sm:col-span-1/2 mt-5">
                                                <x-label for="saturday_time" class="font-semibold">
                                                    <input type="checkbox" class="form-input h-5 leading-none mr-2 rounded shadow-sm w-5" name="saturday" id="saturday" />Saturday
                                                </x-label>
                                            </div>
                                            <div class="col-span-1/2 sm:col-span-1/2">
                                                <x-form-input type="time" name="saturday_time" oldValue="{{ old('saturday_time') }}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-2 sm:col-span-2">
                                        <div class="grid grid-cols-2 gap-2">
                                            <div class="col-span-1/2 sm:col-span-1/2 mt-5">
                                                <x-label for="sunday_time" class="font-semibold">
                                                    <input type="checkbox" class="form-input h-5 leading-none mr-2 rounded shadow-sm w-5" name="sunday" id="sunday" />Sunday
                                                </x-label>
                                            </div>
                                            <div class="col-span-1/2 sm:col-span-1/2">
                                                <x-form-input type="time" name="sunday_time" oldValue="{{ old('sunday_time') }}" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="route_id" class="font-semibold">Route</x-label>
                                            <x-select :lists="$routes" name="route_id" oldValue="{{ old('route_id') }}" @change="selectChanged({{$routes}}, $event.target.value, 'route')" selected="none"/>
                                        </div>

                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="company_id" class="font-semibold">Company Interline</x-label>
                                            <x-select :lists="$companies" name="company_id" oldValue="{{ old('company_id') }}"/>
                                        </div>

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

                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="bus_id" class="font-semibold">Bus</x-label>
                                            <x-select :lists="$buses" name="bus_id"  oldValue="{{ old('bus_id') }}"/>
                                        </div>

                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="driver_id" class="font-semibold">Driver</x-label>
                                            <x-select :lists="$drivers" name="driver_id" display="fullname"  oldValue="{{ old('driver_id') }}"/>
                                        </div>

                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="start_date" class="font-semibold" :dateRange="0">Start Date</x-label>
                                            <x-datepicker name="start_date"/>
                                        </div>

                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="end_date" class="font-semibold" :dateRange="0">End Date</x-label>
                                            <x-datepicker name="end_date"/>
                                        </div>

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