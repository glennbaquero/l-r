<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Price Management')}}" route="{{ route('price.index') }}"></x-breadcrumb>
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
                    <auto-compute :items="{{ $cities }}" v-slot="{ departurePrice, arrivalPrice, roundtripPrice, cityChange, basePrice, basePriceChangeHandler }" has-error="{{ $errors->any() ?? 0 }}">
                        <form action="{{ route('price.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="departure_id" class="font-semibold">Departure</x-label>
                                    {{-- <x-select :lists="$cities" name="departure_id" id="departure_id" oldValue="{{ old('departure_id') }}" @change="cityChange($event.target.value, 'Departure')"/> --}}
                                    <x-select :lists="$cities" name="departure_id" id="departure_id" oldValue="{{ old('departure_id') }}" />
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="arrival_id" class="font-semibold">Arrival</x-label>
                                    {{-- <x-select :lists="$cities" name="arrival_id" id="arrival_id" oldValue="{{ old('arrival_id') }}" @change="cityChange($event.target.value, 'Arrival')"/> --}}
                                    <x-select :lists="$cities" name="arrival_id" id="arrival_id" oldValue="{{ old('arrival_id') }}"/>
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="currency_id" class="font-semibold">Currency</x-label>
                                    <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent disabled" name="currency_id" disabled>
                                        @foreach($currencies as $currency)
                                            <option value="{{ $currency->id }}" >{{ $currency->name }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <x-select :lists="$currencies" name="currency_id" oldValue="{{ old('currency_id') }}" selected="{{ $currencies[0]->id }}"/> --}}
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="adult_one_way" class="font-semibold">Adult One Way</x-label>
                                    <x-form-input type="number" min="0" name="adult_one_way" id="adult_one_way" step="any" oldValue="{{ old('adult_one_way') }}" />
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="adult_roundtrip" class="font-semibold">Adult Round Trip</x-label>
                                    <x-form-input type="number" min="0" name="adult_roundtrip" id="adult_roundtrip" step="any" oldValue="{{ old('adult_roundtrip') }}"/>
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="senior_one_way" class="font-semibold">Senior One Way</x-label>
                                    <x-form-input type="number" min="0" name="senior_one_way" id="senior_one_way" step="any" oldValue="{{ old('senior_one_way') }}"/>
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="senior_roundtrip" class="font-semibold">Senior Round Trip</x-label>
                                    <x-form-input type="number" min="0" name="senior_roundtrip" id="senior_roundtrip" step="any" oldValue="{{ old('senior_roundtrip') }}"/>
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="child_one_way" class="font-semibold">Child One Way</x-label>
                                    <x-form-input type="number" min="0" name="child_one_way" id="child_one_way" step="any" oldValue="{{ old('child_one_way') }}"/>
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="child_roundtrip" class="font-semibold">Child Round Trip</x-label>
                                    <x-form-input type="number" min="0" name="child_roundtrip" id="child_roundtrip" step="any" oldValue="{{ old('child_roundtrip') }}"/>
                                </div>

                                {{-- <div class="col-span-6 sm:col-span-6">
                                    <x-label for="price_per_mile" class="font-semibold">Price Per Mile</x-label>
                                     <x-form-input type="number" min="0" name="price_per_mile" id="price_per_mile" step="any" value="{{ old('price_per_mile') }}" @change="basePriceChangeHandler($event.target.value)"/>
                                </div> --}}

                                {{-- <div class="col-span-2 sm:col-span-2">
                                    <x-label for="departure_price" class="font-semibold">Departure Price</x-label>
                                    <x-form-input type="number" min="0" name="departure_price" id="departure_price" step="any" oldValue="{{ old('departure_price') }}" />
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="arrival_price" class="font-semibold">Arrival Price</x-label>
                                    <x-form-input type="number" min="0" name="arrival_price" id="arrival_price" step="any" oldValue="{{ old('arrival_price') }}" />
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="round_trip_price" class="font-semibold">Round Trip Price</x-label>
                                    <x-form-input type="number" min="0" name="round_trip_price" id="round_trip_price" step="any" oldValue="{{ old('round_trip_price') }}" />
                                </div> --}}
                                {{-- <div class="col-span-4 sm:col-span-3">
                                    <x-label for="minimum_price" class="font-semibold">Minimum Price</x-label>
                                    <x-form-input type="number" min="0" name="minimum_price" id="minimum_price" step="any" value="{{ old('minimum_price') }}" />
                                </div> --}}
                                {{-- <div class="col-span-4 sm:col-span-3">
                                    <x-label for="maximum_price" class="font-semibold">Maximum Price</x-label>
                                    <x-form-input type="number" min="0" name="maximum_price" id="maximum_price" step="any" value="{{ old('maximum_price') }}" />
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