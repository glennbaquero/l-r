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
					<h4><b>SALES BY VOUCHER REPORT</b></h4>
					<h5 style="color: red;"><b>Report Information</b></h5>
					<p>
						Type of Voucher: {{ $is_open && $is_open == 'true' ? 'Open' : 'Used' }}
					</p>
				</td>
			</tr>
		</tbody>
	</table>
	<hr>

	@if($is_open && $is_open == 'true')
		<table width="100%" class="sales-table">
			<thead>
				<tr>
					<th>VOUCHER CODE</th>
					<th>VOUCHER TYPE</th>
					<th>PASSENGER</th>
					<th>AUTHORIZED BY</th>
					<th>EXPIRATION DATE</th>
				</tr>
			</thead>
			<tbody>
				@foreach($items as $voucher)
					<tr>
						<td>
							{{ $voucher->code }}
						</td>
						<td>
							{{ $voucher->type_of_voucher }}
						</td>
						<td>
							{{ $voucher->passenger->fullname }}
						</td>
						<td>
							{{ $voucher->authorized_by }}
						</td>
						<td>
							{{ $voucher->expiration_date }}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else 
		<table width="100%" class="sales-table">
			<thead>
				<tr>
					<th>VOUCHER CODE</th>
					<th>TICKET ID</th>
					<th>TRIP</th>
					<th>DEPARTURE</th>
					<th>ARRIVAL</th>
					<th>DATE</th>
					<th>TIME</th>
					<th>BUS</th>
					<th>PASSENGERS</th>
					<th>VOUCHER TYPE</th>
					<th>AUTHORIZED BY</th>
				</tr>
			</thead>
			<tbody>
				@foreach($items as $ticket)
					<tr>
						<td>
							{{ $ticket->voucher_code }}
						</td>
						<td>
							{{ $ticket->id }}
						</td>
						<td>
							{{ $ticket->trip->alias_route }}
						</td>
						<td>
							{{ $ticket->departure->name }}
						</td>
						<td>
							{{ $ticket->arrival->name }}
						</td>
						<td>
							{{ $ticket->trip->formatted_date }}
						</td>
						<td>
							{{ $ticket->trip->formatted_time }}
						</td>
						<td>
							{{ $ticket->trip->bus->name }}
						</td>
						<td>
							{{ $ticket->passenger->fullname }}
						</td>
						<td>
							{{ $ticket->voucher->type_of_voucher }}
						</td>
						<td>
							{{ $ticket->voucher->authorized_by }}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif
</body>
</html>