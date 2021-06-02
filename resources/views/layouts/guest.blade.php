<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'L&R Transport') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap">

        @if (config('app.env') == 'production' || config('app.env') == 'staging')
            <!-- Styles -->
            <link rel="stylesheet" href="{{ asset(mix('css/app.css'), true) }}">
            <!-- Scripts -->
            <script src="{{ asset(mix('js/app.js'), true) }}" defer></script>
        @else
            <!-- Styles -->
            <link rel="stylesheet" href="{{ asset('css/app.css') }}">
            <!-- Scripts -->
            <script src="{{ asset('js/app.js') }}" defer></script>
        @endif
    </head>
    <body class="text-base">
        <main id="app" class="min-h-screen flex flex-col justify-center text-gray-50 py-12 sm:px-6 lg:px-8 bg-gradient-to-r from-black to-gray-100 bg-overlay" style="--overlay-image: url({{ url('login_bg_image.jpg')  }}); --overlay-colors: rgb(0 0 0 / 0%), rgb(0 0 0);">

            <div class="sm:ml-40 sm:w-full sm:max-w-md">
                <h2 class="mt-6 text-center text-3xl leading-9">
                  {{ $title }}
                </h2>
            </div>
            
            <!-- Main Content -->
            {{ $slot }}
        </main>
    </body>
</html>
