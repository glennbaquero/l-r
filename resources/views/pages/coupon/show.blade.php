<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Coupon Management')}}" currentPage="Show" route="{{ route('coupon.index') }}"> 
                    <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    {{ $coupon->promotion_name }}
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
                    <form action="{{ route('coupon.update', $coupon->id) }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-6 gap-2">
                            <div class="col-span-3 sm:col-span-3">
                                <x-label for="promotion_name" class="font-semibold">Promotion Name</x-label>
                                <x-form-input type="text" name="promotion_name" id="promotion_name" value="{{ $coupon->promotion_name }}" />
                            </div>
                            <div class="col-span-3 sm:col-span-3">
                                <x-label for="promotion_alias" class="font-semibold">Promotion Alias</x-label>
                                <x-form-input type="text" name="promotion_alias" id="promotion_alias" value="{{ $coupon->promotion_alias }}" />
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="applies_to" class="font-semibold">Coupon Applies To</x-label>
                                <x-select :lists="$applies_to" name="applies_to" identifierValue="label" display="label" selected="{{ $coupon->applies_to }}"/>
                            </div>
                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="coupon_type" class="font-semibold">Coupon Type</x-label>
                                <x-select :lists="$coupon_type" name="coupon_type" identifierValue="label" display="label" selected="{{ $coupon->coupon_type }}"/>
                            </div>
                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="value" class="font-semibold">Value</x-label>
                                <x-form-input type="number" min="0" step="any" name="value" id="value" value="{{ $coupon->value }}" />
                            </div>
                        </div>

                        <div class="grid grid-cols-6 gap-2">
                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="number_of_coupons" class="font-semibold"># of Coupons</x-label>
                                <x-form-input type="number" min="0" step="any" name="number_of_coupons" id="number_of_coupons" value="{{ $coupon->number_of_coupons }}" />
                            </div>
                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="coupon_used" class="font-semibold">Coupon Used</x-label>
                                <x-form-input type="number" min="0" step="any" name="coupon_used" id="coupon_used" value="{{ $coupon->coupon_used }}" readonly/>
                            </div>
                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="coupon_available" class="font-semibold">Coupon Available</x-label>
                                <x-form-input type="number" min="0" step="any" name="coupon_available" id="coupon_available" value="{{ $coupon->coupon_available }}" readonly/>
                            </div>
                            <div class="col-span-3 sm:col-span-3">
                                <x-label for="max_purchase_per_client" class="font-semibold">Maximum Purchase per Client</x-label>
                                <x-form-input type="number" min="0" step="any" name="max_purchase_per_client" id="max_purchase_per_client" value="{{ $coupon->max_purchase_per_client }}" />
                            </div>
                            <div class="col-span-3 sm:col-span-3">
                                <x-label for="max_per_bus" class="font-semibold">Maximum per Bus</x-label>
                                <x-form-input type="number" min="0" step="any" name="max_per_bus" id="max_per_bus" value="{{ $coupon->max_per_bus }}" />
                            </div>
                        </div>

                        <toggle-select v-slot="{ display, toggle, toggleFalse,selectChanged, voucherType }" :items="{{$filter_date}}"  selected-value-string="{{ $coupon->filter_by_date }}" type="voucher">
                            <div>
                                <div class="grid grid-cols-6 gap-2">
                                    <div class="col-span-2 sm:col-span-2">
                                        <x-label for="filter_by_date" class="font-semibold">Filter by date</x-label>
                                        <x-select :lists="$filter_date" name="filter_by_date" identifierValue="label" display="label" selected="{{ $coupon->filter_by_date }}" @change="selectChanged({{$filter_date}}, $event.target.value, 'voucher')"/>
                                    </div>
                                </div>

                                <toggle-select  v-if="voucherType === 'Travel' || voucherType === 'Both'" v-slot="{ display, toggled, toggleFalse,selectChanged, voucherType }" :display-default="{{ $coupon->trip_filter == 'Date Range' ? 1 : 0 }}">
                                    <div>
                                        <div class="grid grid-cols-6 gap-2">
                                            <div class="col-span-2 sm:col-span-2">
                                                <x-label for="trip_filter" class="font-semibold">Filter by date of trip</x-label>
                                                <x-select :lists="$filter_by" name="trip_filter" identifierValue="label" display="label" selected="Day" selected="{{ $coupon->trip_filter }}" @change="toggled"/>
                                            </div>

                                            <div class="col-span-2 sm:col-span-2" >
                                                <x-label for="trip_date" class="font-semibold">@{{ display ? 'Start Date' : 'Date' }}</x-label>
                                                <x-datepicker name="trip_date" :item="$coupon"/>
                                            </div>

                                            <div class="col-span-2 sm:col-span-2" v-if="display">
                                                <x-label for="trip_end_date" class="font-semibold">End Date</x-label>
                                                <x-datepicker name="trip_end_date" :item="$coupon"/>
                                            </div>
                                        </div>

                                        <toggle-select  v-if="display" v-slot="{ display, toggled, toggleFalse, selectChanged }" :items="{{ $filter_day_range }}" selected-value-string="{{ $coupon->trip_filter_day  }}" type="promotion">
                                            <div class="grid grid-cols-6 gap-6">
                                                <div class="col-span-2 sm:col-span-2">
                                                    <x-label for="trip_filter_day" class="font-semibold">Days</x-label>
                                                    <x-select :lists="$filter_day_range" name="trip_filter_day" identifierValue="label" display="label" selected="{{ $coupon->trip_filter_day }}" @change="selectChanged({{$filter_day_range}}, $event.target.value, 'promotion')"/>
                                                </div>
                                                <div class="col-span-3 sm:col-span-3" v-if="display">
                                                    <x-label for="trip_days" class="font-semibold">Filter Day</x-label>
                                                    <multi-select :items="{{ $day_list }}" :multiple="true" name="trip_days" label="label" :selected-value="{{ $coupon->trip_days ?? $coupon->days_selected }}"></multi-select>
                                                </div>
                                            </div>
                                        </toggle-select>
                                    </div>
                                </toggle-select>

                                <toggle-select  v-if="voucherType === 'Purchase' || voucherType === 'Both'" v-slot="{ display, toggled, toggleFalse,selectChanged, voucherType }" :display-default="{{ $coupon->purchase_date_filter == 'Date Range' ? 1 : 0 }}">
                                    <div>
                                        <div class="grid grid-cols-6 gap-2">
                                            <div class="col-span-2 sm:col-span-2">
                                                <x-label for="purchase_date_filter" class="font-semibold">Filter by Purchase Date</x-label>
                                                <x-select :lists="$filter_by" name="purchase_date_filter" identifierValue="label" display="label" selected="{{ $coupon->purchase_date_filter }}" @change="toggled"/>
                                            </div>

                                            <div class="col-span-2 sm:col-span-2" >
                                                <x-label for="purchase_date" class="font-semibold">@{{ display ? 'Start Date' : 'Date' }}</x-label>
                                                <x-datepicker name="purchase_date" :item="$coupon"/>
                                            </div>

                                            <div class="col-span-2 sm:col-span-2" v-if="display">
                                                <x-label for="purchase_end_date" class="font-semibold">End Date</x-label>
                                                <x-datepicker name="purchase_end_date" :item="$coupon"/>
                                            </div>
                                        </div>

                                        <toggle-select  v-if="display" v-slot="{ display, toggled, toggleFalse, selectChanged }" :items="{{ $filter_day_range }}" selected-value-string="{{ $coupon->purchase_date_filter_day  }}" type="promotion">
                                            <div class="grid grid-cols-6 gap-6">
                                                <div class="col-span-2 sm:col-span-2">
                                                    <x-label for="purchase_date_filter_day" class="font-semibold">Days</x-label>
                                                    <x-select :lists="$filter_day_range" name="purchase_date_filter_day" identifierValue="label" display="label" selected="{{ $coupon->trip_filter_day }}" @change="selectChanged({{$filter_day_range}}, $event.target.value, 'promotion')" />
                                                </div>
                                                <div class="col-span-3 sm:col-span-3" v-if="display">
                                                    <x-label for="purchase_date_days" class="font-semibold">Filter Day</x-label>
                                                    <multi-select :items="{{ $day_list }}" :multiple="true" name="purchase_date_days" :multiple="false" label="label" :selected-value="{{ $coupon->purchase_date_days ?? $coupon->days_selected }}"></multi-select>
                                                </div>
                                            </div>
                                        </toggle-select>
                                    </div>
                                </toggle-select>


                                <toggle-select v-slot="{ display, toggled, toggleFalse, selectChanged, show_part_of_route, show_routes }" :items="{{ $apply_to_filter }}" selected-value-string="{{ $coupon->apply_to  }}" type="promotion_apply_to_filter">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="apply_to" class="font-semibold">Apply To</x-label>
                                            <x-select :lists="$apply_to_filter" name="apply_to" identifierValue="label" display="label" selected="{{ $coupon->apply_to }}" @change="selectChanged({{$apply_to_filter}}, $event.target.value, 'promotion_apply_to_filter')"/>
                                        </div>

                                        <div class="col-span-2 sm:col-span-2" v-if="show_part_of_route">
                                            <x-label for="departure_id" class="font-semibold">Departure</x-label>
                                            <multi-select :items="{{ $cities }}" :multiple="true" name="departure_id" :multiple="false" label="name" v-slot="{ selected }" :selected-value="{{ $coupon->departureIds }}"></multi-select>
                                        </div>
                                        <div class="col-span-2 sm:col-span-2" v-if="show_part_of_route">
                                            <x-label for="arrival_id" class="font-semibold">Arrival</x-label>
                                            <multi-select :items="{{ $cities }}" :multiple="true" name="arrival_id" :multiple="false" label="name" v-slot="{ selected }" :selected-value="{{ $coupon->arrivalIds }}"></multi-select>
                                        </div>
                                        <div class="col-span-3 sm:col-span-3" v-if="show_routes">
                                            <x-label for="route_ids" class="font-semibold">Route</x-label>
                                            <multi-select :items="{{ $routes }}" :multiple="true" name="route_ids" :multiple="false" label="name" v-slot="{ selected }" :selected-value="{{ $coupon->route_ids ?? $coupon->days_selected }}"></multi-select>
                                        </div>
                                    </div>
                                </toggle-select>

                                <toggle :hasParentToggle="0" :toshowdata="0" v-slot="{ display, toggled }" :item="{{ $coupon }}" toggleable-data="apply_minimum_price">
                                    <div class="grid grid-cols-6 gap-2">
                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="service_ids" class="font-semibold">Service Type</x-label>
                                            <multi-select :items="{{ $services }}" :multiple="true" name="service_ids" :multiple="false" label="name" v-slot="{ selected }" :selected-value="{{ $coupon->service_ids ?? $coupon->days_selected }}"></multi-select>
                                        </div>

                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="trip_type" class="font-semibold">Trip Type</x-label>
                                            <multi-select :items="{{ $trip_type }}" :multiple="true" name="trip_type" :multiple="false" label="label" v-slot="{ selected }" :selected-value="{{ $coupon->trip_type ?? $coupon->days_selected }}"></multi-select>
                                        </div>

                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="ticket_type_ids" class="font-semibold">Ticket Type</x-label>
                                            <multi-select :items="{{ $ticket_types }}" :multiple="true" name="ticket_type_ids" :multiple="false" label="name" v-slot="{ selected }" :selected-value="{{ $coupon->ticket_type_ids ?? $coupon->days_selected }}"></multi-select>
                                        </div>

                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="base_fare" class="font-semibold">Base Fare</x-label>
                                            <multi-select :items="{{ $base_fare }}" :multiple="true" name="base_fare" :multiple="false" label="label" v-slot="{ selected }" :selected-value="{{ $coupon->base_fare ?? $coupon->days_selected }}"></multi-select>
                                        </div>

                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="" class="font-semibold">Apply Minimum Price</x-label>
                                            <div class="flex items-center space-x-3 mt-4">
                                                <span id="toggleLabelMinPrice">
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
                                                <input type="checkbox" name="apply_minimum_price" :checked="display" class="hidden">
                                            </div>
                                        </div>

                                        <div class="col-span-2 sm:col-span-2" v-if="display">
                                            <x-label for="minimum_price_value" class="font-semibold">Value</x-label>
                                            <x-form-input type="number" min="0" step="any" name="minimum_price_value" id="minimum_price_value" value="{{ $coupon->minimum_price_value }}" />
                                        </div>

                                    </div>
                                </toggle>

                                <div class="grid grid-cols-6 gap-2">
                                    <div class="col-span-2 sm:col-span-2">
                                        <x-label for="authorized_by" class="font-semibold">Authorized By</x-label>
                                        <x-select :lists="$users" name="authorized_by" display="fullname" :selected="$coupon->authorized_by"/>
                                    </div>

                                    <div class="col-span-4 sm:col-span-4">
                                        <x-label for="description" class="font-semibold">Description</x-label>
                                        <x-text-area name="description" id="description" value="{{ $coupon->description }}"/>
                                    </div>
                                </div>

                                <div class="grid grid-cols-6 gap-2">
                                    <div class="col-span-2 sm:col-span-2">
                                        <x-switch label="Daily Restart" name="daily_restart" rightLabel="Activate" leftLabel="Deactivate" type="modified" :item="$coupon"/>
                                    </div>

                                    <div class="col-span-2 sm:col-span-2">
                                        <x-switch label="Apply to Multiroute" name="apply_multiroute" rightLabel="Activate" leftLabel="Deactivate" type="modified" :item="$coupon"/>
                                    </div>
                                    <div class="col-span-2 sm:col-span-2">
                                        <x-switch label="Apply by Section" name="apply_by_section" rightLabel="Activate" leftLabel="Deactivate" type="modified" :item="$coupon"/>
                                    </div>

                                </div>

                            </div>
                            
                        </toggle-select>

                        

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