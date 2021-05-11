<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title></title>
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('fonts/K2D/style.css') }}"> --}}
	<style type="text/css">
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
					<h4><b>SALES REPORT BY AGENCY</b></h4>
					<h5 style="color: red;"><b>Report Information</b></h5>
					{{-- <p>
						Office: {{ $terminals }}
					</p> --}}
					<p>
						Agency: {{ $agencies }}
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
	<hr>

	<table width="100%" class="sales-table">
		<thead>
			<tr>
				<th>TICKET ID</th>
				<th>OFFICE</th>
				<th>AGENT</th>
				<th>COMMISSION TYPE</th>
				<th>PASSENGER</th>
				<th>ORIGIN</th>
				<th>DESTINATION</th>
				<th>TRANSACTION DATE</th>
				<th>STATUS</th>
				<th>PAYMENT METHOD</th>
				<th>AMOUNT</th>
				<th>COMMISSION</th>
				<th>AMOUNT RECEIVABLE</th>
				<th>OBSERVATION</th>
				{{-- <th>SEATS OCCUPIED</th> --}}
			</tr>
		</thead>
		<tbody>
			@foreach($tickets as $ticket)
				<tr>
					<td>
						{{ $ticket->id }}
					</td>
					<td>
						{{ $ticket->seller->office->name }}
					</td>
					<td>
						{{ $ticket->seller->office->name }}
					</td>
					<td>
						0.00
					</td>
					<td>
						{{ $ticket->passenger->fullname }}
					</td>
					<td>
						{{ $ticket->departure->name }}
					</td>
					<td>
						{{ $ticket->arrival->name }}
					</td>
					<td>
						{{ $ticket->formatted_purchase_date }}
					</td>
					<td>
						{{ $ticket->payment_status }} / {{ $ticket->boarding_status }}
					</td>
					<td>
						{{ $ticket->payment_method }}
					</td>
					<td>
						{{ number_format($ticket->total_sale, 2, '.', ',') }}
					</td>
					<td>
						0.00
					</td>
					<td>
						{{ number_format($ticket->total_sale, 2, '.', ',') }}
					</td>
					<td>
						
					</td>
				</tr>
			@endforeach

			<tr>
				<td colspan="10" style="text-align: right; border-top: 1px dotted black">TOTAL:</td>
				<td style="text-align: center; border-top: 1px dotted black">{{ number_format($tickets->sum('total_sale'), 2, '.', ',') }}</td>
				<td style="text-align: center; border-top: 1px dotted black">{{ number_format($tickets->sum('total_sale'), 2, '.', ',') }}</td>
				<td style="text-align: center; border-top: 1px dotted black">{{ number_format($tickets->sum('total_sale'), 2, '.', ',') }}</td>
				<td style="text-align: center; border-top: 1px dotted black"></td>
			</tr>
		</tbody>
	</table>
</body>
</html>