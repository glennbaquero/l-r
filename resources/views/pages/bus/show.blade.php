<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Bus Management')}}" currentPage="Show" route="{{ route('bus.index') }}"> 
                    <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    {{ $bus->name }}
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
                    
                    <form action="{{ route('bus.update', $bus->id) }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-6 gap-6">

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="name" class="font-semibold">Name</x-label>
                                <x-form-input type="text"  name="name" value="{{ $bus->name }}" />
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="plate" class="font-semibold">Plate</x-label>
                                <x-form-input type="text" name="plate" id="plate" value="{{ $bus->plate }}" />
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="certificate" class="font-semibold">Certificate</x-label>
                                <x-form-input type="text" name="certificate" id="certificate" value="{{ $bus->certificate }}" />
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="bus_model_id" class="font-semibold">Model</x-label>
                                <x-select :lists="$models" name="bus_model_id" oldValue="{{ $bus->bus_model_id }}"/>
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="transport_type" class="font-semibold">Transport Type</x-label>
                                <x-select :lists="$types" name="transport_type" identifierValue="name" oldValue="{{ $bus->transport_type }}"/>
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="configuration_vehicular" class="font-semibold">Config Vehicular</x-label>
                                <x-form-input type="text" name="configuration_vehicular" id="configuration_vehicular" value="{{ $bus->configuration_vehicular }}" />
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-label for="brand" class="font-semibold">Brand</x-label>
                                <x-form-input type="text" name="brand" id="brand" value="{{ $bus->brand }}" />
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-switch label="First floor to show" name="first_floor_to_show" type="modified" rightLabel="First floor" leftLabel="Second floor" :item="$bus"/>
                            </div>

                            <div class="col-span-2 sm:col-span-2">
                                <x-switch label="Default Bus" name="default_bus" :item="$bus"/>
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