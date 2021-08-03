<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Excess Luggage Support')}}" currentPage="Show" route="{{ route('baggage.index') }}"> 
                    <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    {{ $baggage->alias }}
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
                    
                    <toggle-select v-slot="{ display, conditionalFieldToDisplay, toggle, toggleFalse, selectChanged, item }"  :items="{{$tickets}}" :selected-value="{{ $baggage->ticket_id }}" type="baggage">
                        <form action="{{ route('baggage.update', $baggage->id) }}" method="POST">
                            @csrf

                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-4 sm:col-span-3">
                                    <x-label for="ticket_id" class="font-semibold">Ticket</x-label>
                                    <multi-select :items="{{ $tickets }}" name="ticket_id" :multiple="false" label="id" v-slot="{ selected }" :selected-value="{{ $baggage->ticket_id }}"></multi-select>
                                </div>
                            </div>

                            <div class="grid grid-cols-6 gap-6">
                                {{-- <div class="col-span-2 sm:col-span-2">
                                    <x-label for="ticket_id" class="font-semibold">Ticket</x-label>
                                    <x-select :lists="$tickets" name="ticket_id" display="id" @change="selectChanged({{$tickets}}, $event.target.value, 'baggage')" :selected="$baggage->ticket_id"/>
                                </div> --}}
                                <div class="col-span-full sm:col-span-full">
                                    <x-label for="ticket_id" class="font-semibold">Passenger</x-label>
                                    <x-form-input type="text" disabled="true" id="series" v-model="item.fullname" />
                                </div>
                            </div>
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="alias" class="font-semibold">Alias</x-label>
                                    <x-form-input type="text" name="alias" id="alias" value="{{ $baggage->alias }}" />
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="series" class="font-semibold">Series</x-label>
                                    <x-form-input type="text" name="series" id="series" value="{{ $baggage->series }}" />
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="correlative" class="font-semibold">Correlative</x-label>
                                    <x-form-input type="text" name="correlative" id="correlative" value="{{ $baggage->correlative }}" />
                                </div>
                                <div class="col-span-3 sm:col-span-3">
                                    <x-label for="payment_form" class="font-semibold">Form of Payment</x-label>
                                    <x-form-input type="text" name="payment_form" id="payment_form" value="{{ $baggage->payment_form }}" />
                                </div>
                                <div class="col-span-3 sm:col-span-3">
                                    <x-label for="payment_form" class="font-semibold">Payment Date</x-label>
                                    <x-datepicker name="payment_date" :item="$baggage"/>
                                </div>
                                <div class="col-span-3 sm:col-span-3">
                                    <x-label for="total_weight" class="font-semibold">Total Weight</x-label>
                                    <x-form-input type="number" name="total_weight" id="total_weight" value="{{ $baggage->total_weight }}" />
                                </div>
                                <div class="col-span-3 sm:col-span-3">
                                    <x-label for="total_amount" class="font-semibold">Total Amount</x-label>
                                    <x-form-input type="number" name="total_amount" id="total_amount" value="{{ $baggage->total_amount }}" />
                                </div>
                                <div class="col-span-3 sm:col-span-3">
                                    <x-label for="received_amount" class="font-semibold">Received Amount</x-label>
                                    <x-form-input type="number" min="0" name="received_amount" id="received_amount" value="{{ $baggage->received_amount }}" />
                                </div>
                                <div class="col-span-3 sm:col-span-3">
                                    <x-label for="return_cash" class="font-semibold">Return Cash</x-label>
                                    <x-form-input type="number" min="0" name="return_cash" id="return_cash" value="{{ $baggage->return_cash }}" />
                                </div>
                            </div>
                            <div class="mt-5 text-rleftight">
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36">
                                    Save
                                </button>
                            </div>
                        </form>
                    </toggle-select>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>