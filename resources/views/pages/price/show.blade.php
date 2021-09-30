<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">
                <x-breadcrumb currentModule="{{__('Price Management')}}" currentPage="Show" route="{{ route('price.index') }}"> 
                    <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    {{ $price->departure->name }}
                    
                </x-breadcrumb>
                <x-modal :hasFooter="false" maxWidth="max-w-screen-sm">
                    <x-slot name="button">
                        <button @click="toggled" type="button" class="bg-lightblue border-transparent h-9 hover:bg-lighterblue items-center rounded-md text-base text-center text-white w-44" >
                            Duplicate Price
                        </button>

                    </x-slot>
                    <x-slot name="title">
                        Duplicate
                    </x-slot>
                    <x-slot name="body">
                        <duplicate url="{{ route('price.duplicate', $price->id) }}" v-slot="{ actionHandler, loading, payload, modalMessage, modalTitle, showModal }">
                            <form action="{{ route('price.duplicate', $price->id) }}" method="POST">
                                <loading :show="loading"></loading>

                                <modal
                                    :body-message="modalMessage"
                                    :header-title="modalTitle"
                                    :show="showModal"
                                    :blade-extended="true"
                                ></modal>

                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-3 sm:col-span-3">
                                        <x-label for="departure_id" class="font-semibold">Departure</x-label>
                                        <x-select :lists="$cities" name="departure_id" id="departure_id" v-model="payload.departure_id"/>
                                    </div>

                                    <div class="col-span-3 sm:col-span-3">
                                        <x-label for="arrival_id" class="font-semibold">Arrival</x-label>
                                        <x-select :lists="$cities" name="arrival_id" id="arrival_id" v-model="payload.arrival_id"/>
                                    </div>
                                </div>
                                <div class="mt-5 text-left">
                                    <button type="button" @click="actionHandler" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36">
                                        Duplicate
                                    </button>
                                </div>
                            </form>
                        </duplicate>
                        
                    </x-slot>
                </x-modal>
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

                    <auto-compute :items="{{ $cities }}" v-slot="{ departurePrice, arrivalPrice, roundtripPrice, cityChange, basePrice, basePriceChangeHandler }" :item="{{ $price }}">
                        <form action="{{ route('price.update', $price->id) }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="departure_id" class="font-semibold">Departure</x-label>
                                    {{-- <x-select :lists="$cities" name="departure_id" id="departure_id" :selected="$price->departure_id" @change="cityChange($event.target.value, 'Departure')"/> --}}
                                    <x-select :lists="$cities" name="departure_id" id="departure_id" :selected="$price->departure_id"/>
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="arrival_id" class="font-semibold">Arrival</x-label>
                                    {{-- <x-select :lists="$cities" name="arrival_id" id="arrival_id" :selected="$price->arrival_id" @change="cityChange($event.target.value, 'Arrival')"/> --}}
                                    <x-select :lists="$cities" name="arrival_id" id="arrival_id" :selected="$price->arrival_id"/>
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="currency_id" class="font-semibold">Currency</x-label>
                                    <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent disabled" name="currency_id" disabled>
                                        @foreach($currencies as $currency)
                                            <option value="{{ $currency->id }}" {{ $currency->id == $price->currency_id ? 'selected' : '' }}>{{ $currency->name }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <x-select :lists="$currencies" name="currency_id" :selected="$price->currency_id"/> --}}
                                </div>

                                {{-- <div class="col-span-6 sm:col-span-6">
                                    <x-label for="price_per_mile" class="font-semibold">Price Per Mile</x-label>
                                     <x-form-input type="number" min="0" name="price_per_mile" id="price_per_mile" step="any" value="{{ $price->price_per_mile }}" @change="basePriceChangeHandler($event.target.value)"/>
                                </div> --}}
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="adult_one_way" class="font-semibold">Adult One Way</x-label>
                                    <x-form-input type="number" min="0" name="adult_one_way" id="adult_one_way" step="any" value="{{ $price->adult_one_way }}" />
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="adult_roundtrip" class="font-semibold">Adult Round Trip</x-label>
                                    <x-form-input type="number" min="0" name="adult_roundtrip" id="adult_roundtrip" step="any" value="{{ $price->adult_roundtrip }}"/>
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="senior_one_way" class="font-semibold">Senior One Way</x-label>
                                    <x-form-input type="number" min="0" name="senior_one_way" id="senior_one_way" step="any" value="{{ $price->senior_one_way }}"/>
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="senior_roundtrip" class="font-semibold">Senior Round Trip</x-label>
                                    <x-form-input type="number" min="0" name="senior_roundtrip" id="senior_roundtrip" step="any" value="{{ $price->senior_roundtrip }}"/>
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="child_one_way" class="font-semibold">Child One Way</x-label>
                                    <x-form-input type="number" min="0" name="child_one_way" id="child_one_way" step="any" value="{{ $price->child_one_way }}"/>
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="child_roundtrip" class="font-semibold">Child Round Trip</x-label>
                                    <x-form-input type="number" min="0" name="child_roundtrip" id="child_roundtrip" step="any" value="{{ $price->child_roundtrip }}"/>
                                </div>


                                {{-- <div class="col-span-2 sm:col-span-2">
                                    <x-label for="departure_price" class="font-semibold">Departure Price</x-label>
                                    <x-form-input type="number" min="0" name="departure_price" id="departure_price" step="any" value="{{ $price->departure_price }}" />
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="arrival_price" class="font-semibold">Arrival Price</x-label>
                                    <x-form-input type="number" min="0" name="arrival_price" id="arrival_price" step="any" value="{{ $price->arrival_price }}" />
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="round_trip_price" class="font-semibold">Round Trip Price</x-label>
                                    <x-form-input type="number" min="0" name="round_trip_price" id="round_trip_price" step="any" value="{{ $price->round_trip_price }}" />
                                </div> --}}
                                {{-- <div class="col-span-4 sm:col-span-3">
                                    <x-label for="minimum_price" class="font-semibold">Minimum Price</x-label>
                                    <x-form-input type="number" min="0" name="minimum_price" id="minimum_price" step="any" value="{{ $price->minimum_price }}" />
                                </div> --}}
                                {{-- <div class="col-span-4 sm:col-span-3">
                                    <x-label for="maximum_price" class="font-semibold">Maximum Price</x-label>
                                    <x-form-input type="number" min="0" name="maximum_price" id="maximum_price" step="any" value="{{ $price->maximum_price }}" />
                                </div> --}}
                            </div>
                            <div class="mt-5 text-left">
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36">
                                    Save
                                </button>
                            </div>
                        </form>
                    </auto-compute>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>