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
                        <payment-form url="{{ route('payment.process', [ $ticket->ticket_number, $ticket->passenger->fullname, $ticket->arrival->name, $ticket->departure->name ]) }}" v-slot="{ actionHandler, loading, payload, modalMessage, modalTitle, showModal }" :data="{{ $ticket }}">
                            <div class="col-span-1 lg:col-span-6">
                                 <loading :show="loading"></loading>

                                <modal
                                    :body-message="modalMessage"
                                    :header-title="modalTitle"
                                    :show="showModal"
                                    :blade-extended="true"
                                ></modal>
                                
                                <div class="grid grid-cols-6 gap-2">
                                    <div class="col-span-full sm:col-span-full mx-auto">
                                        <img src="{{ asset('login_bg_image.jpg') }}" class="w-full h-48">
                                    </div>
                                </div>

                                <div class="bg-white mx-auto p-10 rounded-md shadow-md w-full">
                                    <h4 class="text-3xl text-gray-700 mb-5">Payment information</h4>
                                    <div class="mb-6">
                                        <label class="block mb-3 text-gray-600">Card holder name</label>
                                        <input type="text" class="border border-gray-500 rounded-md inline-block py-2 px-3 w-full text-gray-600 tracking-wider"/>
                                    </div>
                                    <div class="mb-6">
                                        <label class="block mb-3 text-gray-600">Card number</label>
                                        <input type="tel" class="border border-gray-500 rounded-md inline-block py-2 px-3 w-full text-gray-600 tracking-widest" v-model="payload.cc_number"/>
                                    </div>
                                    <div class="mb-6 flex flex-wrap -mx-3w-full">
                                        <div class="w-2/3 ">
                                            <label class="block mb-3 text-gray-600">Expiration date</label>
                                            <div class="flex">
                                                <select class="border border-gray-500 rounded-md inline-block py-2 px-3 w-full text-gray-600 tracking-widest mr-3" v-model="payload.expiry_month">
                                                    <option selected disabled>Month</option>
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                </select>
                                                <select class="border border-gray-500 rounded-md inline-block py-2 px-3 w-full text-gray-600 tracking-widest" v-model="payload.expiry_year">
                                                    <option selected disabled>Year</option>
                                                    @foreach($years as $year)
                                                        <option value="{{ $year }}">{{ $year }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="w-1/3 pl-3">
                                            <label class="block mb-3 text-gray-600">CVV</label>
                                            <input type="tel" class="border border-gray-500 rounded-md inline-block py-2 px-3 w-full text-gray-600 tracking-widest" v-model="payload.cvv"/>
                                        </div>
                                    </div>
                                    <div class="mb-6 text-right">
                                        <span class="text-right font-bold">{{ $ticket->total_sale }}USD</span>
                                    </div>
                                    <div>
                                        <button @click="actionHandler" class="w-full text-ceenter px-4 py-3 bg-blue-500 rounded-md shadow-md text-white font-semibold">
                                            Confirm payment
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </payment-form>
                    </div>
                </div>
            </main>
        </div> 

        <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    </body>
</html>