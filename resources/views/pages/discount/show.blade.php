<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Promotion & Discount')}}" currentPage="Show" route="{{ route('discount.index') }}"> 
                    <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    {{ $discount->promotion_apply_to }}
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
                    <form action="{{ route('discount.update', $discount->id) }}" method="POST">
                        @csrf
                        <toggle-select v-slot="{ selectChanged, voucherType }" :items="{{$applies_to}}"  selected-value-string="{{ $discount->promotion_apply_to }}" type="voucher">
                            <div class="grid grid-cols-6 gap-2">
                                <div class="col-span-3 sm:col-span-3">
                                    <x-label for="promotion_apply_to" class="font-semibold">Promotion apply to</x-label>
                                    <x-select :lists="$applies_to" name="promotion_apply_to" identifierValue="label" display="label" selected="{{ $discount->promotion_apply_to }}" @change="selectChanged({{$applies_to}}, $event.target.value, 'voucher')"/>
                                </div>
                                <div class="col-span-3 sm:col-span-3" v-if="voucherType == 'All' || voucherType == 'None' || voucherType == 'Web' ">
                                    <x-label for="partnership" class="font-semibold">Partnership</x-label>
                                    <x-form-input type="text" name="partnership" id="partnership" value="{{ $discount->partnership }}" />
                                </div>
                            </div>
                        </toggle-select>

                        <toggle-select v-slot="{ selectChanged, voucherType }" :items="{{$change_types}}"  selected-value-string="{{ $discount->change_type }}" type="voucher">
                            <div class="grid grid-cols-6 gap-2">
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="change_type" class="font-semibold">Change Type</x-label>
                                    <x-select :lists="$change_types" name="change_type" identifierValue="label" display="label" selected="{{ $discount->change_type }}" @change="selectChanged({{$applies_to}}, $event.target.value, 'voucher')"/>
                                </div>

                                <div class="col-span-2 sm:col-span-2" v-if="voucherType == 'Increase' || voucherType == 'Discount'">
                                    <x-label for="type" class="font-semibold">Type</x-label>
                                    <x-select :lists="$discount_type" name="type" identifierValue="label" display="label" selected="{{ $discount->type }}" />
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="amount" class="font-semibold">Amount</x-label>
                                    <x-form-input type="number" step="any" min="0" name="amount" id="amount" value="{{ $discount->amount }}" />
                                </div>

                                <div class="col-span-2 sm:col-span-2" v-if="voucherType == 'Plane Fare'">
                                    <x-switch label="Apply Volume Discount" name="apply_volume_discount" :item="$discount"/>
                                </div>
                            </div>
                        </toggle-select>

                        <toggle :item="{{ auth()->user() }}" :hasParentToggle="0" :toshowdata="0" v-slot="{ display, toggled }">
                            <div>
                                <div class="grid grid-cols-6 gap-2">
                                    <div class="col-span-4 sm:col-span-4">
                                        <x-label for="option" class="font-semibold">Option</x-label>
                                        <x-form-input type="text" name="option" id="option" value="{{ $discount->option }}" />
                                    </div>

                                    <div class="col-span-2 sm:col-span-2">
                                        <x-label for="" class="font-semibold">Open Ticket Applies</x-label>
                                        <div class="flex items-center space-x-3 mt-3">
                                            <span id="toggleLabel">
                                                <span class="text-sm leading-5 font-medium text-gray-900">Deactivate </span>
                                            </span>
                                            <!-- On: "bg-green-500", Off: "bg-red-500" -->
                                            <span  @click="toggled" role="checkbox" tabindex="0" aria-checked="false" aria-labelledby="toggleLabel" :class="display ? 'bg-green-500' : 'bg-red-500'" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:shadow-outline">
                                                <!-- On: "translate-x-5", Off: "translate-x-0" -->
                                                <span aria-hidden="true" :class="display ? 'translate-x-5' : 'translate-x-0'" class="inline-block h-5 w-5 rounded-full bg-white shadow transform transition ease-in-out duration-200"></span>
                                            </span>

                                            <span id="toggleLabel">
                                                <span class="text-sm leading-5 font-medium text-gray-900">Activate  </span>
                                            </span>
                                            <input type="checkbox" name="open_ticket_applies" :checked="display" class="hidden">
                                        </div>
                                    </div>
                                </div>

                                <toggle v-if="!display" :item="{{ $discount }}" toggleable-data="max_per_bus" :hasParentToggle="0" :toshowdata="0" v-slot="{ display, toggled }">
                                    <div class="grid grid-cols-6 gap-2 mt-3">
                                        <div class="col-span-6 sm:col-span-6">
                                            <x-label for="" class="font-semibold">Maximum Per Bus</x-label>
                                            <div class="flex items-center space-x-3 mt-2">
                                                <span id="toggleLabel">
                                                    <span class="text-sm leading-5 font-medium text-gray-900">Unlimited </span>
                                                </span>
                                                <!-- On: "bg-green-500", Off: "bg-red-500" -->
                                                <span  @click="toggled" role="checkbox" tabindex="0" aria-checked="false" aria-labelledby="toggleLabel" :class="display ? 'bg-green-500' : 'bg-red-500'" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:shadow-outline">
                                                    <!-- On: "translate-x-5", Off: "translate-x-0" -->
                                                    <span aria-hidden="true" :class="display ? 'translate-x-5' : 'translate-x-0'" class="inline-block h-5 w-5 rounded-full bg-white shadow transform transition ease-in-out duration-200"></span>
                                                </span>

                                                <span id="toggleLabel">
                                                    <span class="text-sm leading-5 font-medium text-gray-900">Limited  </span>
                                                </span>
                                                <input type="checkbox" name="max_per_bus" :checked="display" class="hidden">
                                                <x-form-input type="number" step="any" min="0" name="max_per_bus_value" id="max_per_bus_value" value="{{ $discount->max_per_bus_value }}" v-if="display"/>
                                            </div>
                                        </div>
                                    </div>
                                </toggle>

                                <toggle-select v-if="!display" v-slot="{ display, toggled, toggleFalse, selectChanged, show_part_of_route, show_routes }"  :items="{{$apply_to_filter}}"  selected-value-string="{{ $discount->apply_to }}" type="promotion_apply_to_filter">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="apply_to" class="font-semibold">Apply To</x-label>
                                            <x-select :lists="$apply_to_filter" name="apply_to" identifierValue="label" display="label" selected="{{ $discount->apply_to }}" @change="selectChanged({{$apply_to_filter}}, $event.target.value, 'promotion_apply_to_filter')"/>
                                        </div>

                                        <div class="col-span-2 sm:col-span-2" v-if="show_part_of_route">
                                            <x-label for="departure_id" class="font-semibold">Departure</x-label>
                                            <multi-select :items="{{ $cities }}" :multiple="true" name="departure_id" :multiple="false" label="name" v-slot="{ selected }" :selected-value="{{ $discount->departureIds ?? $discount->days_selected }}"></multi-select>
                                        </div>
                                        <div class="col-span-2 sm:col-span-2" v-if="show_part_of_route">
                                            <x-label for="arrival_id" class="font-semibold">Arrival</x-label>
                                            <multi-select :items="{{ $cities }}" :multiple="true" name="arrival_id" :multiple="false" label="name" v-slot="{ selected }" :selected-value="{{ $discount->arrivalIds ?? $discount->days_selected }}"></multi-select>
                                        </div>

                                        <div class="col-span-2 sm:col-span-2" v-if="show_routes">
                                            <x-label for="route_ids" class="font-semibold">Route</x-label>
                                            <multi-select :items="{{ $routes }}" :multiple="true" name="route_ids" :multiple="false" label="name" v-slot="{ selected }" :selected-value="{{ $discount->route_ids ?? $discount->days_selected }}"></multi-select>
                                        </div>

                                        <div class="col-span-2 sm:col-span-2" v-if="show_routes">
                                            <x-label for="multi_route_ids" class="font-semibold">Multi routes</x-label>
                                            <multi-select :items="{{ $multi_routes }}" :multiple="true" name="multi_route_ids" :multiple="false" label="alias" v-slot="{ selected }" :selected-value="{{ $discount->multi_route_ids ?? $discount->days_selected }}"></multi-select>
                                        </div>
                                    </div>
                                </toggle-select>


                            </div>
                        </toggle>


                        <toggle-select v-slot="{ display, toggled, toggleFalse,selectChanged, voucherType }" :display-default="{{ $discount->filter_by == 'Date Range' ? 1 : 0 }}">
                            <div>
                                <div class="grid grid-cols-6 gap-2">
                                    <div class="col-span-2 sm:col-span-2">
                                        <x-label for="filter_by" class="font-semibold">Filter by</x-label>
                                        <x-select :lists="$filter_by" name="filter_by" identifierValue="label" display="label" selected="{{ $discount->filter_by }}" @change="toggled"/>
                                    </div>

                                    <div class="col-span-2 sm:col-span-2" >
                                        <x-label for="date" class="font-semibold">@{{ display ? 'Start Date' : 'Date' }}</x-label>
                                        <x-datepicker name="date" :item="$discount"/>
                                    </div>

                                    <div class="col-span-2 sm:col-span-2" v-if="display">
                                        <x-label for="end_date" class="font-semibold" >End Date</x-label>
                                        <x-datepicker name="end_date" :item="$discount"/>
                                    </div>
                                </div>

                                <toggle-select  v-if="display" v-slot="{ display, toggled, toggleFalse, selectChanged }" :items="{{ $filter_day_range }}" selected-value-string="{{ $discount->filter_day  }}" type="promotion">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="filter_day" class="font-semibold">Days</x-label>
                                            <x-select :lists="$filter_day_range" name="filter_day" identifierValue="label" display="label" selected="{{ $discount->filter_day }}" @change="selectChanged({{$filter_day_range}}, $event.target.value, 'promotion')"/>
                                        </div>
                                        <div class="col-span-3 sm:col-span-3" v-if="display">
                                            <x-label for="days" class="font-semibold">Filter Day</x-label>
                                            <multi-select :items="{{ $day_list }}" :multiple="true" name="days" :multiple="false" label="label" :selected-value="{{ $discount->days ?? $discount->days_selected }}"></multi-select>
                                        </div>
                                    </div>
                                </toggle-select>
                            </div>
                        </toggle-select>

                        <div class="grid grid-cols-6 gap-2">
                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="service_ids" class="font-semibold">Service Type</x-label>
                                <multi-select :items="{{ $services }}" :multiple="true" name="service_ids" :multiple="false" label="name" v-slot="{ selected }" :selected-value="{{ $discount->service_ids ?? $discount->days_selected }}"></multi-select>
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="ticket_type_ids" class="font-semibold">Ticket Type</x-label>
                                <multi-select :items="{{ $ticket_types }}" :multiple="true" name="ticket_type_ids" :multiple="false" label="name" v-slot="{ selected }" :selected-value="{{ $discount->ticket_type_ids ?? $discount->days_selected }}"></multi-select>
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="trip_type" class="font-semibold">Trip Type</x-label>
                                <multi-select :items="{{ $trip_type }}" :multiple="true" name="trip_type" :multiple="false" label="label" v-slot="{ selected }" :selected-value="{{ $discount->trip_type ?? $discount->days_selected }}"></multi-select>
                            </div>
                        </div>

                        <toggle :item="{{ $discount }}" toggleable-data="presales_day" :hasParentToggle="0" :toshowdata="0" v-slot="{ display, toggled }">
                            <div class="grid grid-cols-6 gap-2">
                                <div class="col-span-2 sm:col-span-2">
                                    <x-switch label="Apply to Ticket Type" name="apply_ticket_type"  :item="$discount"/>
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-switch label="Apply to Multiroute" name="apply_multiroute" rightLabel="Activate" leftLabel="Deactivate" type="modified"  :item="$discount"/>
                                </div>

                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="" class="font-semibold">Presales Days</x-label>
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
                                        <input type="checkbox" name="presales_day" :checked="display" class="hidden">
                                    </div>
                                </div>
                                <div class="col-span-full sm:col-span-full" v-if="display">
                                    <x-label for="presales_days" class="font-semibold">Days</x-label>
                                    <x-form-input type="text" name="presales_days" id="presales_days" value="{{ $discount->presales_days }}" />
                                </div>

                            </div>
                        </toggle>

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