<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Payment Document Management')}}" currentPage="Show" route="{{ route('payment-document.index') }}"> 
                    <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    {{ $document->document_number }}
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
                    
                    <form action="{{ route('payment-document.update', $document->id) }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-6 gap-6" >
                            <div class="col-span-3 sm:col-span-3">
                                <x-label for="document_number" class="font-semibold">Document Number</x-label>
                                <x-form-input type="text" name="document_number" id="document_number" value="{{ $document->document_number }}" />
                            </div>

                            <div class="col-span-3 sm:col-span-3">
                                <x-label for="issued_date" class="font-semibold">Agent</x-label>
                                <multi-select :items="{{ $users }}" :multiple="false" label="fullname" name="user_id" :selected-value="{{ $document->user_id }}"></multi-select>
                            </div>

                            <div class="col-span-3 sm:col-span-3">
                                <x-label for="payment_document" class="font-semibold">Payment Document</x-label>
                                <multi-select :items="{{ $payment_documents }}" :multiple="false" label="label" name="payment_document" selected-value="{{ $document->payment_document }}"></multi-select>
                            </div>

                            <div class="col-span-3 sm:col-span-3">
                                <x-label for="issued_date" class="font-semibold">Issued Date</x-label>
                                <x-datepicker name="issued_date" :item="$document"/>
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="payment_type" class="font-semibold">Payment Type</x-label>
                                <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="payment_type">
                                    <option value="Cash" {{ $document->payment_type === 'Cash' ? 'selected' : '' }}>Cash</option>
                                    <option value="Credit Card" {{ $document->payment_type === 'Credit Card' ? 'selected' : '' }}>Credit Card</option>
                                    <option value="Other" {{ $document->payment_type === 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="amount" class="font-semibold">Amount</x-label>
                                <x-form-input type="number" step="any" name="amount" id="amount" value="{{ $document->amount }}" min="0" />
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="number_of_voucher" class="font-semibold">Number of Voucher</x-label>
                                <x-form-input type="number" step="any" name="number_of_voucher" id="number_of_voucher" value="{{ $document->number_of_voucher }}" min="0" />
                            </div>

                            <div class="col-span-full sm:col-span-full">
                                <x-label for="description" class="font-semibold">Description</x-label>
                                <x-text-area name="description" value="{{ $document->description }}"/>
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