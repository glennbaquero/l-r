<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Expense Income Management')}}" currentPage="Show" route="{{ route('expense-income.index') }}"> 
                    <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    {{ $item->type }}
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
                    
                    <toggle-select v-slot="{ display, toggle, toggleFalse,selectChanged, voucherType }" :items="{{$types}}"  selected-value-string="{{ $item->type }}" type="voucher">
                        <form action="{{ route('expense-income.update', $item->id) }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-3 sm:col-span-3">
                                    <x-label for="type" class="font-semibold">Type</x-label>
                                    <select name="type" class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" @change="selectChanged('', $event.target.value, 'voucher')">
                                        <option disabled selected>{{__('Select your option')}}</option>
                                        <option value="Income" {{ $item->type == 'Income' ? 'selected' : '' }}>{{__('Income')}}</option>
                                        <option value="Expenses" {{ $item->type == 'Expenses' ? 'selected' : '' }}>{{__('Expenses')}}</option>
                                    </select>
                                </div>

                                <div class="col-span-3 sm:col-span-3">
                                    <x-label for="income_expense_type" class="font-semibold">{{__('Type of Expense/Income')}}</x-label>
                                    <select name="income_expense_type" class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent">
                                        <option disabled selected>{{__('Select your option')}}</option>

                                        @foreach($expenseTypes as $type)
                                            <option value="{{ $type['value'] }}" v-if="voucherType == 'Expenses'" {{ $item->income_expense_type == $type['value'] ? 'selected' : '' }}>{{ $type['label'] }}</option>
                                        @endforeach

                                        @foreach($incomeTypes as $type)
                                            <option value="{{ $type['value'] }}" v-if="voucherType == 'Income'" {{ $item->income_expense_type == $type['value'] ? 'selected' : '' }}>{{ $type['label'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-span-3 sm:col-span-3">
                                    <x-label for="authorized_by" class="font-semibold">{{__('Authorized By')}}</x-label>
                                    <multi-select :items="{{ $users }}" name="authorized_by" :multiple="false" label="fullname" v-slot="{ selected }" :selected-value="{{ $item->authorized_by }}"></multi-select>
                                </div>

                                <div class="col-span-3 sm:col-span-3">
                                    <x-label for="amount" class="font-semibold">{{__('Amount')}}</x-label>
                                    <x-form-input type="number" step="any" name="amount" id="amount" value="{{ $item->amount }}" />
                                </div>
                            </div>


                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-full sm:col-span-full">
                                    <x-label for="concept" class="font-semibold">{{__('Concept')}}</x-label>
                                    <x-text-area name="concept" id="concept" value="{{ $item->concept }}"/>
                                </div>
                            </div>
                            <div class="mt-5 text-left">
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36">
                                    {{__('Save')}}
                                </button>
                            </div>
                        </form>
                    </toggle-select>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>