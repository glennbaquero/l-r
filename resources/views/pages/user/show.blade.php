<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Users Management')}}" currentPage="Show" route="{{ route('user.index') }}"> 
                    <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    {{ $user->fullname }}
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
                    <google-auto-complete v-slot="{ address }" :item="{{$user}}">
                        <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                      
                            <div class="mb-3">
                                <toggle :item="{{ $user }}" toggleable-data="status">
                                    <div slot-scope="{ display, toggled }" class="flex items-center space-x-3">

                                        <!-- On: "bg-green-500", Off: "bg-red-500" -->
                                        <span  @click="toggled" role="checkbox" tabindex="0" aria-checked="false" aria-labelledby="toggleLabel" :class="display ? 'bg-green-500' : 'bg-red-500'" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:shadow-outline">
                                            <!-- On: "translate-x-5", Off: "translate-x-0" -->
                                            <span aria-hidden="true" :class="display ? 'translate-x-5' : 'translate-x-0'" class="inline-block h-5 w-5 rounded-full bg-white shadow transform transition ease-in-out duration-200"></span>
                                        </span>

                                        <span id="toggleLabel">
                                            <span class="text-sm leading-5 font-medium text-gray-900">Status </span>
                                        </span>
                                        <input type="checkbox" name="status" :checked="display" class="hidden">
                                    </div>

                                </toggle>
                            </div>
                            <div class="grid grid-cols-6 gap-6">

                                <image-render :item="{{$user}}">
                                    <x-file-upload/>
                                </image-render>

                                <div class="col-span-4 sm:col-span-3">
                                    <x-label for="firstname" class="font-semibold">First Name</x-label>
                                    <x-form-input type="text" name="firstname"  value="{{ $user->firstname }}" id="firstname" />
                                </div>
                                <div class="col-span-4 sm:col-span-3">
                                    <x-label for="lastname" class="font-semibold">Last Name</x-label>
                                    <x-form-input type="text" name="lastname"  value="{{ $user->lastname }}" id="lastname" />
                                </div>
                                <div class="col-span-4 sm:col-span-3">
                                    <x-label for="email" class="font-semibold">Email</x-label>
                                    <x-form-input type="email" name="email"  value="{{ $user->email }}" id="email" />
                                </div>
                                <div class="col-span-4 sm:col-span-3">
                                    <x-label for="username" class="font-semibold">Username</x-label>
                                    <x-form-input type="username" name="username"  value="{{ $user->username }}" id="username" />
                                </div>

                                <div class="col-span-4 sm:col-span-3">
                                    <x-label for="office" class="font-semibold">Office</x-label>
                                    <x-select :lists="$offices" name="office_id" :selected="$user->office_id" />
                                </div>

                                {{-- <div class="col-span-4 sm:col-span-3">
                                    <x-label for="group" class="font-semibold">Group</x-label>
                                    <x-select :lists="$groups" name="group_id" :selected="$user->group_id"/>
                                </div> --}}

                                <toggle-select v-slot="{ display, toggle, toggleFalse,selectChanged }" :items="{{$groups}}" :selected-value="{{ $user->group_id }}">
                                    <div class="col-span-4 sm:col-span-3">
                                        <div class="col-span-4 sm:col-span-3">
                                            <x-label for="group" class="font-semibold">Group</x-label>
                                            <x-select :lists="$groups" name="group_id" @change="selectChanged({{$groups}}, $event.target.value)" :selected="$user->group_id"/>
                                        </div>

                                        <div class="col-span-4 sm:col-span-3" v-if="display">
                                            <x-label for="commission" class="font-semibold">Commission</x-label>
                                            <x-form-input type="text" name="commission" id="commission" value="{{ $user->commission }}" />
                                        </div>
                                    </div>
                                </toggle-select>

                                <phone-number v-slot="{ handlePhoneFormat }">
                                    <div class="col-span-4 sm:col-span-3">
                                        <x-label for="phone_number" class="font-semibold">Phone number</x-label>
                                        <x-form-input type="text" name="phone_number"  value="{{ $user->phone_number }}" id="phone_number" @input="handlePhoneFormat" />
                                    </div>
                                </phone-number>

                                <phone-number v-slot="{ handlePhoneFormat }">
                                    <div class="col-span-4 sm:col-span-3">
                                        <x-label for="cellphone_number" class="font-semibold">Cellphone Number</x-label>
                                        <x-form-input type="text" name="cellphone_number"  value="{{ $user->cellphone_number }}" id="cellphone_number" @input="handlePhoneFormat" />
                                    </div>
                                </phone-number>
                                {{-- <google-auto-complete v-slot="{ address }"> --}}
                                    <div class="col-span-4 sm:col-span-3">
                                        <x-label for="address_line_1" class="font-semibold">Address 1</x-label>
                                        <x-form-input type="text" name="address_line_1" v-model="address.address_line_1" id="autocomplete" />
                                    </div>
                                {{-- </google-auto-complete> --}}
                                <div class="col-span-4 sm:col-span-3">
                                    <x-label for="address_line_2" class="font-semibold">Address 2</x-label>
                                    <x-form-input type="text" name="address_line_2"  value="{{ $user->address_line_2 }}" id="address_line_2" />
                                </div>
                                <div class="col-span-4 sm:col-span-3">
                                    <x-label for="city" class="font-semibold">City</x-label>
                                    <x-form-input type="text" name="city" v-model="address.city" />
                                </div>
                                <div class="col-span-4 sm:col-span-3">
                                    <x-label for="country" class="font-semibold">Country</x-label>
                                    <x-select :lists="$countries" name="country"  :selected="$user->country" identifierValue="name"/>
                                </div>

                                <div class="col-span-4 sm:col-span-3">
                                    <x-label for="zip_code" class="font-semibold">Zip Code/Postal Code</x-label>
                                    <x-form-input type="text" name="zip_code" v-model="address.postal_code" id="zip_code" />
                                </div>
                                
                                <div class="col-span-4 sm:col-span-3">
                                    <x-switch label="Gender" name="gender" type="modify" rightLabel="Male" leftLabel="Female" :item="$user" />
                                </div>

                                <div class="col-span-1 sm:col-span-1">
                                    <x-switch label="Record Sales" name="record_sales" :item="$user" />
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-switch label="Can print ticket on express sale" name="can_print_ticket" :item="$user" />
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-switch label="Auto create driver" name="auto_create_driver" :item="$user" />
                                </div>

                                <div class="col-span-1 sm:col-span-1">
                                    <x-switch label="Restrict hours" name="restrict_hours" :item="$user" />
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