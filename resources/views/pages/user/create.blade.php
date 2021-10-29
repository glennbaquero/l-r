<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Users Management')}}" route="{{ route('user.index') }}"></x-breadcrumb>
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
                        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="grid grid-cols-6 gap-6">
                                <image-render>
                                    <x-file-upload />
                                </image-render>

                                <div class="col-span-4 sm:col-span-3">
                                    <x-label for="firstname" class="font-semibold">First Name</x-label>
                                    <x-form-input type="text" name="firstname" id="firstname" value="{{ old('firstname') }}" />
                                </div>
                                <div class="col-span-4 sm:col-span-3">
                                    <x-label for="lastname" class="font-semibold">Last Name</x-label>
                                    <x-form-input type="text" name="lastname" id="lastname" value="{{ old('lastname') }}" />
                                </div>
                                <div class="col-span-4 sm:col-span-3">
                                    <x-label for="email" class="font-semibold">Email</x-label>
                                    <x-form-input type="email" name="email" id="email" value="{{ old('email') }}" />
                                </div>
                                <div class="col-span-4 sm:col-span-3">
                                    <x-label for="username" class="font-semibold">Username</x-label>
                                    <x-form-input type="username" name="username" id="username" value="{{ old('username') }}" />
                                </div>

                                <div class="col-span-4 sm:col-span-3">
                                    <x-label for="office" class="font-semibold">Office</x-label>
                                    <x-select :lists="$offices" name="office_id" />
                                </div>

                                <toggle-select v-slot="{ display, toggle, toggleFalse,selectChanged }">
                                    <div class="col-span-4 sm:col-span-3">
                                        <div class="col-span-4 sm:col-span-3">
                                            <x-label for="group" class="font-semibold">Group</x-label>
                                            <x-select :lists="$groups" name="group_id" @change="selectChanged({{$groups}}, $event.target.value)"/>
                                        </div>

                                        <div class="col-span-4 sm:col-span-3" v-if="display">
                                            <x-label for="commission" class="font-semibold">Commission</x-label>
                                            <x-form-input type="text" name="commission" id="commission" value="{{ old('commission') }}" />
                                        </div>
                                    </div>
                                </toggle-select>

                                <phone-number v-slot="{ handlePhoneFormat }">
                                    <div class="col-span-4 sm:col-span-3">
                                        <x-label for="phone_number" class="font-semibold">Phone number</x-label>
                                        <x-form-input type="text" name="phone_number" id="phone_number" @input="handlePhoneFormat" value="{{ old('phone_number') }}" />
                                    </div>
                                </phone-number>
                                
                                <phone-number v-slot="{ handlePhoneFormat }">
                                    <div class="col-span-4 sm:col-span-3">
                                        <x-label for="cellphone_number" class="font-semibold">Cellphone Number</x-label>
                                        <x-form-input type="text" name="cellphone_number" id="cellphone_number" @input="handlePhoneFormat" value="{{ old('cellphone_number') }}" />
                                    </div>
                                </phone-number>

                                <div class="col-span-4 sm:col-span-3">
                                    <x-label for="address_line_1" class="font-semibold">Address 1</x-label>
                                    <x-form-input type="text" id="autocomplete" name="address_line_1" v-model="address.address_line_1" />
                                </div>

                                <div class="col-span-4 sm:col-span-3">
                                    <x-label for="address_line_2" class="font-semibold">Address 2</x-label>
                                    <x-form-input type="text" name="address_line_2" id="address_line_2" value="{{ old('address_line_2') }}" />
                                </div>
                                <div class="col-span-4 sm:col-span-3">
                                    <x-label for="city" class="font-semibold">City</x-label>
                                    <x-form-input type="text" name="city" id="city" v-model="address.city" />
                                </div>
                                <div class="col-span-4 sm:col-span-3">
                                    <x-label for="country" class="font-semibold">Country</x-label>
                                    <x-select :lists="$countries" name="country" identifierValue="name" selected="UNITED STATES"/>
                                </div>

                                <div class="col-span-4 sm:col-span-3">
                                    <x-label for="zip_code" class="font-semibold">Zip Code/Postal Code</x-label>
                                    <x-form-input type="text" name="zip_code" id="zip_code" v-model="address.postal_code" />
                                </div>
                                
                                <div class="col-span-4 sm:col-span-3">
                                    <x-switch label="Gender" name="gender" type="modify" rightLabel="Male" leftLabel="Female"/>
                                </div>

                                <div class="col-span-1 sm:col-span-1">
                                    <x-switch label="Record Sales" name="record_sales" />
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-switch label="Can print ticket on express sale" name="can_print_ticket" />
                                </div>

                                <div class="col-span-1 sm:col-span-1">
                                    <x-switch label="Restrict hours" name="restrict_hours" />
                                </div>

                            </div>

                            <toggle :item="{{ auth()->user() }}" :hasParentToggle="0" v-slot="{ display, toggled }">

                                <div class="grid grid-cols-6 gap-2 mt-6">
                                    <div class="col-span-2 sm:col-span-2">
                                        {{-- <x-switch label="Auto create driver" name="auto_create_driver" /> --}}

                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="" class="font-semibold">Auto create driver</x-label>
                                            <div class="flex items-center space-x-3 mt-3">
                                                <span id="toggleLabel">
                                                    <span class="text-sm leading-5 font-medium text-gray-900">No </span>
                                                </span>
                                                <!-- On: "bg-green-500", Off: "bg-red-500" -->
                                                <span  @click="toggled" role="checkbox" tabindex="0" aria-checked="false" aria-labelledby="toggleLabel" :class="display ? 'bg-green-500' : 'bg-red-500'" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:shadow-outline">
                                                    <!-- On: "translate-x-5", Off: "translate-x-0" -->
                                                    <span aria-hidden="true" :class="display ? 'translate-x-5' : 'translate-x-0'" class="inline-block h-5 w-5 rounded-full bg-white shadow transform transition ease-in-out duration-200"></span>
                                                </span>

                                                <span id="toggleLabel">
                                                    <span class="text-sm leading-5 font-medium text-gray-900">Yes  </span>
                                                </span>
                                                <input type="checkbox" name="auto_create_driver" :checked="display" class="hidden">
                                            </div>
                                        </div>
                                    </div>

                                    <template v-if="display">

                                        <div class="col-span-6 sm:col-span-6">
                                        </div>
                                        <div class="col-span-3 sm:col-span-3">
                                            <x-label for="document_no" class="font-semibold">Commercial Driver License</x-label>
                                            <x-form-input type="text" name="document_no" id="document_no" value="{{ old('document_no') }}" />
                                        </div>
                                        <div class="col-span-3 sm:col-span-3">
                                            <x-label for="commission" class="font-semibold">Commission %</x-label>
                                            <x-form-input type="number" name="commission" value="{{ old('commission') }}" />
                                        </div>

                                        <div class="col-span-3 sm:col-span-3">
                                            <x-label for="license_type" class="font-semibold">License Type</x-label>
                                            <x-form-input type="text" name="license_type" value="{{ old('license_type') }}" />
                                        </div>

                                        <div class="col-span-3 sm:col-span-3">
                                            <x-label for="license_no" class="font-semibold">License Number</x-label>
                                            <x-form-input type="text" name="license_no" value="{{ old('license_no') }}" />
                                        </div>

                                        <div class="col-span-3 sm:col-span-3">
                                            <x-label for="license_expiration_date" class="font-semibold">License Expiration Date</x-label>
                                            <x-datepicker name="license_expiration_date" />
                                        </div>

                                        <div class="col-span-3 sm:col-span-3">
                                            <x-label for="last_medical_test_date" class="font-semibold">Last Medical Test Date</x-label>
                                            <x-datepicker name="last_medical_test_date" />
                                        </div>
                                        
                                        <div class="col-span-3 sm:col-span-3">
                                            <x-label for="next_medical_test_date" class="font-semibold">Next Medical Test Date</x-label>
                                            <x-datepicker name="next_medical_test_date" />
                                        </div>
                                    </template>
                                </div>
                            </toggle>
                            <div class="mt-5 text-left">
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36">
                                    Save
                                </button>
                            </div>
                        </form>

                    </google-auto-complete>
                    {{-- <form-data submit-url="{{ route('user.store') }}">
                        
                    </form-data> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>