<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Printer Management')}}" route="{{ route('printer.index') }}"></x-breadcrumb>
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

                    <toggle-select v-slot="{ item, selectChanged }">
                        <form action="{{ route('printer.store') }}" method="POST">
                            @csrf
                                <div class="grid grid-cols-6 gap-6" >

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-label for="printer_brand_id" class="font-semibold">Printer Brand</x-label>
                                        <x-select :lists="$brands" name="printer_brand_id" @change="selectChanged({{$brands}}, $event.target.value, 'printer')"/>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-label for="printer_model_id" class="font-semibold">Printer Model</x-label>
                                        <select class="form-input w-full mx-auto my-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent" name="printer_model_id">
                                            <option v-for="model in item.printer_models" :value="model.id">@{{ model.name }}</option>
                                        </select>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-label for="name" class="font-semibold">Name</x-label>
                                        <x-form-input type="text" name="name" id="name" value="{{ old('name') }}" />
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-label for="code" class="font-semibold">Code</x-label>
                                        <x-form-input type="text" name="code" id="code" value="{{ old('code') }}" />
                                    </div>

                                    <div class="col-span-full sm:col-span-full">
                                        <x-label for="notes" class="font-semibold">Notes</x-label>
                                        <x-text-area name="notes"/>
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