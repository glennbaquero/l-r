<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Voucher Management')}}" route="{{ route('voucher.index') }}"></x-breadcrumb>
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
                    <toggle-select v-slot="{ display, toggle, toggleFalse,selectChanged, voucherType }">
                        <form action="{{ route('voucher.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-3 sm:col-span-3">
                                    <x-label for="passenger_id" class="font-semibold">Passenger</x-label>
                                    <multi-select :items="{{ $passengers }}" name="passenger_id" :multiple="false" label="fullname" v-slot="{ selected }"></multi-select>
                                </div>
                                <div class="col-span-3 sm:col-span-3">
                                    <x-label for="type_of_voucher" class="font-semibold">Type of Voucher</x-label>
                                    <x-select :lists="$types" name="type_of_voucher" identifierValue="value" display="label" @change="selectChanged({{$types}}, $event.target.value, 'voucher')"/>
                                </div>
                            </div>

                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-2 sm:col-span-2"  v-if="voucherType === 'Amount'">
                                    <x-label for="amount" class="font-semibold">Amount</x-label>
                                    <x-form-input type="number" step="any" min="0" name="amount" id="amount" value="{{ old('amount') }}" />
                                </div>

                                <div class="col-span-2 sm:col-span-2"  v-if="voucherType === 'Max. Courtesy Ticket'">
                                    <x-label for="max_no_of_ticket_courtesy" class="font-semibold">Max. # of Ticket Courtesy</x-label>
                                    <x-form-input type="number" step="any" min="0" name="max_no_of_ticket_courtesy" id="max_no_of_ticket_courtesy" value="{{ old('max_no_of_ticket_courtesy') }}" />
                                </div>

                                <div class="col-span-3 sm:col-span-3"  v-if="voucherType === 'Max. Ticket % Discount'">
                                    <x-label for="discount_percent" class="font-semibold">Discount Percent</x-label>
                                    <x-form-input type="number" step="any" min="0" name="discount_percent" id="discount_percent" value="{{ old('discount_percent') }}" />
                                </div>

                                <div class="col-span-3 sm:col-span-3"  v-if="voucherType === 'Max. Ticket % Discount'">
                                    <x-label for="max_no_of_discount_ticket" class="font-semibold">Max. Number of Discount Ticket</x-label>
                                    <x-form-input type="number" step="any" min="0" name="max_no_of_discount_ticket" id="max_no_of_discount_ticket" value="{{ old('max_no_of_discount_ticket') }}" />
                                </div>

                                <div :class="voucherType != 'Max. Ticket % Discount' ? 'col-span-2 sm:col-span-2' : 'col-span-3 sm:col-span-3'">
                                    <x-label for="expiration_date" class="font-semibold">Expiration Date</x-label>
                                    <x-datepicker name="expiration_date"/>
                                </div>

                                <div :class="voucherType != 'Max. Ticket % Discount' ? 'col-span-2 sm:col-span-2' : 'col-span-3 sm:col-span-3'">
                                    <x-label for="authorized_by" class="font-semibold">Authorized By</x-label>
                                    <x-form-input name="authorized_by" id="authorized_by" value="{{ old('authorized_by') }}" />
                                </div>

                            </div>


                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-full sm:col-span-full">
                                    <x-label for="description" class="font-semibold">Description</x-label>
                                    <x-text-area name="description" id="description"/>
                                </div>
                            </div>

                            <div class="mt-5 text-left">
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