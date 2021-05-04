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
					<h4><b>SALES BY DEPARTURE-ARRIVAL REPORT</b></h4>
					<h5 style="color: red;"><b>Report Information</b></h5>
					<p>
						Departure: {{ $departure }}
					</p>
					<p>
						Arrival: {{ $arrival }}
					</p>
					<p>
						Ticket Type: {{ $type }}
					</p>
					<p>
						Gender: {{ $gender }}
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
		<thead style="border: 0px solid #ddd;">
			<tr>
				<th colspan="2" style="border-bottom: 0px;"></th>
				<th colspan="3" style="border-bottom: 1px solid black;">PASSENGER</th>
			</tr>
			<tr>
				<th>DEPARTURE</th>
				<th>ARRIVAL</th>
				<th>MALE</th>
				<th>FEMALE</th>
				<th>TOTAL</th>
				<th>TOTAL SALES</th>
			</tr>
		</thead>
		<tbody>
			@foreach($new_ticket_list as $ticket)
			<tr>
				<td>
					{{ $ticket['departure'] }}
				</td>
				<td>
					{{ $ticket['arrival'] }}
				</td>
				<td>
					{{ $ticket['male'] }}
				</td>
				<td>
					{{ $ticket['female'] }}
				</td>
				<td>
					{{ $ticket['total'] }}
				</td>
				<td>
					{{ $ticket['total_sales'] }}
				</td>
			</tr>
			@endforeach
			<tr >
				<td colspan="5" style="border-top: 1px dotted black;border-bottom: 1px dotted black; text-align: right;">TOTAL: </td>
				<td style="border-top: 1px dotted black;border-bottom: 1px dotted black;">
					{{ $overall_total }}
				</td>
			</tr>
		</tbody>
	</table>
</body>
</html>