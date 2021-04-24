<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">
                <span class="font-semibold mr-3">{{__('Seat Transfer')}}</span>
            </div>
        </div>

        <div class="mt-12 mx-auto">
            <div class="sm:rounded-lg">
                <seat-transfer
                    :cities="{{ $cities }}"
                    fetch-trip-url="{{ route('seat-transfer.fetch-trip') }}"
                    generate-bus-url="{{ route('seat-transfer.generate-bus') }}"
                    seat-update-url="{{ route('seat-transfer.update') }}"
                ></seat-transfer>
            </div>
        </div>
    </div>
</x-app-layout>