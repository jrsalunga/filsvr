<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Title Page</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
			<![endif]-->
			<style type="text/css">
				table tr.bordered td,table tr.bordered th
				{
					border:2px solid #d8d8d8;
					padding:7px;
				}
				table td
				{
					padding:5px;
				}
			</style>
		</head>
		<body >
			<table CLASS="table" style="border:2px solid #d8d8d8">
				<tr>
					<td colspan=4 style="font-weight:bold">
						{{ $customer['firstname'] }} {{ $customer['lastname'] }}
					</td>
					<td style="font-weight:bold" class="text-right">
						VAT No
					</td>
					<td class="text-left"> {{ $id }}</td>
				</tr>
				<tr>
					<td colspan=4>
						{!! $customer['address'] !!}
					</td>
					<td class="text-right" style="font-weight:bold">
						Invoice No
					</td>
					<td>
						{{ $id }}
					</td>
				</tr>
				<tr>
					<td colspan=4 ></td>
					<td class="text-right" style="font-weight:bold"> Booking Ref#</td>
					<td>{{ $booking_no }}</td>
				</tr>
				<tr>
					<td colspan=4></td>
					<td class="text-right" style="font-weight:bold">
						Arrival
					</td>
					<td>
						{{ date("Y-m-d", strtotime($check_in))}}
					</td>
				</tr>
				<tr>
					<td colspan=4>
						Date: {{ $updated_at }}
					</td>
					<td class="text-right" style="font-weight:bold">
						Departure
					</td>
					<td>
						{{ date("Y-m-d", strtotime($check_out))}}
					</td>
				</tr>
				<tr>
					<td colspan=4></td>
					<td class="text-right" style="font-weight:bold">Cashier</td>
					<td>
						{{ ucfirst(\Auth::user()->firstname )}} {{ ucfirst(\Auth::user()->lastname )}}
					</td>
				</tr>
				<tr class="bordered">
					<TH COLSPAN=6 class=" text-center">BOOKING TRANSACTIONS</TH>
				</tr>
				<tr class="bordered">
					<th>
						Date
					</th>
					<th style="width:25%">
						Description
					</th>
					<th>Ref #</th>
					<th>
						Time
					</th>
					<th style="width:16%">Debits</th>
					<th style="width:16%">Credits</th>
				</tr>

				@foreach($rooms as $room)
				<tr class="bordered">
					<td>
						{{ date("Y-m-d", strtotime($room['created_at'])) }}
					</td>
					<td>
						<p>
							<span style="color:green">{{ $room['room_details']['details']['name'] }}</span>
						</p>
						<p>
							Adults(<span style="font-weight:bold">{{ $room['num_adults'] }}</span>)
							Children(<span style="font-weight:bold">{{ $room['num_children'] }}</span>)

						</p>
						<p>
							Room Price <span style="color:blue">P {{ number_format($room['room_price'],2) }}</span>
						</p>
						<p>
							Food Price <span style="color:blue">P {{ number_format($room['food_price'],2) }}</span>
						</p>
					</td>
					<td>
						{{ strtoupper($booking_no) }}
					</td>
					<td>
						{{ date("H:i:s ", strtotime($rooms['created_at']))}}
					</td>
					<td>
						P {{ number_format($room['room_price'] + $room['food_price'], 2)}}
					</td>
					<td>P 0.00</td>
				</tr>
				@endforeach
				
				
				<tr>
					<td colspan=3></td>
					<td style="text-align:right;font-weight:bold">Sub Total</td>
					<td>P {{ number_format($subtotal_room_price,2) }}</td>
					<td></td>
				</tr>
				<tr>
					<td colspan=3></td>
					<td style="font-weight:bold;text-align:right">Tax({{$tax}}%)</td>
					<td>P {{ number_format($room_tax_price,2) }}</td>
					
					<tr>
						<td colspan=3 ></td>
						<td style="font-weight:bold;text-align:right">Total</td>
						<TD>
							P {{  number_format($total_room_price,2) }}
						</TD>
					</tr>
				</tr>
				<tr class="bordered">
					<TH COLSPAN=6 class=" text-center">ADDITIONAL TRANSACTIONS (tax already included)</TH>
				</tr>
				<tr class="bordered">
					<th>
						Date
					</th>
					<th style="width:25%">
						Description
					</th>
					<th>Ref #</th>
					<th>
						Time
					</th>
					<th style="width:16%">Debits</th>
					<th style="width:16%">Credits</th>
				</tr>
				@foreach($additional_transaction as $at)

				<tr class="bordered">
					<td>{{ date("Y-m-d", strtotime($at['created_at'])) }}</td>
					<td>
						{{ $at['description'] }}
					</td>
					<td>
						{{ $at['reference_no'] }}
					</td>
					<td>{{ date("H:i:s", strtotime($at['created_at'])) }}</td>
					<td>
						<?php 
						$credit = 0;
						$debit =0;
						$debit = ((int) $at['amount'] > 0) ? $at['amount'] : 0;
						$credit = ((int) $at['amount'] < 0) ? abs($at['amount']) : 0;
						?>
						P {{ number_format($debit,2) }}
					</td>
					<td>
						P {{ number_format($credit,2) }}
					</td>
				</tr>
				@endforeach
				<tr>
					<td colspan=3></td>
					<td style="text-align:right;font-weight:bold;font-size:12px">Additional Transaction</td>
					<td>P {{ number_format($additional_transaction_price['debits'],2) }}</td>
					<td>P {{ number_format($additional_transaction_price['credits'],2) }}</td>
				
				</tr>
				<tr>
					<td colspan=3></td>
					<td style="text-align:right;font-weight:bold;font-size:12px">Booking Transaction</td>
					<td>P {{ number_format($total_room_price,2) }}</td>
					<td>P {{ number_format(0,2) }}</td>
					
				</tr>
				<tr class="bordered">
					<td colspan=3></td>
					<td style="text-align:right;font-weight:bold;font-size:12px">Rendered Change</td>
					<td>P {{ number_format(0,2) }}</td>
					<td>P {{ number_format($total_credits,2) }}</td>
				</tr>

			</table>
			<p style="font-style:italic">Regardless of charge instruction, I acknowledge that I am personally liable for payment of the above statement.</p>
			<br>
			<hr>
			<p style="text-align:center">GUEST SIGNATURE</p>
			<P style="text-align:center">Thank you for preferring Filigans Hotel</P>
			<P style="text-align:center">It was a pleasure being at your service. We look forward to welcoming you back.</P>
		</body>
		</html>