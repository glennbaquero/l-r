<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title></title>
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('fonts/K2D/style.css') }}"> --}}
	<style type="text/css">
		.table-data, .price-per-route-table{
		  	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
		  	border-collapse: collapse;
		  	width: 100%;
		}

		.price-per-route-table {
		  border-collapse: collapse;
		  width: 100%;
		}

		.price-per-route-table td, .price-per-route-table th {
		  border: 1px solid #000;
		  padding: 8px;
		  font-weight: bold;
		}

		/*.price-per-route-table tr:nth-child(odd){ background-color: #c5c5c5;}*/

		.price-per-route-table th {
		  padding-top: 12px;
		  padding-bottom: 12px;
		  text-align: left;
		  background-color: white;
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
					<h4><b>Billing Tickets Report</b></h4>
					<h5 style="color: red;"><b>Report Information</b></h5>
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

	<table width="100%" class="price-per-route-table">
		<thead>
			<tr>
				<th>TICKET CHANNEL SALES</th>
				<th>TICKETS (unique)</th>
				<th>TICKETS (by section)</th>
				<th>TOTAL</th>
			</tr>
		</thead>
		<tbody>
			<tr style="background-color: #c5c5c5;">
				<td>TICKETS BY TERMINAL</td>
				<td>{{ $tickets_by_terminal_unique }}</td>
				<td>{{ $tickets_by_terminal_by_section }}</td>
				<td>{{ number_format($tickets_by_terminal_total, 2, '.', ',') }}</td>
			</tr>
			<tr>
				<td>- Sold</td>
				<td>{{ $total_sold_ticket_sold_unique }}</td>
				<td>{{ $total_sold_ticket_sold_bysection }}</td>
				<td>{{ number_format($total_sold_unique_and_bysection, 2, '.', ',') }}</td>
			</tr>
			<tr>
				<td style="font-size: 14px">- Agency Paid and Confirmed</td>
				<td>{{ $total_agency_paid_confirmed_tickets_unique }}</td>
				<td>{{ $total_agency_paid_confirmed_tickets_bysection }}</td>
				<td>{{ number_format($total_agency_paid_confirmed_tickets_total, 2, '.', ',') }}</td>
			</tr>
			<tr>
				<td style="font-size: 15px">- Agent Paid and Confirmed</td>
				<td>{{ $total_agent_paid_confirmed_tickets_unique }}</td>
				<td>{{ $total_agent_paid_confirmed_tickets_bysection }}</td>
				<td>{{ number_format($total_agent_paid_confirmed_tickets_total, 2, '.', ',') }}</td>
			</tr>
			<tr style="background-color: #c5c5c5;">
				<td>TOTAL TICKETS TO BILL</td>
				<td>{{ $tickets_by_terminal_unique }}</td>
				<td>{{ $tickets_by_terminal_by_section }}</td>
				<td>{{ number_format($tickets_by_terminal_total, 2, '.', ',') }}</td>
			</tr>
		</tbody>
	</table>
</body>
</html>