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
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-6 gap-6">
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

                            <div class="col-span-4 sm:col-span-3">
                                <x-label for="phone_number" class="font-semibold">Phone number</x-label>
                                <x-form-input type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" />
                            </div>

                            <div class="col-span-4 sm:col-span-3">
                                <x-label for="cellphone_number" class="font-semibold">Cellphone Number</x-label>
                                <x-form-input type="text" name="cellphone_number" id="cellphone_number" value="{{ old('cellphone_number') }}" />
                            </div>

                            <div class="col-span-4 sm:col-span-3">
                                <x-label for="address_line_1" class="font-semibold">Adddress 1</x-label>
                                <x-form-input type="text" name="address_line_1" id="address_line_1" value="{{ old('address_line_1') }}" />
                            </div>
                            <div class="col-span-4 sm:col-span-3">
                                <x-label for="address_line_2" class="font-semibold">Adddress 2</x-label>
                                <x-form-input type="text" name="address_line_2" id="address_line_2" value="{{ old('address_line_2') }}" />
                            </div>
                            <div class="col-span-4 sm:col-span-3">
                                <x-label for="city" class="font-semibold">City</x-label>
                                <x-form-input type="text" name="city" id="city" value="{{ old('city') }}" />
                            </div>
                            <div class="col-span-4 sm:col-span-3">
                                <x-label for="country" class="font-semibold">Country</x-label>
                                <x-select :lists="$countries" name="country" identifierValue="name"/>
                            </div>

                            <div class="col-span-4 sm:col-span-3">
                                <x-label for="zip_code" class="font-semibold">Zip Code/Postal Code</x-label>
                                <x-form-input type="text" name="zip_code" id="zip_code" value="{{ old('zip_code') }}" />
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

                            <div class="col-span-2 sm:col-span-2">
                                <x-switch label="Auto create driver" name="auto_create_driver" />
                            </div>

                            <div class="col-span-1 sm:col-span-1">
                                <x-switch label="Restrict hours" name="restrict_hours" />
                            </div>

                        </div>
                        <div class="mt-5 text-right">
                            <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36">
                                Save
                            </button>
                        </div>
                    </form>
                    {{-- <form-data submit-url="{{ route('user.store') }}">
                        
                    </form-data> --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>