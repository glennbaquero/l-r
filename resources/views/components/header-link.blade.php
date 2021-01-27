@props(['link' => '#'])

<div class="relative group">
    <a href="{{ $link }}" {{ $attributes->merge(['class' => 'flex flex-row items-center w-full py-4 text-base font-semibold text-sm focus:outline-none']) }}>
        <span>{{ $name }}</span>
    </a>

    <div class="absolute hidden z-10 bg-darkblue group-hover:block">
        <div class="-mx-4 bg-darkblue shadow-lg">
            {{ $slot }}
        </div>
    </div>
</div>