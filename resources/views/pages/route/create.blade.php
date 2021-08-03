<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Route Management')}}" route="{{ route('route.index') }}"></x-breadcrumb>
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
                    <route-table v-slot="{ stops, addNewStop, removeStop, departureRouteChanged, arrivalChanged, convertToJSON, tripLengthTotal, waitTimeTotal, totalDistance, origin, destination, waypoints, firstDeparture, getAllPlaceLocation, loading }" :cities="{{ $cities }}" has-error="{{ $errors->any() ?? 0 }}">
                        <form action="{{ route('route.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="grid grid-cols-4 gap-4 mb-2">
                                <div class="col-span-full sm:col-span-full">
                                    <x-label for="name" class="font-semibold text-4xl">Route</x-label>
                                </div>
                            </div>

                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="name" class="font-semibold">Name</x-label>
                                    <x-form-input type="text" name="name" id="name" value="{{ old('name') }}" />
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="alias" class="font-semibold">Alias</x-label>
                                    <x-form-input type="text" name="alias" id="alias" value="{{ old('alias') }}" />
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="report_alias" class="font-semibold">Report Alias</x-label>
                                    <x-form-input type="text" name="report_alias" id="report_alias" value="{{ old('report_alias') }}" />
                                </div>

                                <div class="col-span-3 sm:col-span-3">
                                    <x-label for="departure_id" class="font-semibold">Departure</x-label>
                                    <select name="departure_id" class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" @change="departureRouteChanged($event.target.value)">
                                        <option disabled selected>Select your option</option>
                                        @foreach($cities as $city)
                                            <option value="{{$city->id}}" {{ old('departure_id') == $city->id ? 'selected' : ''}}>{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-span-3 sm:col-span-3">
                                    <x-label for="type_of_route" class="font-semibold">Type Of Route</x-label>
                                    <x-select :lists="$typeOfRoutes" name="type_of_route" identifierValue="name"/>
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="trip_length" class="font-semibold">Trip Length</x-label>
                                    <x-form-input type="text" name="trip_length" id="trip_length" v-model="tripLengthTotal" :readOnly="true"/>
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="wait_time" class="font-semibold">Wait Time</x-label>
                                    <x-form-input type="text" name="wait_time" id="wait_time" v-model="waitTimeTotal" :readOnly="true"/>
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="distance" class="font-semibold">Distance (KM)</x-label>
                                    <x-form-input type="number" name="distance" id="distance" v-model="totalDistance" :readOnly="true"/>
                                </div>
                                <input type="hidden" name="stops" :value="convertToJSON">
                            </div>

                            <div class="grid grid-cols-4 gap-4 mt-2 mb-2">
                                <div class="col-span-full sm:col-span-full">
                                    <x-label for="name" class="font-semibold text-4xl">Stops</x-label>
                                </div>
                            </div>

                            <x-table :headers="$headers">
                                <x-slot name="body">
                                    <tr v-for="(stop, key) in stops">
                                        {{-- <td class="text-center border-b-2 border-gray-300 px-3">
                                            <input type="radio" v-model="stop.division_point" />
                                        </td> --}}
                                        <td class="text-center border-b-2 border-gray-300 px-3">
                                            <input type="checkbox" v-model="stop.show" :disabled="stops.length == (key+1)" @change="getAllPlaceLocation"/>
                                        </td>
                                        <td class="text-center border-b-2 border-gray-300 px-3 w-1/2">
                                            <select class='form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent' v-model="stop.departure_id" disabled>
                                                @foreach($cities as $city)
                                                    <option value="{{$city->id}}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-center border-b-2 border-gray-300 px-3 w-1/2">
                                            <select class='form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent' v-model="stop.arrival_id" @change="arrivalChanged(key, $event.target.value)">
                                                @foreach($cities as $city)
                                                    <option value="{{$city->id}}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-center border-b-2 border-gray-300 px-3 w-1/2">
                                            <input type="time" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" v-model="stop.schedule_start">
                                        </td>
                                        <td class="text-center border-b-2 border-gray-300 px-3 w-1/2">
                                            <input type="time" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" v-model="stop.schedule_end">
                                        </td>
                                        <td class="text-center border-b-2 border-gray-300 px-3">
                                            <time-picker :stop="key" object-name="trip_length" :value="stop.trip_length"></time-picker>
                                            <input type="hidden" step="1" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" v-model="stop.trip_length" />
                                        </td>
                                        <td class="text-center border-b-2 border-gray-300 px-3">
                                            <time-picker :stop="key" object-name="wait_time" :value="stop.wait_time"></time-picker>
                                            <input type="hidden" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" v-model="stop.wait_time"/>
                                        </td>
                                        <td class="text-center border-b-2 border-gray-300 px-3">
                                            <input type="number" step="any" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none" v-model="stop.distance"/> 
                                        </td>
                                        <td class="text-center border-b-2 border-gray-300 px-3">
                                            <button type="button" class="inline-flex items-center justify-center border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5" @click="addNewStop">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                            </button>

                                            <button type="button" class="inline-flex items-center justify-center border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-if="key > 0" @click="removeStop(key)">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path></svg>
                                            </button>
                                        </td>
                                    </tr>
                                </x-slot>
                            </x-table>

                            <div style="width: 100%; height: 50vh" class="mt-6">
                                <google-map-direction :origin="origin" :destination="destination" :waypoints="waypoints"></google-map-direction>
                            </div>


                            <div class="mt-5 text-left">
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36">
                                    Save
                                </button>
                            </div>
                        </form>
                    </route-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>