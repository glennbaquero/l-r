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

                        <div class="bg-white mx-auto p-10 rounded-md shadow-md w-full">
                            <div class="col-span-6 sm:col-span-6 mx-auto text-center">    
                                @if($status == 'paid')                        
                                    <h4 class="text-3xl text-gray-700 mb-5">Your ticket is already paid. Thank you!</h4>
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
                                            <label class="block mb-3 text-gray-600">Departure: {{ $ticket->departure->name }}</label>
                                        </div>
                                        <div class="w-1/2 px-3">
                                            <label class="block mb-3 text-gray-600">Arrival: {{ $ticket->arrival->name }}</label>
                                        </div>
                                        <div class="w-full px-3">
                                            <label class="block mb-3 text-gray-600">Route: {{ $route_name }}</label>
                                        </div>
                                        <div class="w-full px-3">
                                            <label class="block mb-3 text-gray-600">Trip stops</label>
                                        </div>
                                        @foreach($stops as $stop)
                                        <div class="w-full px-3">
                                            <label class="block mb-3 text-gray-600">{{ $stop['departure'] }} - {{ $stop['arrival'] }}</label>
                                        </div>
                                        @endforeach
                                        <div class="w-screen px-3">
                                            <div id="qrCodeHolder"></div>
                                        </div>
                                        <div class="w-screen px-3">
                                            @if($ticket->transaction_number)
                                            <label class="block mb-3 text-gray-600">Transaction/Reference Number<b>{{ $ticket->transaction_number }}</b></label>
                                            @endif
                                            <label class="block mb-3 text-gray-600">Ticket Number: <b>{{ $ticket->ticket_number }}</b></label>
                                            <label class="block mb-3 text-gray-600">Please show this to your driver.</label>
                                        </div>
                                    </div>
                                @else
                                    <h4 class="text-3xl text-gray-700 mb-5">This ticket is {{ $status }}.</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div> 

        <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcode-generator/1.0.3/qrcode.min.js" integrity="sha512-CwmiQdOoXBchUa3+Eb5brNU8lxeJr7CVjWDwBCr+2wvbTEGzI982TnvGVQtvPKfvSevelLCV2xa7S/pdLKZKag==" crossorigin="anonymous"></script>

        <script type="text/javascript">
            var typeNumber = 10;
            var errorCorrectionLevel = 'L';
            var qr = qrcode(typeNumber, errorCorrectionLevel);
            var route = '{{ $route }}';
            qr.addData(route);
            qr.make();
            var qrHolder = document.getElementById('qrCodeHolder');
            qrHolder.innerHTML = qr.createImgTag();
            var imgTag = qrHolder.childNodes[0];
            imgTag.className = 'mx-auto';
            
        </script>


    </body>
</html>