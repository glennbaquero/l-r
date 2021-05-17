<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title></title>
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('fonts/K2D/style.css') }}"> --}}
	<style type="text/css">
		* {

		  	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		}

		.table-data, .sales-table{
		  	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		  	border-collapse: collapse;
		  	width: 100%;
		}

		.table-data td, .table-data th, .sales-table td, .sales-table th {
		  	border: 0px solid #ddd;
		  	padding: 8px;
		}

		.sales-table th {
			border-bottom: 1px dotted black;
		}

		.table-data td {
			width: 50%;
		}
		

		.sales-table td {
			width: 50%;
			font-size: 11px;
			text-align: center;
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
					<h4><b>SALES REPORT BY TICKETS</b></h4>
					<h5 style="color: red;"><b>Report Information</b></h5>
					<p>
						Office(s): {{ $office }}
					</p>
					<p>
						User(s): {{ $user }}
					</p>
					<p>
						Ticket Type: {{ $ticket_type }}
					</p>
					<p>
						Ticket Status: {{ $ticket_status }}
					</p>
					<p>
						Payment Type: {{ $payment_type }}
					</p>
					<p>
						Search Date: {{ $start_date }}
						@if($date_type == 'true')
							to
							{{ $end_date }}
						@endif
					</p>
				</td>
			</tr>
		</tbody>
	</table>

	@foreach($users as $user)
		<hr>
		<p>
			<b>Office:</b> {{ $user->office->name }}
		</p>
		<p>
			<b>User:</b> {{ $user->fullname }}
		</p>

		<table width="100%" class="sales-table">
		<thead>
			<tr>
				<th>TRANSACTION DATE</th>
				<th>TICKET ID</th>
				<th>PASSENGERS</th>
				<th>DEPARTURE DATE</th>
				<th>DEPARTURE</th>
				<th>ARRIVAL</th>
				<th>SEAT</th>
				<th>TICKET TYPE</th>
				<th>PAYMENT METHOD</th>
				<th>STATUS</th>
				<th>PRICE</th>
			</tr>
		</thead>
		<tbody>
			@foreach($user->tickets as $ticket)
				<tr>
					<td>
						{{ $ticket->formatted_purchase_date }}
					</td>
					<td>
						{{ $ticket->id }}
					</td>
					<td>
						{{ $ticket->passenger->fullname }}
					</td>
					<td>
						{{ $ticket->formatted_travel_date }}
					</td>
					<td>
						{{ $ticket->departure ? $ticket->departure->name : '---' }}
					</td>
					<td>
						{{ $ticket->arrival ? $ticket->arrival->name : '---' }}
					</td>
					<td>
						{{ $ticket->seat->label }}
					</td>
					<td>
						{{ $ticket->passenger->ticketType ? $ticket->passenger->ticketType->name : '---' }}
					</td>
					<td>
						{{ $ticket->payment_method }}
					</td>
					<td>
						{{ $ticket->payment_status }} - {{ $ticket->boarding_status }}
					</td>
					<td>
						{{ number_format($ticket->total_sale, 2, '.', ',') }}
					</td>
				</tr>
			@endforeach

			<tr>
				<td colspan="10" style="text-align: right">TOTAL SOLD:</td>
				<td style="text-align: center">{{ number_format($user->tickets()->sum('total_sale'), 2, '.', ',') }}</td>
			</tr>
		</tbody>
	</table>

	@endforeach
</body>
</html>