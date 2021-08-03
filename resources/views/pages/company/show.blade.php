<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Agency Management')}}" currentPage="Show" route="{{ route('company.index') }}"> 
                    <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    {{ $company->name }}
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
                    <toggle v-slot="{ display, toggled, toggleFalse,selectChanged }">
                        <form action="{{ route('company.update', $company->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="grid grid-cols-6 gap-6">

                                <image-render :item="{{$company}}">
                                    <x-file-upload divClass="col-span-12 sm:col-span-12"/>
                                </image-render>

                                <div class="col-span-12 sm:col-span-12">
                                    <x-label for="name" class="font-semibold">Name</x-label>
                                    <x-form-input type="text" name="name" id="name" value="{{ $company->name }}" />
                                </div>
                                <google-auto-complete v-slot="{ address }">
                                    <div class="col-span-full sm:col-span-full">
                                        <x-label for="address" class="font-semibold">Address</x-label>
                                        <x-form-input type="text" id="autocomplete" name="address" value="{{ $company->address }}" />
                                    </div>
                                </google-auto-complete>
                                {{-- <div class="col-span-6 sm:col-span-6">
                                    <x-label for="code" class="font-semibold">Code</x-label>
                                    <x-form-input type="text" name="code" id="code" value="{{ $company->code }}" />
                                </div> --}}
                                <div class="col-span-2 sm:col-span-2">
                                    <x-switch label="Agency to Transfer" name="company_to_transfer" rightLabel="Inactive" leftLabel="Active" type="modified" :item="$company"/>
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-switch label="Agency to Transfer" name="company_to_transfer" rightLabel="Inactive" leftLabel="Active" type="modified"  :item="$company"/>
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-switch label="Shipment of Packages" name="shipment_of_package" rightLabel="Inactive" leftLabel="Active" type="modified"  :item="$company"/>
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-switch label="Agency Interlines" name="company_interlines" rightLabel="Inactive" leftLabel="Active" type="modified"  :item="$company"/>
                                </div>
                                <div class="col-span-12 sm:col-span-12">
                                    <x-label for="discount" class="font-semibold">Discount</x-label>
                                    <x-form-input type="number" name="discount" id="discount" value="{{ $company->discount }}" />
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-switch label="Contract Company" name="contract_company" rightLabel="Inactive" leftLabel="Active" type="modified"  :item="$company"/>
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-switch label="Own Company" name="own_company" rightLabel="Inactive" leftLabel="Active" type="modified"  :item="$company"/>
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-switch label="Credit Assign" name="credit_assign" rightLabel="Inactive" leftLabel="Active" :hasParentToggle="1" :toshowdata="1" type="modified" :item="$company"/>
                                </div>

                                <div class="col-span-2 sm:col-span-2" v-if="display">
                                    <x-switch label="Type of Credit Line" name="type_of_credit_line" rightLabel="Limited" leftLabel="Unlimited" type="modified" :item="$company"/>
                                </div>

                                <div class="col-span-12 sm:col-span-12" v-if="display">
                                    <x-label for="max_credit_line" class="font-semibold">Max Credit Line</x-label>
                                    <x-form-input type="number" name="max_credit_line" id="max_credit_line" value="{{ $company->max_credit_line }}" />
                                </div>
                                <div class="col-span-12 sm:col-span-12" v-if="display">
                                    <x-label for="max_number_ticket" class="font-semibold">Max Number of Tickets</x-label>
                                    <x-form-input type="number" name="max_number_ticket" id="max_number_ticket" value="{{ $company->max_number_ticket }}" />
                                </div>
                                <div class="col-span-2 sm:col-span-2" v-if="display">
                                    <x-switch label="Print Bill" name="print_bill" rightLabel="Inactive" leftLabel="Active" type="modified" :item="$company"/>
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