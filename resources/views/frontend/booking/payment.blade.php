@extends("frontend.layout.master")
@section("controller")
bookingController
@endsection	
@section("scripts")

@endsection
@section("content")
<div class="wizard">
	<ul class="nav nav-wizard">
		<li class="disabled">
			<a href="#step1" data-toggle="tab">1. Choose Date</a>
		</li>
		<li class="disabled">
			<a href="#step2" data-toggle="tab">2. Choose Room</a>
		</li>
		<li class="disabled">
			<a href="#step3" data-toggle="tab">3. Make a Reservation</a>
		</li>
		<li class="active" style=''>
			<a href="#step4" data-toggle="tab">4. Payment</a>
		</li>
		<li class="disabled" style=''>
			<a href="#step5" data-toggle="tab">5. Confirmation</a>
		</li>
	</ul>
</div>
<div class="row" style="padding-top: 10px;">
	<div class="col-md-4 col-md-push-8">
		<div style="background-color: #fff; padding: 5px;">
			<div>
				Booking Summary
			</div>
			<div>
				Check In: 
			<span class="pull-right">
				{{ Carbon\Carbon::parse($booking->checkin)->format('D M d, Y h:i A') }}
			</span>
			</div>
			<div>
				Check Out: 
			<span class="pull-right">
				{{ Carbon\Carbon::parse($booking->checkout)->format('D M d, Y h:i A') }}
			</span>
			</div>
			<div class="clearfix">
				Room Details: <br>
				@foreach($booking->rooms as $room)
					<div>
					{{ $room->roomTypeDetails->name }} 
					<span class="pull-right">
						{{ number_format($room->room_price,2) }}
					</span>
					</div>
				@endforeach
			</div>
			<div>
				Total Amount:
				<span class="pull-right">
					PHP {{ number_format($booking->total_price,2) }}
				</span>
			</div>
		</div>
	</div>
	<div class="col-md-8 col-md-pull-4">
		<form action="/booking/{{$booking->id}}/payment" method="POST">
			<div style="background-color: #fff; padding: 5px;">
				<table class="payment-table table table-bordered table-hover">
					<thead>
						<tr><th colspan="2">Choose your payment option</th></tr>
					</thead>
					<tbody>
						<tr>
							<td style="border-right: 1px solid #fff;" class="text-right">
								<input type="radio" name="payment" id="input" value="cc" checked="checked">
							</td>
							<td>
								<h4>
									<label>Credit Card Payment</label>
								</h4>
								<img src="/image/card.jpg" class="img-responsive">
								<!--
								If your choose this option we will redirect you to our bank's secured payment gateway.
								-->
							</td>
						</tr>
					</tbody>
				</table>
				<div class="clearfix">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="id" value="{{$booking->id}}">
					<button class="btn btn-primary pull-right clearfix">
						<span class="glyphicon glyphicon-ok"></span>
						Place your booking
					</button>
				</div>

				

			<small>
				
				By placing your booking, you agree to Filigans Hotel's term and conditions of use.
				
			</small>

			<div>
				<img src="/image/secured.png" class="img-responsive">
			</div>
			</div>
		</form>
	</div>
	
</div>
@endsection