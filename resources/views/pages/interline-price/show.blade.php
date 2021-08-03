<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Interline Price Management')}}" currentPage="Show" route="{{ route('interline-price.index') }}"> 
                    <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    {{ $price->company->name }}
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
                    
                    <form action="{{ route('interline-price.update', $price->id) }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-full sm:col-span-full">
                                <x-label for="company_id" class="font-semibold">Agency</x-label>
                                <x-select :lists="$companies" name="company_id" :selected="$price->company_id"/>
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="departure_id" class="font-semibold">Departure</x-label>
                                <x-select :lists="$cities" name="departure_id" :selected="$price->departure_id"/>
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="arrival_id" class="font-semibold">Arrival</x-label>
                                <x-select :lists="$cities" name="arrival_id" :selected="$price->arrival_id"/>
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="currency_id" class="font-semibold">Currency</x-label>
                                <x-select :lists="$currencies" name="currency_id" :selected="$price->currency_id"/>
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="arrival_price" class="font-semibold">Arrival Price</x-label>
                                <x-form-input type="number" min="0" name="arrival_price" id="arrival_price" step="any" value="{{ $price->arrival_price }}" />
                            </div>
                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="departure_price" class="font-semibold">Departure Price</x-label>
                                <x-form-input type="number" min="0" name="departure_price" id="departure_price" step="any" value="{{ $price->departure_price }}" />
                            </div>
                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="round_trip_price" class="font-semibold">Round Trip Price</x-label>
                                <x-form-input type="number" min="0" name="round_trip_price" id="round_trip_price" step="any" value="{{ $price->round_trip_price }}" />
                            </div>
                            <div class="col-span-4 sm:col-span-3">
                                <x-label for="minimum_price" class="font-semibold">Minimum Price</x-label>
                                <x-form-input type="number" min="0" name="minimum_price" id="minimum_price" step="any" value="{{ $price->minimum_price }}" />
                            </div>
                            <div class="col-span-4 sm:col-span-3">
                                <x-label for="maximum_price" class="font-semibold">Maximum Price</x-label>
                                <x-form-input type="number" min="0" name="maximum_price" id="maximum_price" step="any" value="{{ $price->maximum_price }}" />
                            </div>
                        </div>
                        <div class="mt-5 text-left">
                            <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36">
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>