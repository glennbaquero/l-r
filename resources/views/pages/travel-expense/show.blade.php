<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Travel Expense Management')}}" currentPage="Show" route="{{ route('travel-expense.index') }}"> 
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

        <div class="grid grid-cols-3 gap-2">

            <div class="col-span-full sm:col-span-full mt-4">
                <div class="flex flex-col">
                    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">

                        <h3 class="font-bold text-2xl">Balance</h3>

                        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
                            <table class="min-w-full text-xs">
                                <thead>
                                    <tr class="text-center">
                                        <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-50 leading-4 text-gray-500 uppercase tracking-wider font-bold">
                                            Currency
                                        </th>
                                        <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-50 leading-4 text-gray-500 uppercase tracking-wider font-bold">
                                            Income
                                        </th>
                                        <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-50 leading-4 text-gray-500 uppercase tracking-wider font-bold">
                                            Expenses
                                        </th>
                                        <th class="px-6 py-3 border-b-2 border-gray-300 bg-gray-50 leading-4 text-gray-500 uppercase tracking-wider font-bold">
                                            Balance
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <tr class="hover:bg-gray-100 cursor-pointer">
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            Dollar
                                        </td>
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            {{ $dollar['ingresos'] }}
                                        </td>
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            {{ $dollar['gastos'] }}
                                        </td>
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            {{ $dollar['balance'] }}
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-100 cursor-pointer">
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            MEX
                                        </td>
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            {{ $mex['ingresos'] }}
                                        </td>
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            {{ $mex['gastos'] }}
                                        </td>
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            {{ $mex['balance'] }}
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-100 cursor-pointer">
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            TOTAL
                                        </td>
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            {{ $total['ingresos'] }}
                                        </td>
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            {{ $total['gastos'] }}
                                        </td>
                                        <td class="px-6 py-2 whitespace-no-wrap text-center border-b border-gray-200 text-sm leading-5 font-medium text-gray-900">
                                            {{ $total['balance'] }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @foreach($expenses as $expense)
                <div class="col-span-1 sm:col-span-1">
                    <div class="mt-12 mx-auto w-full">
                        <div class="bg-white shadow sm:rounded-lg">
                            <div class="px-4 py-5 sm:p-6">
                                <form action="{{ route('travel-expense.update', $expense->id) }}" method="POST">
                                    @csrf
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-full sm:col-span-full">
                                            <x-label for="type" class="font-semibold">Type</x-label>
                                            <x-form-input type="text" name="type" id="type" value="{{ $expense->type }}" />
                                        </div>

                                        <div class="col-span-full sm:col-span-full">
                                            <x-label for="description" class="font-semibold">Description</x-label>
                                            <x-text-area name="description" value="{{$expense->description}}" />
                                        </div>

                                        <div class="col-span-1 sm:col-span-1">
                                            <x-switch label="Currency" name="is_currency_mex" type="modified" leftLabel="MEX" rightLabel="Dollar" :item="$expense"/>
                                        </div>

                                        <div class="col-span-full sm:col-span-full">
                                            <x-label for="amount" class="font-semibold">Amount</x-label>
                                            <x-form-input type="number" step="any" min="0" name="amount" id="amount" value="{{ $expense->amount }}" />
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
            @endforeach
        </div>
        
    </div>
</x-app-layout>