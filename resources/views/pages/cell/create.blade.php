<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Type Cell Management')}}" route="{{ route('cell.index') }}"></x-breadcrumb>
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

        <div class="mt-12 mx-auto w-1/2">
            <div class="bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <icon-picker v-slot="{ item, selectIcon, icon }">
                        <form action="{{ route('cell.store') }}" method="POST">
                            @csrf
                            <div class="grid grid-cols-2 gap-2">
                                <div class="col-span-1/2 sm:col-span-1/2">
                                    <x-label for="name" class="font-semibold">Name</x-label>
                                    <x-form-input type="text" name="name" id="name" value="{{ old('name') }}" />
                                </div>
                                <div class="col-span-1/2 sm:col-span-1/2">
                                    <x-label for="icon" class="font-semibold">Icon</x-label>
                                    <x-form-input type="text" name="icon" id="icon" v-model="item.icon" />
                                    <x-form-input type="hidden" name="image_path" v-model="item.image_path" />
                                </div>
                                <div class="col-span-full sm:col-span-full bg-gray-200 rounded-md px-4 py-2">
                                    <button type="button" @click="selectIcon('main_driver.png')" class="bg-main_driver bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>

                                    <button type="button" @click="selectIcon('seat_sold.png')" class="bg-seat_sold bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>

                                    <button type="button" @click="selectIcon('seat_selected.png')" class="bg-seat_selected bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>

                                    <button type="button" @click="selectIcon('seat_reserve.png')" class="bg-seat_reserve bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>

                                    <button type="button" @click="selectIcon('seat_available.png')" class="bg-seat_available bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('seat_double_sold.png')" class="bg-seat_double_sold bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    
                                    <button type="button" @click="selectIcon('sold_seat.png')" class="bg-sold_seat bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('used_seat.png')" class="bg-used_seat bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('tv.png')" class="bg-tv bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('tv2.png')" class="bg-tv2 bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('toprightcorne1r.png')" class="bg-toprightcorne1r bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('topleftcorner1.png')" class="bg-topleftcorner1 bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('soldagent_seat_green.png')" class="bg-soldagent_seat_green bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('soldagent_seat_green.png')" class="bg-soldagent_seat_green bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('soldagent_seat_yellow.png')" class="bg-soldagent_seat_yellow bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('semi_occupied.png')" class="bg-semi_occupied bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('selected_seat.png')" class="bg-selected_seat bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('reserved_border_seat.png')" class="bg-reserved_border_seat bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('reserved_seat.png')" class="bg-reserved_seat bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('noboarded_seat.png')" class="bg-noboarded_seat bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('inspector.png')" class="bg-inspector bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('fixed_seat.png')" class="bg-fixed_seat bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('expired_seat.png')" class="bg-expired_seat bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('empty_space.png')" class="bg-empty_space bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('ladders.png')" class="bg-ladders bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('handicap.png')" class="bg-handicap bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('codriver.png')" class="bg-codriver bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('busmright1.png')" class="bg-busmright1 bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('busmleft.png')" class="bg-busmleft bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('busmleft1.png')" class="bg-busmleft1 bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('busfront.png')" class="bg-busfront bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('busfront1.png')" class="bg-busfront1 bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('bus5.png')" class="bg-bus5 bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('bus51.png')" class="bg-bus51 bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('bus41.png')" class="bg-bus41 bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('bottomrightcorner1.png')" class="bg-bottomrightcorner1 bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('bottomleftcorner1.png')" class="bg-bottomleftcorner1 bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('boarded_seat_redcoach.png')" class="bg-boarded_seat_redcoach bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('boarded_seat.png')" class="bg-boarded_seat bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('bar.png')" class="bg-bar bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('bathroom.png')" class="bg-bathroom bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('seatterrace.png')" class="bg-seatterrace bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('seat.png')" class="bg-seat bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('badseat.png')" class="bg-badseat bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                    <button type="button" @click="selectIcon('cabin.png')" class="bg-cabin bg-center bg-contain bg-no-repeat border border-transparent duration-150 ease-in-out focus:border-red-300 focus:outline-none focus:shadow-outline-red font-medium inline-flex items-center justify-center px-4 py-2 rounded-md sm:leading-5 transition"></button>
                                </div>


                            </div>
                            <div class="mt-5 text-left">
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