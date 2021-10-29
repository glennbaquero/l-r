<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6 text-sm p-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">
                <span class="">{{__('Welcome')}}</span>
                <span class="font-semibold">{{auth()->user()->fullname}}</span>,
            </div>
        </div>

        <div class="mt-10">
            <enter-transaction-number
                url="{{ route('driver.validate-transaction-number') }}"
            ></enter-transaction-number>
        </div>
    </div>
</x-app-layout>
