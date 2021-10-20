<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6 text-sm">
        <div class="flex items-center">
            <div class="text-base mr-auto">
                <span class="">{{__('Welcome')}}</span>
                <span class="font-semibold">{{auth()->user()->fullname}}</span>,
            </div>
        </div>

        <div class="mt-10">
            <qr-scanner></qr-scanner>
        </div>
    </div>
</x-app-layout>
