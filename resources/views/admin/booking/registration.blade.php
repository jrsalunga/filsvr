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

				body
				{
					padding: 20px;
				}

				label {
					display: block;
				}

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
		<body>
			
			<table class="table">
				<tr class="bordered">
					<td colspan="5"><center>
					<img src="/asset/images/filigans.png" style="margin:0 auto;text-align:center"></center>
						<h3 class="text-center">REGISTRATION </h3>
					</td>
				</tr>
				<tr class="bordered">
					<td style="width:37.5%">
						<label>Surname</label>
					{{ $booking->customer->lastname }}
					</td>
					<td style="width:37.5%" colspan=2>
						<label style="display:block">First Name</label>
					{{ $booking->customer->firstname }}
					</td>
					<td style="width:12.5%" rowspan=2>
						<label>Date of Check-In</label>
					{{ date("Y-m-d", strtotime($booking->check_in)) }}
					</td>
					<td style="width:12.5%" rowspan=2>
						<label>Date of Check-Out</label>
					{{ date("Y-m-d", strtotime($booking->check_out)) }}
					
					</td>
				</tr>
				<tr class="bordered">
					<td colspan=3>
						<label>Address</label>
					{!! $booking->customer->address !!}
					</td>
					
				</tr>
				<tr class="bordered">
					<td>
						<label>Contact Number</label>
					{{ $booking->customer->contact_no }}
					</td>
					<td>
						<label>Nationality</label>
					{{ $booking->customer->nationality }}
					</td>
					<td>
						<label>Birthday</label>
					{{ $booking->customer->birthday }}
					</td>
					<td rowspan=2>
						<label>Arrival Details</label>
					</td>
					<td rowspan=2>
						<label>Departure Details</label>
					</td>
				</tr>
				<tr class="bordered">
					<td colspan=3>
						<label>Room type and Room Rate</label>
						@foreach($booking->rooms as $key=>$room)
						<div class="row">
			
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
					#{{ $key+1 }} {{ $room->roomTypeDetails->name }}
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
						Number of nights: <?php 
						$check_in = Carbon::parse(date("Y-m-d", strtotime($booking->check_in)));
						$check_out = Carbon::parse(date("Y-m-d", strtotime($booking->check_out)));
						echo $check_out->diffInDays($check_in);
						?>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
						Rate per night : {{ $room->roomTypeDetails->displayPrice }}
					</div>

						</div>
						@endforeach
					</td>

				</tr>
				<tr class="bordered">
				<td>

					<label>Mode of Payment</label>

				</td>
				<td>
					<div class="checkbox">
						<label>
							<input @if(strtolower($booking->payment_mode) == "cash") checked @endif type="checkbox" value="">
							Cash
						</label>
					</div>	
				</td>
				<td>
					<div class="checkbox">
						<label>
							<input @if(strtolower($booking->payment_mode) == "credit card") checked @endif type="checkbox" value="">
							Credit Card
						</label>
					</div>
				</td>
				<td>
					<div class="checkbox">
						<label>
							<input @if(strtolower($booking->payment_mode) == "prepaid") checked @endif type="checkbox" value="">
							PrePaid
						</label>
					</div>
				</td>
				<td>
					<div class="checkbox">
						<label>
							<input @if(strtolower($booking->payment_mode) == "voucher") checked @endif type="checkbox" value="">
							Voucher
						</label>
					</div>
				</td>
				</tr>
				<tr class="bordered">
					<td colspan=3><label>Guest's Signature
					</label><hr style="border:1px solid #d8d8d8">
					<span style="font-style:italic">Regardless of charge instruction, I acknowledge that I am personally liable for the payment of my account.</span>
				</td>
					
					<td colspan=2>
						<h5 class="text-center">Hotel Use</h5>
					<h6>Attending FOA</h6>
					<h6>
						Business Source
					</h6>
					<h6>
						IP
					</h6>
					</td>
				</tr>
			</table>
			<center><span>The hotel is not responsible for money, jewelry or other valuables left by guests in the rooms or in public areas.</span></center>
		</body>
		</html>