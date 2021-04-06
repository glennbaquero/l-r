@props(['route' => '#'])

<a href="{{$route}}" class="'inline-flex items-center my-auto px-1 pt-1 text-darkblue hover:text-lighterblue font-semi-bold leading-5 transition duration-150 ease-in-out'">
    {{ $slot }}
</a>