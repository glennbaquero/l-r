<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Currency Management')}}" currentPage="Show" route="{{ route('currency.index') }}"> 
                    <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    {{ $currency->name }}
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
                    
                    <form action="{{ route('currency.update', $currency->id) }}" method="POST">
                        @csrf
                
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-12 sm:col-span-12">
                                <x-label for="name" class="font-semibold">Name</x-label>
                                <x-form-input type="text" name="name" id="name" value="{{ $currency->name }}" />
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <x-label for="equivalent_in_dollars_principle_tills" class="font-semibold">Equivalency in Dollars - Principle Tills</x-label>
                                <x-form-input type="text" name="equivalent_in_dollars_principle_tills" id="equivalent_in_dollars_principle_tills" value="{{ $currency->equivalent_in_dollars_principle_tills }}" />
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <x-label for="equivalent_in_dollars_additional_tills" class="font-semibold">Equivalency in Dollars - Additional Tills</x-label>
                                <x-form-input type="text" name="equivalent_in_dollars_additional_tills" id="equivalent_in_dollars_additional_tills" value="{{ $currency->equivalent_in_dollars_additional_tills }}" />
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <x-label for="symbol" class="font-semibold">Symbol</x-label>
                                <x-form-input type="text" name="symbol" id="name" value="{{ $currency->symbol }}" />
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <x-label for="country" class="font-semibold">Country</x-label>
                                <x-select :lists="$countries" name="country" :selected="$currency->country" identifierValue="name"/>
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-switch label="Default Currency" name="default_currency"  :item="$currency"/>
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