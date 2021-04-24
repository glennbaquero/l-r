<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('City Management')}}" route="{{ route('city.index') }}"></x-breadcrumb>
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
                    <google-auto-complete v-slot="{ address }">
                        <form action="{{ route('city.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-12 sm:col-span-12">
                                    <x-label for="name" class="font-semibold">Name</x-label>
                                    <x-form-input type="text" name="name" id="autocomplete" v-model="address.city" />
                                </div>
                            </div>

                            <div style="width: 100%; height: 50vh">
                                <input type="hidden" name="latitude" id="latitude" value="{{old('latitude')}}">
                                <input type="hidden" name="longitude" id="longitude" value="{{old('longitude')}}">
                                <google-map :origin="address" :destination="address" v-slot="{ directionsURL, hasOrigin }">
                                    <iframe v-if="hasOrigin" style="height: 100%; width: 100%" id="map" :src="directionsURL" frameborder="0"></iframe>
                                </google-map>
                            </div>

                            <div class="mt-5 text-right">
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36">
                                    Save
                                </button>
                            </div>
                        </form>
                    </google-auto-complete>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>