<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Cell Type Management')}}" currentPage="Show" route="{{ route('cell.index') }}"> 
                    <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    {{ $cell->name }}
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
                    
                    <icon-picker v-slot="{ item, selectIcon, icon }" :cell="{{ $cell }}">
                        <form action="{{ route('cell.update', $cell->id) }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-2 gap-2">
                                <div class="col-span-1/2 sm:col-span-1/2">
                                    <x-label for="name" class="font-semibold">Name</x-label>
                                    <x-form-input type="text" name="name" id="name" value="{{ $cell->name }}" />
                                </div>
                                <div class="col-span-1/2 sm:col-span-1/2">
                                    <x-label for="icon" class="font-semibold">Icon</x-label>
                                    <x-form-input type="text" name="icon" id="icon" v-model="item.icon" />
                                    <x-form-input type="hidden" name="image_path" v-model="item.image_path" />
                                </div>
                                <div class="col-span-full sm:col-span-full bg-gray-200 rounded-md px-4 py-2">
                                    <button type="button" @click="selectIcon('driver.png')" class="bg-driver bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>

                                    <button type="button" @click="selectIcon('seat_sold.png')" class="bg-seat_sold bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>

                                    <button type="button" @click="selectIcon('seat_selected.png')" class="bg-seat_selected bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>

                                    <button type="button" @click="selectIcon('seat_reserve.png')" class="bg-seat_reserve bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>

                                    <button type="button" @click="selectIcon('seat_available.png')" class="bg-seat_available bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>

                                    <button type="button" @click="selectIcon('seat_double_sold.png')" class="bg-seat_double_sold bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                </div>


                            </div>
                            <div class="mt-5 text-right">
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36">
                                    Save
                                </button>
                            </div>
                        </form>
                    </icon-picker>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>