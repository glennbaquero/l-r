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
					<h4><b>CASHBOX BY USER REPORT</b></h4>
					<h5 style="color: red;"><b>Report Information</b></h5>
					<p>
						Employee: {{ $seller->fullname }}
					</p>
					<p>
						Terminal: {{ $seller->office->name }}
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
	<h1><b>Terminal Tickets</b></h1>
				
	<table width="100%" class="sales-table">
		<thead>
			<tr>
				<th>ID TICKET</th>
				<th>PRICE</th>
				<th>PASSENGER</th>
				<th>ORIGIN</th>
				<th>DESTINATION</th>
				<th>PAYMENT</th>
				<th>TRAVEL DATE</th>
				<th>DATE OF SALE</th>
			</tr>
		</thead>
		<tbody>
			@foreach($tickets as $ticket)
			<tr>
				<td>
					{{ $ticket->id }}
				</td>
				<td>
					{{ $ticket->total_sale }}
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
					{{ $ticket->payment_method }}
				</td>
				<td>
					{{ $ticket->formatted_travel_date }}
				</td>
				<td>
					{{ $ticket->formatted_purchase_date }}
				</td>
			</tr>
			@endforeach

			<tr>
				<td style="border-top: 1px dotted black;">
					<b>TOTAL:</b>
				</td>
				<td style="border-top: 1px dotted black;">
					{{ number_format($tickets->sum('total_sale'), 2, '.', ',') }}
				</td>
			</tr>
		</tbody>
	</table>
	
	<table class="table-data">
		<tr>
			<th></th>
		</tr>
		<tr>
			<td style="text-align: right;" colspan="2">
				<p>
					Cashbox Initial Amount: {{ $has_many_cash_register ? $cash_register->sum('cash') : $cash_register->cash }}
				</p>
				<p>
					Total Tickets Sales by Terminal: {{ number_format($tickets->sum('total_sale'), 2, '.', ',') }}
				</p>
				<p>
					Total tickets Sales by Terminal Postponed: 0.00
				</p>
				<p>
					Total tickets Sales by Agents: 0.00
				</p>
				<p>
					Envelopes: 0.00
				</p>
				<p>
					Total Excess Lugagge: 0.00
				</p>
				<p>
					Total Monoeyorder: 0.00
				</p>
				<p>
					<b>Total Sales: {{ number_format($tickets->sum('total_sale'), 2, '.', ',') }}</b>
				</p>
				<p>
					Less Cancelations: 0.00
				</p>
				<p>
					Less Credit Card Sales: 0.00
				</p>
				<p>
					Less Interline Credits: 0.00
				</p>
				<p>
					Less Coupons: 0.00
				</p>
				<p>
					Less Voucher: 0.00
				</p>
				<p>
					Less Points: 0.00
				</p>
				<p style="border-top: 1px dotted black;">
					<b>Total in cashbox: {{ number_format($has_many_cash_register ? $cash_register->sum('cash') : $cash_register->cash, 2, '.', ',') }}</b>
				</p>
				<hr>
				<p>
					Total sales by driver: 0.00
				</p>
				<p>
					Less driver commission: 0.00
				</p>
				<p style="border-top: 1px dotted black;">
					<b>Net driver sales: 0.00</b>
				</p>
				<hr>
				<p>
					Vouchers In: 0.00
				</p>
				<p class="page-break"></p>
				<p>
					Less Vouchers Out: 0.00
				</p>
				<p style="border-top: 1px dotted black;">
					<b>Total deposit: 0.00</b>
				</p>
				<p>
					<b>Cashbox Balance</b>
				</p>
				<p>
					Final Amount declared: 0.00
				</p>
				<p>
					Less final amount declared: 0.00
				</p>
				<p style="border-top: 1px dotted black;">
					Net Declared Total: 0.00
				</p>
				<p>
					<b>Balance +/(-): 0.00</b>
				</p>
				<hr>
				<p>
					Interlines payable: 0.00
				</p>
				<hr>
				<p>
					<b>Deposit Summary</b>
				</p>
				<p>
					<b>Total deposit Terminal Sales: 0.00</b>
				</p>
				<p>
					<b>Total deposit Agency Sales: 0.00</b>
				</p>
				<p>
					<b>
						Reserved Sales on Agency
					</b>
				</p>
				<p>
					Total Amount of Reserved Tickets 0.00
				</p>
				<p>
					Commission Amount: 0.00
				</p>

			</td>
		</tr>
	</table>
</body>
</html>