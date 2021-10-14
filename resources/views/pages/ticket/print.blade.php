<!DOCTYPE html>
<html>
    <head>
    	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">

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
        @endif
        <style type="text/css" media="print">
	        @page{
	           margin: 0;
	        }
        </style>

        <style type="text/css">
        	*{
                padding: 0;
                margin: 0;
            }

        	.break {
        		page-break-after : always;
        	}

        	.passenger-receipt {
        		right: 20%;
        		top: 200px;
        		page-break-after : always;
        	}

        	.boarding-pass {
        		top: 1300px; 
        		right: 25%;
        	}

        	@media print {
        	  .printButton {
        	    display: none;
        	  }
        	}
        </style>
    </head>

    <body class="font-sans antialiased" onload="print()">
    	<button onclick="print()" class=" printButton border duration-150 ease-in-out focus:bg-gray-100 focus:outline-none focus:text-gray-500 hover:bg-gray-100 hover:text-gray-500 items-center justify-center p-2 printButton rounded-md text-gray-400 transition w-1/12 ">
    		<svg class="w-full h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
    	</button>
        <div class="bg-lightgray relative">
        	<div class="absolute rotate-90 transform w-full passenger-receipt">
				<div class="text-center">
				    <h2 class="font-bold text-3xl text-lightblue">Fronteras del Norte</h2>
				</div>

			   <div class="mx-auto sm:px-6 lg:px-8 py-6">
			       <div class="border border-black">
			           <div class="bg-white">
			               <div class="p-2">
			                   <div class="border-b border-gray-200 gap-0 grid grid-cols-5">
			                       <div class="col-span-2 sm:col-span-2">
			                          <x-label>From</x-label>
			                          <x-label class="font-semibold">{{ $ticket->departure->address_line_1 }} ({{ $ticket->departure->name }})</x-label>
			                       </div>

			                       <div class="col-span-1 sm:col-span-1 text-right">
			                          <x-label>Trip</x-label>
			                          <x-label class="font-semibold"></x-label>
			                       </div>
			                       <div class="col-span-2 sm:col-span-2 text-right">
			                          <x-label>Departure</x-label>
			                          <x-label class="font-semibold">{{ $ticket->trip->formatted_date }}</x-label>
			                       </div>

			                       <div class="col-span-2 sm:col-span-2">
			                          <x-label>To</x-label>
			                          <x-label class="font-semibold">{{ $ticket->arrival->address_line_1 }} ({{ $ticket->arrival->name }})</x-label>
			                       </div>

			                       <div class="col-span-1 sm:col-span-1 text-right">
			                          <x-label>Seat</x-label>
			                          <x-label class="font-semibold">{{ $ticket->passenger->bus_model_column->label }}</x-label>
			                       </div>
			                       <div class="col-span-2 sm:col-span-2 text-right">
			                          <x-label>Departure Time</x-label>
			                          <x-label class="font-semibold">{{ $ticket->trip->formatted_time }}</x-label>
			                          <x-label>Arrival Time</x-label>
			                          <x-label class="font-semibold">{{ $ticket->trip_time->formatted_arrival_time }}</x-label>
			                       </div>
			                   </div>

			                   <div class="border-b border-gray-200 gap-0 grid grid-cols-2">
			                       <div class="border-dashed border-r col-span-1 sm:col-span-1">
			                          <x-label>Name</x-label>
			                          <x-label class="font-semibold">{{ $ticket->passenger->fullname }}</x-label>
			                       </div>

			                       <div class="col-span-1 sm:col-span-1 text-right">
			                          <x-label>Payment Method</x-label>
			                          <x-label class="font-semibold">{{ $ticket->payment_method }}</x-label>
			                       </div>
			                       <div class="border-dashed border-r col-span-1 sm:col-span-1">
			                          <x-label>Pass Type</x-label>
			                          <x-label class="font-semibold">{{ $ticket->passenger->ticketType->name }}</x-label>
			                          <x-label>Int'l FRONTERAS DEL NORTE</x-label>
			                          <x-label>Ticket ID: <b class="font-semibold">{{ $ticket->id }}</b></x-label>
			                          <x-label>-</x-label>
			                          <x-label class="font-semibold">Passenger Receipt</x-label>
			                       </div>

			                       <div class="col-span-1 sm:col-span-1 text-right">
			                          <x-label>Seller</x-label>
			                          <x-label class="font-semibold">{{ $ticket->seller->fullname }}</x-label>
			                          <x-label>Purchase Date</x-label>
			                          <x-label class="font-semibold">{{ $ticket->formatted_purchase_date }}</x-label>
			                          <x-label>Amount Paid</x-label>
			                          <x-label class="font-semibold">$ {{ number_format($ticket->total_sale, 2, '.', ',') }}</x-label>
			                          <x-label>Total</x-label>
			                          <x-label class="font-semibold">$ {{ number_format($ticket->total_sale, 2, '.', ',') }}</x-label>
			                       </div>
			                   </div>
			                   <div class="gap-0 grid grid-cols-2">

			                   		<div class="col-span-full sm:col-span-full">
			                   			<p class="text-xs">1) Ticket is valid for the date and time selected at the time of purchase. Ticket is invalid if expired</p>
			                   			<p class="text-xs">2) Please check in 30 minutes prior to departure or you may lose your reservation.</p>
			                   			<p class="text-xs">3) Open Return expires 90 days from of 1st Travel.</p>
			                   			<p class="text-xs">4) Tickets: Non-Refundable & Non-Exchangeable. Cancellation incur 100% penalty.</p>
			                   			<p class="text-xs">5) For questions call Customer Service at (323) 587-5233</p>
			                   			<p class="text-xs">Scheduled Arrival/Departure time are just subject to change.</p>
			                   		</div>
			                   </div>
			               </div>
			           </div>
			       </div>
			   </div>
        	</div>

        	{{-- for each tickets avail add 1050px to top --}}
        	<div class="absolute rotate-90 transform w-full break boarding-pass" style="top: 1300px">
				<div class="text-center">
				    <h2 class="font-bold text-3xl text-lightblue">Fronteras del Norte</h2>
				</div>

			   <div class="mx-auto sm:px-6 lg:px-8 py-6">
			       	<div class="border border-black">
			           	<div class="bg-white">
			               	<div class="p-2">
			                   	<div class="border-b border-gray-200 gap-0 grid grid-cols-5">
			                       	<div class="col-span-2 sm:col-span-2">
			                          	<x-label>From</x-label>
			                          	<x-label class="font-semibold">{{ $ticket->departure->name }}</x-label>
			                       	</div>

			                       	<div class="col-span-1 sm:col-span-1 text-right">
			                          	<x-label>Trip</x-label>
			                          	<x-label class="font-semibold">{{ $ticket->trip->alias_route }}</x-label>
			                       	</div>
			                       	<div class="col-span-2 sm:col-span-2 text-right">
			                          	<x-label>Departure</x-label>
			                          	<x-label class="font-semibold">{{ $ticket->trip->formatted_date }}</x-label>
			                       	</div>

			                       	<div class="col-span-2 sm:col-span-2">
			                          	<x-label>To</x-label>
			                          	<x-label class="font-semibold">{{ $ticket->arrival->name }}</x-label>
			                       	</div>

			                       	<div class="col-span-1 sm:col-span-1 text-right">
			                          	<x-label>Seat</x-label>
			                          	<x-label class="font-semibold">{{ $ticket->seat->label }}</x-label>
			                       	</div>
			                       	<div class="col-span-2 sm:col-span-2 text-right">
			                          	<x-label>Departure Time</x-label>
			                          	<x-label class="font-semibold">{{ $ticket->trip->formatted_time }}</x-label>
				                        <x-label>Arrival Time</x-label>
				                        <x-label class="font-semibold">{{ $ticket->trip_time->formatted_arrival_time }}</x-label>
			                       	</div>
			                   	</div>

			                   	<div class="border-b border-gray-200 gap-0 grid grid-cols-2">
			                       	<div class="border-dashed border-r col-span-1 sm:col-span-1">
			                          	<x-label>Name</x-label>
			                          	<x-label class="font-semibold">{{ $ticket->passenger->fullname }}</x-label>
			                       	</div>

			                       	<div class="col-span-1 sm:col-span-1  pl-3">
			                          	<x-label>Payment Method</x-label>
			                          	<x-label class="font-semibold">{{ $ticket->payment_method }}</x-label>
			                       	</div>
			                       <div class="border-dashed border-r col-span-1 sm:col-span-1">
			                          	<x-label>Pass Type</x-label>
			                          	<x-label class="font-semibold">{{ $ticket->passenger->ticketType->name }}</x-label>
			                          	<x-label>Int'l FRONTERAS DEL NORTE</x-label>
			                          	<x-label>Ticket ID: <b class="font-semibold">{{ $ticket->id }}</b></x-label>
			                          	<x-label>-</x-label>
			                          	<x-label class="font-semibold">Our Departure are subject to change without previous notice.</x-label>
			                          	<x-label class="font-semibold">Boarding Pass</x-label>
			                       	</div>

			                       <div class="col-span-1 sm:col-span-1">
			                       		<div class="gap-0 grid grid-cols-2">
			                       			<div class="col-span-1 sm:col-span-1 pl-3">
			                       				<x-label>Seller</x-label>
			                       				<x-label class="font-semibold">{{ $ticket->seller->fullname }}</x-label>
			                       				<x-label>Purchase Date</x-label>
			                       				<x-label class="font-semibold">{{ $ticket->formatted_purchase_date }}</x-label>
			                       				<x-label>Final Destination</x-label>
			                       				<x-label class="font-semibold">{{ $ticket->arrival->name }}</x-label>
			                       			</div>
			                       			<div class="col-span-1 sm:col-span-1">
					                          	{{-- <svg id="code39" class="mx-auto my-auto"></svg> --}}
					                          	<div id="qrCodeHolder"></div>
			                       			</div>
				                        </div>
			                       	</div>
			                   	</div>
			               	</div>
			           	</div>
			       	</div>
			   	</div>
        	</div>
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
        <script type="text/javascript">

        	print() {
        		window.print();
        	}
        	
        </script>
    </body>
</html>
