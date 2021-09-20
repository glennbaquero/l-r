@props(['hasFooter' => true, 'maxWidth' => 'max-w-7xl', 'hasHeader' => true, 'enableDisplay' => false])

<toggle v-slot="{ display, toggled, toggleFalse }" enable-display={{ $enableDisplay }}>
    <div class="h-full">
        {{ $button ?? '' }}
        <div v-if="display" class="overflow-x-hidden overflow-y-auto fixed inset-0 z-50 outline-none focus:outline-none justify-center items-center flex">
            <div class="max-h-screen {{ $maxWidth }} mx-auto my-6 relative w-full">
                <!--content-->

                <div class="border-0 rounded-lg shadow-lg relative flex flex-col w-full bg-white outline-none focus:outline-none">
                    <!--header-->
                    @if($hasHeader)
                        <div class="flex items-start justify-between p-5 border-b border-solid border-gray-300 rounded-t">
                            <h3 class="text-3xl font-semibold">
                                {{ $title ?? '' }}
                            </h3>
                            <a href="#" @click="toggled()">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </a>
                        </div>
                    @endif

                    <!--body-->
                    <div class="relative p-6 flex-auto">
                        {{ $body ?? '' }}
                    </div>

                    <!--footer-->
                    @if($hasFooter) 
                        <div class="flex items-center justify-end p-6 border-t border-solid border-gray-300 rounded-b">
                            {{ $footer ?? '' }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div v-if="display" class="opacity-25 fixed inset-0 z-40 bg-black"></div>
    </div>
</toggle>