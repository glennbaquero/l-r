@props(['currentModule', 'currentPage' => 'Create', 'route' => null])

<div class="flex items-center">
    <div class="text-base mr-auto">

        <a href="{{ $route }}" class="bg-grey-light text-grey-darkest font-semibold mr-3 py-2 px-4 rounded inline-flex items-center">
            {{-- <svg class="flex-shrink-0 -ml-1 mr-1 h-5 w-5 text-grey-darkest" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
            </svg>  --}}
            {{ $currentModule }}
            <svg class="flex-shrink-0 mx-2 h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
            </svg>
            {{ $currentPage }}

            {{ $slot }}
        </a>
    </div>
</div>