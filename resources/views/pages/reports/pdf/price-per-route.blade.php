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

		.price-per-route-table {
		  border-collapse: collapse;
		  width: 100%;
		}

		.price-per-route-table td, .price-per-route-table th {
		  border: 1px solid #000;
		  padding: 8px;
		}

		.price-per-route-table tr:nth-child(even){ background-color: #f2f2f2;}

		.price-per-route-table th {
		  padding-top: 12px;
		  padding-bottom: 12px;
		  text-align: left;
		}

		.table-data td, .table-data th {
		  	border: 0px solid #000;
		  	padding: 8px;
		}
/*
		.table-data td {
			width: 50%;
		}
		*/
		
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
					<h4><b>ROUTE PRICE REPORT</b></h4>
					<h5 style="color: red;"><b>Report Information</b></h5>
					<p>
						Ticket Type: {{ $ticket_type }}
					</p>
					<p>
						City: {{ $city}}
					</p>
				</td>
			</tr>
		</tbody>
	</table>
	{{-- <hr> --}}
				
	<table width="100%" class="price-per-route-table">
		<thead>
			<tr>
				<th></th>
				@foreach($headers as $header)
				<th>{{ $header }}</th>
				<th>{{ $header }} Round</th>
				@endforeach
			</tr>
		</thead>
		<tbody>
			@foreach($prices as $price)
			<tr>
				<td>
					{{ $price->arrival->name }}
				</td>
				@foreach($types as $type)
					<td>
						{{ $type->arrival_price }}
					</td>
					<td>
						{{ $type->roundtrip_price }}
					</td>
				@endforeach
			</tr>
			@endforeach
		</tbody>
	</table>
</body>
</html>