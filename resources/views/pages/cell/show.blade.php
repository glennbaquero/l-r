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
                                    <div class="grid grid-cols-6 gap-2">
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('driver.png')" src="{{ url('icons/driver.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('seat_sold.png')" src="{{ url('icons/seat_sold.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('seat_selected.png')" src="{{ url('icons/seat_selected.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('seat_reserve.png')" src="{{ url('icons/seat_reserve.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('seat_available.png')" src="{{ url('icons/seat_available.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('seat_double_sold.png')" src="{{ url('icons/seat_double_sold.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('sold_seat.png')" src="{{ url('icons/sold_seat.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('used_seat.png')" src="{{ url('icons/used_seat.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('tv.png')" src="{{ url('icons/tv.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('tv2.png')" src="{{ url('icons/tv2.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('soldagent_seat_green.png')" src="{{ url('icons/soldagent_seat_green.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('soldagent_seat_green.png')" src="{{ url('icons/soldagent_seat_green.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('soldagent_seat_yellow.png')" src="{{ url('icons/soldagent_seat_yellow.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('semi_occupied.png')" src="{{ url('icons/semi_occupied.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('selected_seat.png')" src="{{ url('icons/selected_seat.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('reserved_border_seat.png')" src="{{ url('icons/reserved_border_seat.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('reserved_seat.png')" src="{{ url('icons/reserved_seat.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('noboarded_seat.png')" src="{{ url('icons/noboarded_seat.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('inspector.png')" src="{{ url('icons/inspector.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('fixed_seat.png')" src="{{ url('icons/fixed_seat.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('expired_seat.png')" src="{{ url('icons/expired_seat.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('empty_space.png')" src="{{ url('icons/empty_space.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('ladders.png')" src="{{ url('icons/ladders.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('handicap.png')" src="{{ url('icons/handicap.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('codriver.png')" src="{{ url('icons/codriver.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('boarded_seat_redcoach.png')" src="{{ url('icons/boarded_seat_redcoach.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('boarded_seat.png')" src="{{ url('icons/boarded_seat.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('bar.png')" src="{{ url('icons/bar.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('bathroom.png')" src="{{ url('icons/bathroom.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('seatterrace.png')" src="{{ url('icons/seatterrace.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('seat.png')" src="{{ url('icons/seat.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('badseat.png')" src="{{ url('icons/badseat.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <img @click="selectIcon('cabin.png')" src="{{ url('icons/cabin.png') }}" class="mx-auto cursor-pointer " />
                                        </div>
                                    </div>
                                    
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