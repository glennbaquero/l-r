<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title></title>
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('fonts/K2D/style.css') }}"> --}}
	<style type="text/css">
		.*{
		  	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		  	border-collapse: collapse;
		  	width: 100%;
		}

		.data {
		  border-collapse: collapse;
		  width: 100%;
		}

		.data td, .data th {
		  border: 1px solid #000;
		  padding: 8px;
		  text-align: center;
		}

		/*.data tr:nth-child(odd){ background-color: #c5c5c5;}*/

		.data th {
		  padding-top: 12px;
		  padding-bottom: 12px;
		  text-align: left;
		  background-color: #c5c5c5;
		}

		
		.no-bgcolor {
			background-color: black;
		}

		/*.table-data tr:nth-child(even){background-color: #f2f2f2;}*/

		.app_title {
		  	padding-top: 35px;
		  	padding-bottom: 35px;
		  	text-align: left;
		  	background-color: #001943;
		  	color: white;
		  	text-align: center;
		  	font-size: 27px;
		}

		.page-break {
		    page-break-after: always;
		}


	</style>
</head>
<body >

	<table width="100%" class="table-data">
		<thead>
			<tr>
				<th colspan="2" class="app_title">FRONTERAS DEL NORTE BUS COMPANY</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<h4><b>{{ $type }}</b></h4>
					<h5 style="color: red;"><b>Report Information</b></h5>
					<p>
						<b>Route:</b> {{ $route->name }}
					</p>
					<p>
						<b>Main Driver:</b> {{ $main_driver }}
					</p>
					<p>
						<b>Secondary Driver:</b> {{ $secondary_driver }}
					</p>
					<p>
						<b>Departure Date:</b> {{ $trip->formatted_date }}
						<b>Departure Time:</b> {{ $trip->formatted_time }}
						<b>Bus:</b> {{ $trip->bus->name }}
					</p>
				</td>
			</tr>
		</tbody>
	</table>
	<hr>

	@switch($type)
		@case('Operators Manifest')
				

				<table width="100%" class="data">
					<thead>
						<tr>
							<th>TICKET ID</th>
							<th>SEAT</th>
							<th>PASSENGER/INFANT</th>
							<th>DEPARTURE</th>
							<th>ARRIVAL</th>
							<th>STATUS</th>
							<th>TYPE</th>
							<th>OBSERVATIONS</th>
						</tr>
					</thead>
					<tbody>
						@foreach($list as $ticket)
							<tr >
								<td>{{ $ticket->id }}</td>
								<td>{{ $ticket->seat->label }}</td>
								<td>{{ $ticket->passenger->fullname }}/{{ $ticket->passenger->infant_fullname }}</td>
								<td>{{ $ticket->departure->name }}</td>
								<td>{{ $ticket->arrival->name }}</td>
								<td>{{ $ticket->payment_status }} / {{ $ticket->boarding_status }}</td>
								<td>{{ $ticket->passenger->ticketType->name }}</td>
								<td></td>
							</tr>
						@endforeach
					</tbody>
				</table>
			@break
			
			@case('Simplified Driver Manifest')
				@foreach($list as $key => $grouped)
					<p>
						<b>Departure:</b> {{ $key }}
						<b>Number of Passenger:</b> {{ count($grouped) }}
						<b>Departure Date:</b> {{ $grouped[0]->formatted_travel_date }}
					</p>
					<table width="100%" class="data">
						<thead>
							<tr>
								<th>TICKET ID</th>
								<th>SEAT</th>
								<th>PASSENGER/INFANT</th>
								<th>PHONE NUMBER</th>
								<th>ARRIVAL</th>
								<th>STATUS</th>
								<th>TYPE</th>
							</tr>
						</thead>
						<tbody>
							@foreach($grouped as $ticket)
								<tr>
									<td>{{ $ticket->id }}</td>
									<td>{{ $ticket->seat->label }}</td>
									<td>{{ $ticket->passenger->fullname }}/{{ $ticket->passenger->infant_fullname }}</td>
									<td>{{ $ticket->passenger->phone_number }}</td>
									<td>{{ $ticket->arrival->name }}</td>
									<td>{{ $ticket->payment_status }} / {{ $ticket->boarding_status }}</td>
									<td>{{ $ticket->passenger->ticketType->name }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@endforeach

			@break

			@case('Passenger Manifest with Price')
				@foreach($list as $key => $grouped)
					<p>
						<b>Departure:</b> {{ $key }}
						<b>Number of Passenger:</b> {{ count($grouped) }}
						<b>Departure Date:</b> {{ $grouped[0]->formatted_travel_date }}
					</p>
					<table width="100%" class="data">
						<thead>
							<tr>
								<th>TICKET ID</th>
								<th>SEAT</th>
								<th>PASSENGER/INFANT</th>
								<th>PHONE NUMBER</th>
								<th>ARRIVAL</th>
								<th>STATUS</th>
								<th>TYPE</th>
								<th>PRICE</th>
							</tr>
						</thead>
						<tbody>
							@foreach($grouped as $ticket)
								<tr>
									<td>{{ $ticket->id }}</td>
									<td>{{ $ticket->seat->label }}</td>
									<td>{{ $ticket->passenger->fullname }}/{{ $ticket->passenger->infant_fullname }}</td>
									<td>{{ $ticket->passenger->phone_number }}</td>
									<td>{{ $ticket->arrival->name }}</td>
									<td>{{ $ticket->payment_status }} / {{ $ticket->boarding_status }}</td>
									<td>{{ $ticket->passenger->ticketType->name }}</td>
									<td>{{ number_format($ticket->total_sale, 2, '.', ',') }}</td>
								</tr>
							@endforeach
							<tr>
								<td colspan="7" style="text-align: right; font-weight: bold">Total Amount</td>
								<td style="text-align: center">{{ number_format($grouped->sum('total_sale'), 2, '.', ',') }}</td>
							</tr>
						</tbody>
					</table>
				@endforeach
			@break;


			@default
				@foreach($list as $key => $grouped)
					<p>
						<b>Departure:</b> {{ $key }}
						<b>Number of Passenger:</b> {{ count($grouped) }}
						<b>Departure Date:</b> {{ $grouped[0]->formatted_travel_date }}
					</p>
					<table width="100%" class="data">
						<thead>
							<tr>
								<th>TICKET ID</th>
								<th>SEAT</th>
								<th>PASSENGER/INFANT</th>
								<th>PHONE NUMBER</th>
								<th>ARRIVAL</th>
								<th>STATUS</th>
								<th>TYPE</th>
								<th>OBSERVATION</th>
							</tr>
						</thead>
						<tbody>
							@foreach($grouped as $ticket)
								<tr>
									<td>{{ $ticket->id }}</td>
									<td>{{ $ticket->seat->label }}</td>
									<td>{{ $ticket->passenger->fullname }}/{{ $ticket->passenger->infant_fullname }}</td>
									<td>{{ $ticket->passenger->phone_number }}</td>
									<td>{{ $ticket->arrival->name }}</td>
									<td>{{ $ticket->payment_status }} / {{ $ticket->boarding_status }}</td>
									<td>{{ $ticket->passenger->ticketType->name }}</td>
									<td></td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@endforeach
			@break

	@endswitch
</body>
</html>