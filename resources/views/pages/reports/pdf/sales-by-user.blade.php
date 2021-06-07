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
					<h4><b>SALES BY USER REPORT</b></h4>
					<h5 style="color: red;"><b>Report Information</b></h5>
					<p>
						Office: {{ $tickets ? $tickets[0]['ticket']->seller->office->name : 'All' }}
					</p>
					<p>
						User: {{ implode(", ", $users) }}
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
		<tbody>
			@foreach($tickets as $ticket)
			<tr>
				<td>
					<h4><b>{{ $ticket['ticket']->seller->group->name }}</b></h4>
					<h4><b>{{ $ticket['ticket']->seller->office->name }}</b></h4>

					<table>
						<tr>
							<th>User</th>
							<th>Amount of Tickets</th>
							<th>Amount of Package</th>
							<th>Amount of Luggage</th>
							<th>Total Amount</th>
							<th>Date(s)</th>
						</tr>
						<tr>
							<td>{{ $ticket['ticket']->seller->fullname }}</td>
							<td>{{ $ticket['ticket']->seller->getTotalSoldTickets($start_date, $date_type, $end_date) }}</td>
							<td>0</td>
							<td>0</td>
							<td>{{ $ticket['ticket']->seller->getTotalSoldTickets($start_date, $date_type, $end_date) }}</td>
							<td>
								{{ $start_date }} 
								@if($date_type == 'true')
									to
									{{ $end_date }}
								@endif
							</td>
						</tr>
					</table>
					<hr>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>