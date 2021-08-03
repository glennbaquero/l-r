<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Recommendation Management')}}" route="{{ route('recommendation.index') }}"></x-breadcrumb>
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
                    <toggle v-slot="{ display, toggled, toggleFalse }">
                        <form action="{{ route('recommendation.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-full sm:col-span-full">
                                    <x-label for="name" class="font-semibold">Name</x-label>
                                    <x-form-input type="text" name="name" id="name" value="{{ old('name') }}" />
                                </div>
                               
                                <div class="col-span-full sm:col-span-full" >
                                    <x-label for="source" class="font-semibold">Youtube Source</x-label>
                                    <x-form-input type="text" name="source" id="source" value="{{ old('source') }}" />
                                </div>

                                <div class="col-span-full sm:col-span-full">
                                    <x-label for="description" class="font-semibold">Description</x-label>
                                    <x-text-area name="description" id="description"/>
                                </div>
                            </div>
                            <div class="mt-5 text-left">
                                <button type="submit" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-36">
                                    Save
                                </button>
                            </div>
                        </form>
                    </toggle>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>