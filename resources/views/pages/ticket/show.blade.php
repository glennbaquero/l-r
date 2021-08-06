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
                <form-confirmation v-slot="{ result, actionHandler, loading, show_button }"
                    url="{{ route('ticket.confirmed') }}"
                    :payloads="{{ $payloads }}"

                >

                    <div class="bg-white shadow sm:rounded-lg h-screen">
                        <loading :show="loading"></loading>
                        <div class="px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-3">
                                <div class="col-span-6 sm:col-span-6 mx-auto">
                                    <img src="{{ asset('login_bg_image.jpg') }}" class="w-full h-48">
                                </div>
                                <div class="col-span-6 sm:col-span-6 mx-auto text-center">                                
                                    <x-label class="font-semibold">@{{ result }}</x-label>
                                </div>
                                <div class="col-span-3 sm:col-span-3">
                                    <x-label>Name : </x-label>
                                    <x-label class="font-semibold">{{ $ticket->passenger->fullname }}</x-label>
                                </div>
                                <div class="col-span-3 sm:col-span-3">
                                    <x-label>Travel Date : </x-label>
                                    <x-label class="font-semibold">{{ $ticket->formatted_travel_date }}</x-label>
                                </div>
                                <div class="col-span-3 sm:col-span-3">
                                    <x-label>Departure : </x-label>
                                    <x-label class="font-semibold">{{ $departure }} ({{ $ticket->departure->name }})</x-label>
                                </div>
                                <div class="col-span-3 sm:col-span-3">
                                    <x-label>Arrival : </x-label>
                                    <x-label class="font-semibold">{{ $arrival }} ({{ $ticket->arrival->name }})</x-label>
                                </div>
                                <div class="col-span-3 sm:col-span-3">
                                    <x-label>Bus Seat No. : </x-label>
                                    <x-label class="font-semibold">{{ $ticket->passenger->bus_model_column->label }}</x-label>
                                </div>
                                <div class="col-span-3 sm:col-span-3">
                                    <x-label>Amount to be paid : </x-label>
                                    <x-label class="font-semibold">$ {{ number_format($ticket->total_sale, 2, '.', ',') }}</x-label>
                                </div>
                                <div class="col-span-6 sm:col-span-6 mx-auto mt-5 w-full" v-if="show_button">
                                    <button @click="actionHandler"  class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-full" >
                                        Confirm
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form-confirmation>
            </main>
        </div> 
    </body>
</html>