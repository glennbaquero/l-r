<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">
                <span class="font-semibold mr-3">{{__('Sales By Voucher')}}</span>
            </div>
        </div>

        <div class="mt-12 mx-auto h-full">
            <pdf-viewer v-slot="{ src, getSalesByVoucherPdfData, viewer_show, loading }"  search-url="{{ route('sales-by-voucher.print') }}">
                <div class="grid grid-cols-12 gap-3">
                    {{-- <div class="col-span-1 sm:col-span-1"> --}}
                        {{-- <div class="grid grid-cols-2 gap-3"> --}}

                            <div class="col-span-1 sm:col-span-1">
                                <x-switch label="Type of Voucher" name="type_of_voucher" rightLabel="Used" leftLabel="Open" type="modified"/>
                            </div>

                            <div class="col-span-1 sm:col-span-1 my-auto">
                                <button class="bg-darkblue border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center p-4 rounded-md sm:leading-5 sm:text-sm text-white transition w-40" @click="getSalesByVoucherPdfData">
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