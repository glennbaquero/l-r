<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Bus Model Management')}}" currentPage="Show" route="{{ route('bus-model.index') }}"> 
                    <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    {{ $model->name }}
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
                    
                    <bus-generator v-slot="{ bus, cellChange, default_cell, rows, columns, showCellType, updateType, updateTypeCell, selectColumn, selectedColumn, changeCellType, changeCellOrientation, toJson }" :cells="{{ $cells }}" :item="{{ $model }}">
                        <form action="{{ route('bus-model.update', $model->id) }}" method="POST">
                            @csrf

                            <div class="gap-2 grid grid-cols-3">
                                <div class="col-span-1">
                                    <div class=" grid grid-cols-2 gap-2">
                                         <div class="col-span-full sm:col-span-full">
                                             <x-label for="name" class="font-semibold">Name</x-label>
                                             <x-form-input type="text" name="name" id="name" value="{{ $model->name }}" />
                                         </div>
                                         <div class="col-span-1/2 sm:col-span-1/2">
                                             <x-label for="rows" class="font-semibold">Rows</x-label>
                                             <x-form-input type="number" name="rows" id="rows" min="0" v-model="bus.rows" onkeydown="return false"/>
                                         </div>
                                         <div class="col-span-1/2 sm:col-span-1/2">
                                             <x-label for="columns" class="font-semibold">Columns</x-label>
                                             <x-form-input type="number" name="columns" id="columns" min="0" v-model="bus.columns" onkeydown="return false" />
                                             <x-form-input type="hidden" name="cells" v-model="toJson"/>
                                         </div>
                                         <div class="col-span-1/2 sm:col-span-1/2">
                                             <x-label for="seats" class="font-semibold">Seat</x-label>
                                             <x-form-input type="number" name="seats" id="seats" value="{{ $model->seats }}" />
                                         </div>
                                         <div class="col-span-1/2 sm:col-span-1/2">
                                             <x-label for="floors" class="font-semibold">Floor</x-label>
                                             <x-form-input type="number" name="floors" id="floors" value="{{ $model->floors }}" />
                                         </div>
                                         <div class="col-span-full sm:col-span-full">
                                             <x-label for="floors" class="font-semibold">Default Cell</x-label>
                                             <x-select name="default_cell_id" :lists="$cells" :selected="$model->default_cell_id" @change="cellChange($event.target.value)"/>
                                         </div>
                                        {{--  <div class="col-span-full sm:col-span-full bg-gray-200 rounded-md px-4 py-2">
                                         </div> --}}
                                    </div>
                                </div>
                                <div class="border col-span-2 mt-5 px-4 py-4 rounded-md">
                                    <div class="border px-4 py-4 rounded-md w-min">
                                        <table>
                                            <tr v-for="row in bus.columnsCellType" class="h-10">
                                                <td v-for="column in row" class=" bg-center bg-contain bg-no-repeat h-5 p-5 w-5 text-center" :style="{ backgroundImage: 'url(' + column.image_path + ')', transform: 'rotate('+column.orientation+'deg)' }" @dblclick="showCellType(column)" >

                                                   {{--  <select class="bg-gray-200 border-transparent focus:border-blue-300 font-black form-input leading-none px-0 py-0 rounded shadow-sm text-black text-center transition w-5" @change="cellChange($event.target.value, column)" v-model="column.cell_id" v-if="column.showSelection">
                                                        <option></option>
                                                        @foreach($cells as $cell)
                                                            <option value="{{ $cell->id }}">{{ $cell->name }}</option>
                                                        @endforeach
                                                    </select> --}}

                                                    <input type="checkbox" class="bg-transparent border focus:border-blue-300 font-black form-input leading-none px-0 py-0 rounded shadow-sm text-black text-center transition w-5" v-if="updateTypeCell == 'cell_type' || updateTypeCell == 'orientation'" v-model="column.selected">

                                                    <input type="text" class="bg-transparent border-transparent focus:border-blue-300 font-black form-input leading-none px-0 py-0 rounded shadow-sm text-black text-center transition w-5 text-xs" v-model="column.label" v-if="updateTypeCell == 'number_seats'">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>

                                    <div class="gap-2 grid grid-cols-3">
                                        
                                        <div class="col-span-1 sm:col-span-1">
                                            <input type="radio" name="updateType" @click="updateType($event.target.value)" value="number_seats"> Change Number of Seats 
                                        </div>
                                        <div class="col-span-1 sm:col-span-1 text-center">
                                            <input type="radio" name="updateType" @click="updateType($event.target.value)" value="cell_type"> Change Cell Type 
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <input type="radio" name="updateType" @click="updateType($event.target.value)" value="orientation"> Change Cell Orientation
                                        </div>


                                        <div class="col-span-1 sm:col-span-1">
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
                                            <select class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-if="updateTypeCell == 'cell_type'" @change="changeCellType($event.target.value)">
                                                <option></option>
                                                @foreach($cells as $cell)
                                                    <option value="{{ $cell->id }}">{{ $cell->name }}</option>
                                                @endforeach
                                            </select>

                                            <select class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" v-if="updateTypeCell == 'orientation'" @change="changeCellOrientation($event.target.value)">
                                                <option value="90">90</option>
                                                <option value="180">180</option>
                                                <option value="270">270</option>
                                                <option value="360">360</option>
                                            </select>
                                        </div>
                                        <div class="col-span-1 sm:col-span-1">
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
                    </bus-generator>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>