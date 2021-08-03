<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Multi Route Management')}}" route="{{ route('multi-route.index') }}"></x-breadcrumb>
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
                    <multi-route-table v-slot="{ stops, addNewStop, removeStop, arrivalChanged, convertToJSON, routes, loading }" :cities="{{ $cities }}" :available-routes="{{ $routes }}" has-error="{{ $errors->any() ?? 0 }}">
                        <form action="{{ route('multi-route.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-4 gap-4 mb-2">
                                <div class="col-span-full sm:col-span-full">
                                    <x-label for="name" class="font-semibold text-4xl">Multi Route</x-label>
                                </div>
                            </div>

                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="alias" class="font-semibold">Alias</x-label>
                                    <x-form-input type="text" name="alias" id="alias" value="{{ old('alias') }}" />
                                    <input type="hidden" name="stops" id="stops" :value="convertToJSON">
                                </div>
                            </div>

                            <div class="grid grid-cols-4 gap-4 mt-2 mb-2">
                                <div class="col-span-full sm:col-span-full">
                                    <x-label for="name" class="font-semibold text-4xl">Stops</x-label>
                                </div>
                            </div>

                            <x-table :headers="$headers">
                                <x-slot name="body">
                                    <tr v-for="(stop, key) in stops" class="h-36">
                                        <td class="text-center border-b-2 border-gray-300 px-3">
                                            <select class='form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent' v-model="stop.departure_id" :disabled="key >= 1">
                                                @foreach($cities as $city)
                                                    <option value="{{$city->id}}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-center border-b-2 border-gray-300 px-3">
                                            <select class='form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent' v-model="stop.arrival_id" @change="arrivalChanged(key, $event.target.value, stop)">
                                                @foreach($cities as $city)
                                                    <option value="{{$city->id}}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="text-center border-b-2 border-gray-300 px-3">
                                            <input type="checkbox"  v-model="stop.auto"/>
                                        </td>
                                        <td class="text-center border-b-2 border-gray-300 px-3">
                                            <multi-select :items="stop.routes" :multiple="true" label="name" name="selected_items" :stop="stop" :selected-value="JSON.parse(stop.route_id)" :stop="stop"></multi-select>
                                            <input type="hidden" v-model="stop.route_id">
                                            {{-- <select class='form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent' v-model="stop.route_id">
                                                <option disabled selected v-if="!stop.routes.length">No route match</option>
                                                <option v-for="route in stop.routes" :value="route.id">@{{ route.name }}</option>
                                            </select> --}}
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

                            <div class="mt-5 text-left">
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36">
                                    Save
                                </button>
                            </div>
                        </form>
                    </multi-route-table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>