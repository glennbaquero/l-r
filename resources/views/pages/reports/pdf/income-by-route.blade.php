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
					<h4><b>ROUTE INCOME REPORT DETAIL</b></h4>
					<h5 style="color: red;"><b>Report Information</b></h5>
					<p>
						Travel: {{ $route }}
					</p>
					<p>
						Bus: {{ $bus }}
					</p>
					<p>
						Service: {{ $service }}
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
				<th>TRAVEL</th>
				<th>DEPARTURE</th>
				<th>ARRIVAL</th>
				<th>SERVICE</th>
				<th>BUS</th>
				<th>DATE TRAVEL</th>
				<th>TIME TRAVEL</th>
				<th>PASSENGERS</th>
				<th>REVENUE</th>
			</tr>
		</thead>
		<tbody>
			@foreach($trips as $trip)
			<tr>
				<td>
					{{ $trip->alias_route }}
				</td>
				<td>
					{{ $trip->route->departure->name }}
				</td>
				<td>
					{{ $trip->route->stops[$trip->route->stops->count()-1]->arrival->name }}
				</td>
				<td>
					{{ $trip->service->name }}
				</td>
				<td>
					{{ $trip->bus->name }}
				</td>
				<td>
					{{ $trip->formatted_date }}
				</td>
				<td>
					{{ $trip->formatted_time }}
				</td>
				<td>
					{{ $trip->tickets()->count() }}
				</td>
				<td>
					{{ number_format($trip->tickets->sum('total_sale'), 2, '.', ',') }}
				</td>
			</tr>
			@endforeach

			<tr style="border-top: 1px dotted black; text-align: left;">
				<td style="border-top: 1px dotted black; text-align: left;"></td>
				<td style="border-top: 1px dotted black; text-align: left;"></td>
				<td style="border-top: 1px dotted black; text-align: left;"></td>
				<td style="border-top: 1px dotted black; text-align: left;"></td>
				<td style="border-top: 1px dotted black; text-align: left;"></td>
				<td style="border-top: 1px dotted black; text-align: left;"></td>
				<td style="border-top: 1px dotted black; text-align: center;">
					<b>Total :</b>
				</td>
				<td style="border-top: 1px dotted black; text-align: center;">
					<b>{{$total_passengers}}</b>
				</td>
				<td style="border-top: 1px dotted black; text-align: center;" >
					<b>{{number_format($total_revenue, 2, '.', ',')  }}</b>
				</td>
			</tr>

			<tr style="border-top: 1px dotted black; text-align: left;">
				<td style="border-top: 1px dotted black; text-align: left;"></td>
				<td style="border-top: 1px dotted black; text-align: left;"></td>
				<td style="border-top: 1px dotted black; text-align: left;"></td>
				<td style="border-top: 1px dotted black; text-align: left;"></td>
				<td style="border-top: 1px dotted black; text-align: left;"></td>
				<td style="border-top: 1px dotted black; text-align: left;"></td>
				<td style="border-top: 1px dotted black; text-align: left;"></td>
				<td style="border-top: 1px dotted black; text-align: left;"></td>
				<td style="border-top: 1px dotted black; text-align: left;" ></td>
			</tr>
		</tbody>
	</table>
</body>
</html>