<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Driver Management')}}" route="{{ route('driver.index') }}"></x-breadcrumb>
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

                    <google-auto-complete v-slot="{ address }">
                        <form action="{{ route('driver.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="staff_type" class="font-semibold">Staff Type</x-label>
                                    <x-select :lists="$staff_types" name="staff_type" identifierValue="value" oldValue="{{ old('staff_type') }}"/>
                                </div>

                                {{-- <div class="col-span-6 sm:col-span-3">
                                    <x-label for="document_type" class="font-semibold">Document Type</x-label>
                                    <x-select :lists="$document_types" name="document_type" identifierValue="value" oldValue="{{ old('document_type') }}"/>
                                </div> --}}

                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="document_no" class="font-semibold">Commercial Driver License</x-label>
                                    <x-form-input type="text" name="document_no" id="document_no" value="{{ old('document_no') }}" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="first_name" class="font-semibold">First Name</x-label>
                                    <x-form-input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="last_name" class="font-semibold">Last Name</x-label>
                                    <x-form-input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="gender" class="font-semibold">Gender</x-label>
                                    <x-select :lists="$genders" name="gender" identifierValue="value" oldValue="{{ old('gender') }}"/>
                                </div>
                                <phone-number v-slot="{ handlePhoneFormat }">
                                    <div class="col-span-6 sm:col-span-3">
                                        <x-label for="phone_number" class="font-semibold">Phone Number</x-label>
                                        <x-form-input type="text" name="phone_number" id="phone_number" @input="handlePhoneFormat" value="{{ old('phone_number') }}" />
                                    </div>
                                </phone-number>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="email" class="font-semibold">Email</x-label>
                                    <x-form-input type="email" name="email" id="email" value="{{ old('email') }}" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="address_line_1" class="font-semibold">Address</x-label>
                                    <x-form-input type="text" id="autocomplete" name="address_line_1" v-model="address.address_line_1" />
                                    <input type="hidden" name="latitude" v-model="address.latitude">
                                    <input type="hidden" name="longitude" v-model="address.longitude">
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="city" class="font-semibold">City</x-label>
                                    <x-form-input type="text" name="city" id="city" v-model="address.city" />
                                    {{-- <x-select :lists="$cities" name="city" identifierValue="name"/> --}}
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="commission" class="font-semibold">Commission %</x-label>
                                    <x-form-input type="commission" name="commission" value="{{ old('commission') }}" />
                                </div>

                                <div class="col-span-full sm:col-span-full">
                                    <x-label for="license_type" class="font-semibold">License Type</x-label>
                                    <x-form-input type="license_type" name="license_type" value="{{ old('license_type') }}" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="license_no" class="font-semibold">License Number</x-label>
                                    <x-form-input type="license_no" name="license_no" value="{{ old('license_no') }}" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="license_expiration_date" class="font-semibold">License Expiration Date</x-label>
                                    <x-datepicker name="license_expiration_date" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="last_medical_test_date" class="font-semibold">Last Medical Test Date</x-label>
                                    <x-datepicker name="last_medical_test_date" />
                                </div>
                                
                                <div class="col-span-6 sm:col-span-3">
                                    <x-label for="next_medical_test_date" class="font-semibold">Next Medical Test Date</x-label>
                                    <x-datepicker name="next_medical_test_date" />
                                </div>

                                <div class="col-span-full sm:col-span-full">
                                    <x-switch label="Send notification for driver license expiration, last medical test date and next medical test date" name="by_default" />
                                </div>

                            </div>
                            <div class="mt-5 text-left">
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36">
                                    Save
                                </button>
                            </div>
                        </form>
                    </google-auto-complete>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>