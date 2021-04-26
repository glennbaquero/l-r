<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">
                <span class="font-semibold mr-3">{{__('Open/Close Office')}}</span>
            </div>
        </div>

        <div class="mt-12 mx-auto w-3/4">
            <div class="bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <div class="grid grid-cols-2 gap-1">
                        <div class="col-span-1 my-auto sm:col-span-1 text-right">
                            <p>Do you want to <b>{{ $office->close_office ? 'open' : 'close' }}</b> this office <b>({{ $office->name }})</b>?</p>
                        </div>
                        <div class="col-span-1 sm:col-span-1">
                            <a href="{{route('office.openclose.update', $office->id)}}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36">
                                Confirm
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>