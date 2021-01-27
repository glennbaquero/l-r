@props(['link' => '#', 'caret' => false])

<div {{ $attributes->merge(['class' => 'relative flex w-72 px-8 py-2 text-base font-normal']) }}>
    <a href="{{ $link }}" class="mr-auto">{{ $name }}</a>
    @if($caret)
        <svg class="ml-auto inline-flex w-4 h-4" fill="none" stroke="currentColor" viewBox="-10 -8 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M9 6L-1.33513e-07 0.803848L-9.58579e-09 11.1962L9 6Z" fill="#F9F9F9"/>
        </svg>
    @endif

    {{ $slot }}
</div>