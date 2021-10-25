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
                        
                        <div class="grid grid-cols-6 gap-2">
                            <div class="col-span-full sm:col-span-full mx-auto">
                                <img src="{{ asset('login_bg_image.jpg') }}" class="w-full h-48">
                            </div>
                        </div>

                        <form-confirmation v-slot="{ result, actionHandler, loading, show_button }"
                            url="{{ route('ticket.confirmed') }}"
                            :payloads="{{ $payloads }}"

                        >
                            <div class="bg-white mx-auto p-10 rounded-md shadow-md w-full">
                                <div class="col-span-6 sm:col-span-6 mx-auto text-center">    
                                    <h4 class="text-3xl text-gray-700 mb-5">Your ticket info</h4>
                                    <h3 class="text-2xl text-gray-700 mb-5">Price : $ {{ number_format($ticket->total_sale, 2, '.', ',') }}</h3>
                                    <div class="mb-6 flex flex-wrap -mx-3w-full">
                                        <div class="w-1/2 px-3">
                                            <label class="block mb-3 text-gray-600">Ticket ID: {{ $ticket->id }}</label>
                                        </div>
                                        <div class="w-1/2 px-3">
                                            <label class="block mb-3 text-gray-600">Passenger: {{ $ticket->passenger->fullname }}</label>
                                        </div>
                                        <div class="w-1/2 px-3">
                                            <label class="block mb-3 text-gray-600">Travel Date: {{ $travel_date }}</label>
                                        </div>
                                        <div class="w-1/2 px-3">
                                            <label class="block mb-3 text-gray-600">Seat #: {{ $ticket->seat->label }}</label>
                                        </div>
                                        <div class="w-1/2 px-3">
                                            <label class="block mb-3 text-gray-600">Departure: {{ $departure }} ({{ $ticket->departure->name }})</label>
                                        </div>
                                        <div class="w-1/2 px-3">
                                            <label class="block mb-3 text-gray-600">Arrival: {{ $arrival }} ({{ $ticket->arrival->name }})</label>
                                        </div>
                                        <div class="w-screen px-3">
                                            <div id="qrCodeHolder"></div>
                                        </div>
                                        @if($ticket->payment_method === 'Credit Card' || $ticket->payment_method === 'Reservation')
                                        <div class="w-screen px-3">
                                            <label class="block mb-3 text-gray-600">Please pay to process your ticket.</label>
                                        </div>
                                        @endif
                                        @if($ticket->payment_method === 'Credit Card' || $ticket->payment_method === 'Reservation')
                                        <div class="w-screen px-3">
                                            <a href="{{ $ticket->paymentFormUrl() }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-white bg-darkblue focus:outline-none focus:border-red-300 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5 w-full" >
                                                Go to payment form
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form-confirmation>
                    </div>
                </div>

                {{-- <form-confirmation v-slot="{ result, actionHandler, loading, show_button }"
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
                </form-confirmation> --}}
            </main>
        </div> 

        <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcode-generator/1.0.3/qrcode.min.js" integrity="sha512-CwmiQdOoXBchUa3+Eb5brNU8lxeJr7CVjWDwBCr+2wvbTEGzI982TnvGVQtvPKfvSevelLCV2xa7S/pdLKZKag==" crossorigin="anonymous"></script>

        <script type="text/javascript">
            var typeNumber = 10;
            var errorCorrectionLevel = 'L';
            var qr = qrcode(typeNumber, errorCorrectionLevel);
            var route = '{{ $ticket->updateStatusUrl() }}';
            qr.addData(route);
            qr.make();
            var qrHolder = document.getElementById('qrCodeHolder');
            qrHolder.innerHTML = qr.createImgTag();
            var imgTag = qrHolder.childNodes[0];
            imgTag.className = 'mx-auto';
            
        </script>

    </body>
</html>