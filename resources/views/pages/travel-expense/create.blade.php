<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Travel Expenses Management')}}" route="{{ route('travel-expense.index') }}"></x-breadcrumb>
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
                    <form action="{{ route('travel-expense.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-full sm:col-span-full">
                                <x-label for="type" class="font-semibold">Type</x-label>
                                <x-form-input type="text" name="type" id="type" value="{{ old('type') }}" />
                                <x-form-input type="hidden" name="trip_id" id="trip_id" value="{{ $trip->id }}" />
                            </div>

                            <div class="col-span-full sm:col-span-full">
                                <x-label for="description" class="font-semibold">Description</x-label>
                                <x-text-area name="description"/>
                            </div>

                            <div class="col-span-1 sm:col-span-1">
                                <x-switch label="Currency" name="is_currency_mex" type="modified" leftLabel="MEX" rightLabel="Dollar"/>
                            </div>

                            <div class="col-span-full sm:col-span-full">
                                <x-label for="amount" class="font-semibold">Amount</x-label>
                                <x-form-input type="number" step="any" min="0" name="amount" id="amount" value="{{ old('amount') }}" />
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