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
    <body class="font-sans antialiased">
        <div id="app" class="min-h-screen bg-lightgray">
            <!-- Page Content -->
            <main>

                <div class="bg-white shadow sm:rounded-lg h-screen">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="grid grid-cols-6 gap-3">
                            <div class="col-span-6 sm:col-span-6 mx-auto">
                                <img src="{{ asset('login_bg_image.jpg') }}" class="w-full h-48">
                            </div>
                            <div class="col-span-6 sm:col-span-6 mx-auto text-center">                                
                                <x-label class="font-semibold">This ticket is already confirmed.</x-label>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div> 
    </body>
</html>