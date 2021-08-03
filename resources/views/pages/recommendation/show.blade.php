<x-app-layout>
    <div class="mx-auto sm:px-6 lg:px-8 py-6">
        <div class="flex items-center">
            <div class="text-base mr-auto">

                <x-breadcrumb currentModule="{{__('Recommendation Management')}}" currentPage="Show" route="{{ route('recommendation.index') }}"> 
                    <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                    {{ $recommendation->name }}
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
                    <toggle v-slot="{ display, toggled, toggleFalse }">
                    
                        <form action="{{ route('recommendation.update', $recommendation->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                    
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-full sm:col-span-full">
                                    <x-label for="name" class="font-semibold">Name</x-label>
                                    <x-form-input type="text" name="name" id="name" value="{{ $recommendation->name }}" />
                                </div>

                                {{-- <div class="col-span-2 sm:col-span-2">
                                    <x-switch label="Source From Youtube" name="from_youtube" :hasParentToggle="1" :toshowdata="1" :item="$recommendation"/>
                                </div> --}}
{{-- 
                                <div class="col-span-full sm:col-span-full" v-if="!display">
                                    <x-label for="path" class="font-semibold">Upload Video</x-label>
                                    <input type="file" name="path" accept="video/mp4" id="file" class="form-input w-full mx-auto my-3 py-2 px-3 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out leading-none border-transparent">
                                </div> --}}

                                <div class="col-span-full sm:col-span-full">
                                    <x-label for="source" class="font-semibold">Youtube Source</x-label>
                                    <x-form-input type="text" name="source" id="source" value="{{ $recommendation->source }}" />
                                </div>

                                <div class="col-span-full sm:col-span-full">
                                    <x-label for="description" class="font-semibold">Description</x-label>
                                    <x-text-area name="description" id="description" value="{{ $recommendation->description }}" />
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