<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Frequent Traveler Management')}}" currentPage="Show" route="{{ route('promotion.index') }}"> 
                    <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    {{ $promotion->type }}
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
                    <form action="{{ route('promotion.update', $promotion->id) }}" method="POST">
                        @csrf
                        <toggle-select v-slot="{ display, toggled, toggleFalse, selectChanged }" :display-default="{{ $promotion->filter_by == 'Date Range' ? 1 : 0 }}">
                            <div>
                                
                                <div class="grid grid-cols-6 gap-6">

                                    <div class="col-span-3 sm:col-span-2">
                                        <x-label for="type" class="font-semibold">Type</x-label>
                                        <x-select :lists="$types_filter" name="type" identifierValue="label" display="label" selected="{{ $promotion->type }}"/>
                                    </div>

                                    <div class="col-span-2 sm:col-span-2" >
                                        <x-label for="value" class="font-semibold">Value</x-label>
                                        <x-form-input type="number" step="any" min="0" name="value" id="value" value="{{ $promotion->value }}" />
                                    </div>
                                    <div class="col-span-2 sm:col-span-2" >
                                        <x-label for="point_equivalent" class="font-semibold">Point Equivalence</x-label>
                                        <x-form-input type="number" step="any" min="0" name="point_equivalent" id="point_equivalent" value="{{ $promotion->point_equivalent }}" />
                                    </div>

                                    <div class="col-span-3 sm:col-span-2">
                                        <x-label for="filter_by" class="font-semibold">Filter By</x-label>
                                        <x-select :lists="$filter_by" name="filter_by" identifierValue="label" display="label" selected="{{ $promotion->filter_by }}" @change="toggled"/>
                                    </div>
                                    

                                    <div class="col-span-2 sm:col-span-2" >
                                        <x-label for="date" class="font-semibold">@{{ display ? 'Start Date' : 'Date' }}</x-label>
                                        <x-datepicker name="date" :item="$promotion"/>
                                    </div>

                                    <div class="col-span-2 sm:col-span-2" v-if="display">
                                        <x-label for="end_date" class="font-semibold">End Date</x-label>
                                        <x-datepicker name="end_date" :item="$promotion"/>
                                    </div>
                                </div>
                                <toggle-select v-slot="{ display, toggled, toggleFalse, selectChanged }" v-if="display" :items="{{ $day_filter }}" selected-value-string="{{ $promotion->filter_day  }}" type="promotion">
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="col-span-2 sm:col-span-2">
                                            <x-label for="filter_day" class="font-semibold">Days</x-label>
                                            <x-select :lists="$day_filter" name="filter_day" identifierValue="label" display="label" selected="{{ $promotion->filter_day }}" @change="selectChanged({{$day_filter}}, $event.target.value, 'promotion')"/>
                                        </div>
                                        <div class="col-span-3 sm:col-span-3" v-if="display">
                                            <x-label for="days" class="font-semibold">Days</x-label>
                                            <multi-select :items="{{ $day_list }}" :multiple="true" name="days" :multiple="false" label="label" :selected-value="{{ $promotion->days ?? $promotion->days_selected }}"></multi-select>
                                        </div>
                                    </div>
                                </toggle-select>
                            </div>
                        </toggle-select>

                        

                        <toggle-select v-slot="{ display, toggled, toggleFalse, selectChanged, show_part_of_route, show_routes }" :items="{{ $apply_to_filter }}" selected-value-string="{{ $promotion->apply_to  }}" type="promotion_apply_to_filter">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="apply_to" class="font-semibold">Apply To</x-label>
                                    <x-select :lists="$apply_to_filter" name="apply_to" identifierValue="label" display="label" selected="{{ $promotion->apply_to }}" @change="selectChanged({{$apply_to_filter}}, $event.target.value, 'promotion_apply_to_filter')"/>
                                </div>
                                <div class="col-span-2 sm:col-span-2" v-if="show_part_of_route">
                                    <x-label for="departure_id" class="font-semibold">Departure</x-label>
                                    <multi-select :items="{{ $cities }}" :multiple="true" name="departure_id" :multiple="false" label="name" v-slot="{ selected }" :selected-value="{{ $promotion->departureIds }}"></multi-select>
                                </div>
                                <div class="col-span-2 sm:col-span-2" v-if="show_part_of_route">
                                    <x-label for="arrival_id" class="font-semibold">Arrival</x-label>
                                    <multi-select :items="{{ $cities }}" :multiple="true" name="arrival_id" :multiple="false" label="name" v-slot="{ selected }" :selected-value="{{ $promotion->arrivalIds }}"></multi-select>
                                </div>
                                <div class="col-span-3 sm:col-span-3" v-if="show_routes">
                                    <x-label for="route_id" class="font-semibold">Route</x-label>
                                    <multi-select :items="{{ $routes }}" :multiple="true" name="route_id" :multiple="false" label="name" v-slot="{ selected }" :selected-value="{{ $promotion->routeIds }}"></multi-select>
                                </div>
                                <div class="col-span-2 sm:col-span-2">
                                    <x-label for="tickets" class="font-semibold">Tickets</x-label>
                                    <x-select :lists="$ticket_filter" name="tickets" identifierValue="label" display="label" selected="{{ $promotion->tickets }}" />
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