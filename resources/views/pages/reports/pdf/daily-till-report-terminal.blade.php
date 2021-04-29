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
					<h4><b>CASHBOX BY TERMINAL REPORT</b></h4>
					<h5 style="color: red;"><b>Report Information</b></h5>
					<p>
						Office: {{ $office->name }}
					</p>
					<p>
						Date: {{ $start_date }}
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
	<h1><b>Report Detailed of Tickets by Office</b></h1>
				
	<table width="100%" class="sales-table">
		<thead>
			<tr>
				<th>ID TICKET</th>
				<th>PASSENGER</th>
				<th>ORIGIN</th>
				<th>DESTINATION</th>
				<th>SALES DATE</th>
				<th>PAYMENT</th>
				<th>PRICE</th>
			</tr>
		</thead>
		<tbody>
			@foreach($tickets as $ticket)
			<tr>
				<td>
					{{ $ticket->id }}
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
					{{ $ticket->payment_method }}
				</td>
				<td>
					{{ number_format($ticket->total_sale, 2, '.', ',') }}
				</td>
			</tr>
			@endforeach

			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="border-top: 1px dotted black; text-align: left;">
					<b>Total Tickets Sales:</b>
				</td>
				<td style="border-top: 1px dotted black; text-align: right;">
					{{ number_format($tickets->sum('total_sale'), 2, '.', ',') }}
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="border-top: 1px dotted black; text-align: left;">
					<b>Total Tickets Sales Postponed: </b>
				</td>
				<td style="border-top: 1px dotted black; text-align: right;">
					0.00
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="border-top: 1px dotted black; text-align: left;">
					<b>Less Cancelations: </b>
				</td>
				<td style="border-top: 1px dotted black; text-align: right;">
					0.00
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="border-top: 1px dotted black; text-align: left;">
					<b>Less Credit Interline: </b>
				</td>
				<td style="border-top: 1px dotted black; text-align: right;">
					0.00
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="border-top: 1px dotted black; text-align: left;">
					<b>Less Credit Card Sales: </b>
				</td>
				<td style="border-top: 1px dotted black; text-align: right;">
					0.00
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="border-top: 1px dotted black; text-align: left;">
					<b>Total Canceled Credit Card Sale: </b>
				</td>
				<td style="border-top: 1px dotted black; text-align: right;">
					0.00
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="border-top: 1px dotted black; text-align: left;">
					<b>Less Discount Coupons: </b>
				</td>
				<td style="border-top: 1px dotted black; text-align: right;">
					0.00
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="border-top: 1px dotted black; text-align: left;">
					<b>Less Payment with Points: </b>
				</td>
				<td style="border-top: 1px dotted black; text-align: right;">
					0.00
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="border-top: 1px dotted black; text-align: left;">
					<b>Less Vouchers: </b>
				</td>
				<td style="border-top: 1px dotted black; text-align: right;">
					0.00
				</td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td style="border-top: 1px dotted black; text-align: left;">
					<b>Total: </b>
				</td>
				<td style="border-top: 1px dotted black; text-align: right;">
					0.00
				</td>
			</tr>
		</tbody>
	</table>

	@foreach($users as $user)
		<h1><b>{{ $user->fullname }}</b></h1>
					
		<table width="100%" class="sales-table">
			<thead>
				<tr>
					<th>ID TICKET</th>
					<th>PASSENGER</th>
					<th>ORIGIN</th>
					<th>DESTINATION</th>
					<th>SALES DATE</th>
					<th>PAYMENT</th>
					<th>PRICE</th>
				</tr>
			</thead>
			<tbody>
				@foreach($user->tickets as $ticket)
				<tr>
					<td>
						{{ $ticket->id }}
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
						{{ $ticket->payment_method }}
					</td>
					<td>
						{{ number_format($ticket->total_sale, 2, '.', ',') }}
					</td>
				</tr>
				@endforeach

				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td style="border-top: 1px dotted black; text-align: left;">
						<b>Total Tickets Sales:</b>
					</td>
					<td style="border-top: 1px dotted black; text-align: right;">
						{{ number_format($user->tickets->sum('total_sale'), 2, '.', ',') }}
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td style="border-top: 1px dotted black; text-align: left;">
						<b>Total Tickets Sales Postponed: </b>
					</td>
					<td style="border-top: 1px dotted black; text-align: right;">
						0.00
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td style="border-top: 1px dotted black; text-align: left;">
						<b>Less Cancelations: </b>
					</td>
					<td style="border-top: 1px dotted black; text-align: right;">
						0.00
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td style="border-top: 1px dotted black; text-align: left;">
						<b>Less Credit Interline: </b>
					</td>
					<td style="border-top: 1px dotted black; text-align: right;">
						0.00
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td style="border-top: 1px dotted black; text-align: left;">
						<b>Less Credit Card Sales: </b>
					</td>
					<td style="border-top: 1px dotted black; text-align: right;">
						0.00
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td style="border-top: 1px dotted black; text-align: left;">
						<b>Total Canceled Credit Card Sale: </b>
					</td>
					<td style="border-top: 1px dotted black; text-align: right;">
						0.00
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td style="border-top: 1px dotted black; text-align: left;">
						<b>Less Discount Coupons: </b>
					</td>
					<td style="border-top: 1px dotted black; text-align: right;">
						0.00
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td style="border-top: 1px dotted black; text-align: left;">
						<b>Less Payment with Points: </b>
					</td>
					<td style="border-top: 1px dotted black; text-align: right;">
						0.00
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td style="border-top: 1px dotted black; text-align: left;">
						<b>Less Vouchers: </b>
					</td>
					<td style="border-top: 1px dotted black; text-align: right;">
						0.00
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td style="border-top: 1px dotted black; text-align: left;">
						<b>Total: </b>
					</td>
					<td style="border-top: 1px dotted black; text-align: right;">
						0.00
					</td>
				</tr>
			</tbody>
		</table>
	@endforeach
</body>
</html>