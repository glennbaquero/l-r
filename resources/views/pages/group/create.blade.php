<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Group Management')}}" route="{{ route('group.index') }}"></x-breadcrumb>
            </div>
        </div>


        @if(Session::get('errors'))
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
                    <form action="{{ route('group.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-12 sm:col-span-12">
                                <x-label for="name" class="font-semibold">Name</x-label>
                                <x-form-input type="text" name="name" id="name" value="{{ old('name') }}" />
                            </div>

                            <div class="col-span-1 sm:col-span-1">
                                <x-switch label="See Message" name="see_message" />
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-switch label="Write Post" name="write_post" />
                            </div>

                            <div class="col-span-1 sm:col-span-1">
                                <x-switch label="Send Post" name="send_post" />
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-switch label="Authorized Power" name="authorized_power" />
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-switch label="Can Sell open" name="can_sell_open" />
                            </div>

                            {{-- <div class="col-span-1 sm:col-span-1">
                                <x-switch label="Download Report" name="download_report" />
                            </div> --}}

                        </div>
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