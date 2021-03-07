@props(['message' => null, 'type' => 'success'])


<toggle-alert>
    <div slot-scope="{ display, toggled, toggleFalse }" class="grid grid-cols-3 gap-4" v-if="display">
        <div class="col-start-2 rounded-md {{ $type === 'success' ? 'bg-green-50' : 'bg-red-50'}} p-4">
            <div class="flex">
                <div class="flex-shrink-0">
                    @if($type === 'success')
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    @else
                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                    @endif
                </div>
                <div class="ml-3">
                    <p class="text-sm leading-5 font-medium {{ $type === 'success' ? 'text-green-800' : 'text-red-800'}} ">
                        {{ $message }}
                    </p>
                    {!! $slot !!}
                </div>
                <div class="ml-auto pl-3">
                    <div class="-mx-1.5 -my-1.5">
                        <button class="inline-flex rounded-md p-1.5 {{ $type === 'success' ? 'text-green-500 hover:bg-green-100 focus:outline-none focus:bg-green-100' : 'text-red-500 hover:bg-red-100 focus:outline-none focus:bg-red-100'}} transition ease-in-out duration-150" @click="toggled">
                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</toggle-alert>