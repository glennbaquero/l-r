<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Terminal Management')}}" currentPage="Show" route="{{ route('terminal.index') }}"> 
                    <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    {{ $terminal->printer->name }}
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
                    
                    <toggle-select v-slot="{ item, selectChanged }" :items="{{$printerBrands}}" type="printer" :selected-value="{{ $terminal->printer_brand_id }}">
                        <form action="{{ route('terminal.update', $terminal->id) }}" method="POST">
                            @csrf
                                <div class="grid grid-cols-6 gap-6" >

                                    <div class="col-span-2 sm:col-span-2">
                                        <x-label for="office_id" class="font-semibold">Office</x-label>
                                        <x-select :lists="$offices" name="office_id" :selected="$terminal->office_id" />
                                    </div>
                                    <div class="col-span-2 sm:col-span-2">
                                        <x-label for="operating_system" class="font-semibold">Operating System</x-label>
                                        <x-select :lists="$operatingSystems" name="operating_system" identifierValue="name" :selected="$terminal->operating_system"/>
                                    </div>
                                    <div class="col-span-2 sm:col-span-2">
                                        <x-label for="web_browser" class="font-semibold">Web Browser</x-label>
                                        <x-select :lists="$webBrowsers" name="web_browser" identifierValue="name" :selected="$terminal->web_browser"/>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-label for="printer_brand_id" class="font-semibold">Printer Brand</x-label>
                                        <x-select :lists="$printerBrands" name="printer_brand_id" @change="selectChanged({{$printerBrands}}, $event.target.value, 'printer')" :selected="$terminal->printer_brand_id"/>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-label for="printer_id" class="font-semibold">Printer</x-label>
                                        <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="printer_id">
                                            <option v-for="printer in item.printers" :value="printer.id" :selected="printer.id === {{ $terminal->printer_id }}">@{{ printer.name }}</option>
                                        </select>
                                    </div>
                                </div>
                            <div class="mt-5 text-left">
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36">
                                    Save
                                </button>
                            </div>
                        </form>
                    </toggle-select>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>