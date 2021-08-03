<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Bus Management')}}" route="{{ route('bus.index') }}"></x-breadcrumb>
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
                    <form action="{{ route('bus.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="name" class="font-semibold">Name</x-label>
                                <x-form-input type="text"  name="name" value="{{ old('name') }}" />
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="plate" class="font-semibold">Plate</x-label>
                                <x-form-input type="text" name="plate" id="plate" value="{{ old('plate') }}" />
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="certificate" class="font-semibold">Certificate</x-label>
                                <x-form-input type="text" name="certificate" id="certificate" value="{{ old('certificate') }}" />
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="bus_model_id" class="font-semibold">Model</x-label>
                                <x-select :lists="$models" name="bus_model_id" oldValue="{{ old('bus_model_id') }}"/>
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="transport_type" class="font-semibold">Transport Type</x-label>
                                <x-select :lists="$types" name="transport_type" identifierValue="name" oldValue="{{ old('transport_type') }}"/>
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="configuration_vehicular" class="font-semibold">Config Vehicular</x-label>
                                <x-form-input type="text" name="configuration_vehicular" id="configuration_vehicular" value="{{ old('configuration_vehicular') }}" />
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="brand" class="font-semibold">Brand</x-label>
                                <x-form-input type="text" name="brand" id="brand" value="{{ old('brand') }}" />
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-switch label="First floor to show" name="first_floor_to_show" type="modified" rightLabel="First floor" leftLabel="Second floor"/>
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-switch label="Default Bus" name="default_bus"/>
                            </div>
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