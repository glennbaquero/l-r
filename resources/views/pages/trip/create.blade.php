<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Trip Management')}}" route="{{ route('trip.index') }}"></x-breadcrumb>
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
                    <toggle-select v-slot="{ display, conditionalFieldToDisplay, toggle, toggleFalse, selectChanged, item }">
                        <form action="{{ route('trip.store') }}" method="POST">
                            @csrf
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
                                    <x-label for="date" class="font-semibold">Date</x-label>
                                    <x-datepicker name="date"/>
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="time" class="font-semibold">Time</x-label>
                                    <x-datepicker name="time" type="time" format="hh:mm"/>
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="service_id" class="font-semibold">Service</x-label>
                                    <x-select :lists="$services" name="service_id" oldValue="{{ old('service_id') }}"/>
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="transport_type" class="font-semibold">Transport Type</x-label>
                                    <x-select :lists="$transport_types" name="transport_type" identifierValue="name" oldValue="{{ old('transport_type') }}" @change="selectChanged({{$routes}}, $event.target.value, 'transport_type')"/>
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="bus_id" class="font-semibold">Bus</x-label>
                                    <x-select :lists="$buses" name="bus_id"  oldValue="{{ old('bus_id') }}"/>
                                </div>

                                {{-- <div class="col-span-2 sm:col-span-2">
                                    <x-label for="crew_id" class="font-semibold">Crew</x-label>
                                    <x-select :lists="$crews" name="crew_id"  oldValue="{{ old('crew_id') }}"/>
                                </div> --}}

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="driver_id" class="font-semibold">Driver</x-label>
                                    <x-select :lists="$drivers" name="driver_id" display="fullname"  oldValue="{{ old('driver_id') }}"/>
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="main_co_driver_id" class="font-semibold">Main Co-Driver</x-label>
                                    <x-select :lists="$drivers" name="main_co_driver_id" display="fullname"  oldValue="{{ old('main_co_driver_id') }}"/>
                                </div>


                                {{-- <div class="col-span-2 sm:col-span-2">
                                    <template v-if="display">
                                        <x-label for="secondary_co_driver_id" class="font-semibold">Secondary Co-Driver</x-label>
                                        <x-select :lists="$drivers" name="secondary_co_driver_id" display="fullname"  oldValue="{{ old('secondary_co_driver_id') }}"/>
                                    </template>
                                </div> --}}

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="assistant_id" class="font-semibold">Assistant</x-label>
                                    <x-select :lists="$assistants" name="assistant_id" oldValue="{{ old('assistant_id') }}"/>
                                </div>
                                
                                <div class="col-span-2 sm:col-span-2">
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="discounted_tickets" class="font-semibold mt-2 mb-5">
                                        <input type="checkbox" class="form-input bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="discounted_tickets" id="discounted_tickets" />
                                        Discounted Ticket
                                    </x-label>
                                    <x-label for="additional_receipt" class="font-semibold">
                                        <input type="checkbox" class="form-input bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="additional_receipt" id="additional_receipt" />
                                        Additional Receipt/Price breakdown
                                    </x-label>
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="show_on_web" class="font-semibold mt-2 mb-5">
                                        <input type="checkbox" class="form-input bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="show_on_web" id="show_on_web" />
                                        Show On Web
                                    </x-label>
                                    <x-label for="express_trip" class="font-semibold">
                                        <input type="checkbox" class="form-input bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="express_trip" id="express_trip" />
                                        Express Trip
                                    </x-label>
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