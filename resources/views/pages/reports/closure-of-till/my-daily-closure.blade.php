<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">
                <span class="font-semibold mr-3">{{__('Daily Till Closure Reports')}}</span>
            </div>
        </div>

        <div class="mt-12 mx-auto h-full">
            <pdf-viewer v-slot="{ src, filtered_cash_registers, getPdfMyDailyClosure, datePickerHasChangedHandler, viewer_show, loading }" :get-cash="{{ $cash_registers }}" search-url="{{ route('my-daily-closure.print') }}" :filtered-cash-register="true" >
                <div class="grid grid-cols-5 gap-3">
                    {{-- <div class="col-span-1 sm:col-span-1"> --}}
                        {{-- <div class="grid grid-cols-2 gap-3"> --}}
                            <toggle v-slot="{ display, toggled }">
                                <div class="col-span-2 sm:col-span-2 grid grid-cols-3 gap-3">
                                    <div class="col-span-1 sm:col-span-1 mx-auto">
                                        <x-label for="" class="font-semibold">Type</x-label>
                                        <div class="flex items-center space-x-3 mt-3">
                                            <span id="toggleLabel">
                                                <span class="text-sm leading-5 font-medium text-gray-900">Day </span>
                                            </span>
                                            <!-- On: "bg-green-500", Off: "bg-red-500" -->
                                            <span  @click="toggled" role="checkbox" tabindex="0" aria-checked="false" aria-labelledby="toggleLabel" :class="display ? 'bg-green-500' : 'bg-red-500'" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:shadow-outline">
                                                <!-- On: "translate-x-5", Off: "translate-x-0" -->
                                                <span aria-hidden="true" :class="display ? 'translate-x-5' : 'translate-x-0'" class="inline-block h-5 w-5 rounded-full bg-white shadow transform transition ease-in-out duration-200"></span>
                                            </span>

                                            <span id="toggleLabel">
                                                <span class="text-sm leading-5 font-medium text-gray-900">Date Range  </span>
                                            </span>
                                            <input type="checkbox" id="type" :checked="display" class="hidden">
                                        </div>
                                    </div>
                                    <div :class="display ? 'col-span-1 sm:col-span-1' : 'col-span-2 sm:col-span-2'">
                                        <x-label for="start_date" class="font-semibold">Start Date</x-label>
                                        <x-datepicker name="start_date" />
                                    </div>
                                    <div class="col-span-1 sm:col-span-1" v-show="display">
                                        <x-label for="end_date" class="font-semibold" :dateRange="0">End Date</x-label>
                                        <x-datepicker name="end_date"/>
                                    </div>
                                </div>
                            </toggle>
                            <div class="col-span-1 sm:col-span-1">
                                <x-label for="cash_register" class="font-semibold">Cash Register</x-label>
                                <multi-select :items="filtered_cash_registers" label="date" :multiple="false" v-slot="{ selected }" name="selectedIds" type="cash_register"></multi-select>
                            </div>
                            

                            <div class="col-span-1 sm:col-span-1 my-auto">
                                <button class="bg-darkblue border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center p-4 rounded-md sm:leading-5 sm:text-sm text-white transition w-40" @click="getPdfMyDailyClosure">
                                    Search
                                </button>
                            </div>

                        {{-- </div> --}}
                        {{-- <x-label for="name" class="font-semibold">Grouped: </x-label> --}}
                    {{-- </div> --}}

                    <div class="col-span-full sm:col-span-full">
                        <iframe src="{{ asset('storage/report.pdf') }}" class="w-full h-screen" id="pdf_viewer" v-show="viewer_show"></iframe>
                    </div>
                    <loading :show="loading"></loading>
                </div>
            </pdf-viewer>
        </div>
    </div>
</x-app-layout>