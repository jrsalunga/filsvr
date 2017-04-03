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
		<li class="disabled" style=''>
			<a href="#step4" data-toggle="tab">4. Payment</a>
		</li>
		<li class="active" style=''>
			<a href="#step5" data-toggle="tab">5. Confirmation</a>
		</li>
	</ul>
</div>
<div class="row" style="padding-top: 10px;">
	<div class="col-md-4 col-md-push-8">
		<div style="padding: 5px;" class="bg-success">
			<div>
				Booking Summary
			</div>
			<div>
				<small>Booking No.:</small> 
			<span class="pull-right">
				<strong>{{ $booking->booking_no }}</strong>
			</span>
			</div>
			<div>
				<small>Check In:</small> 
			<span class="pull-right">
				{{ Carbon\Carbon::parse($booking->checkin)->format('D M d, Y h:i A') }}
			</span>
			</div>
			<div>
				<small>Check Out:</small> 
			<span class="pull-right">
				{{ Carbon\Carbon::parse($booking->checkout)->format('D M d, Y h:i A') }}
			</span>
			</div>
			<div class="clearfix">
				<small>Room Details: </small><br>
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
				<small>Total Amount Due:</small> 
				<span class="pull-right">
					<strong>PHP {{ number_format($booking->total_price,2) }}</strong>
				</span>
			</div>
			@if($booking->total_discount>0)
			<div>
				<small>Discount:</small> 
				<span class="pull-right">
					-{{ number_format($booking->total_discount,2) }}
				</span>
			</div>
			@endif
			<div>
				<small>Amount Charged:</small> 
				<span class="pull-right">
					<strong>PHP {{ number_format($booking->amount_paid,2) }}</strong>
				</span>
			</div>
			@if($booking->additional_remarks)
			<div>
				<small>Remarks:
				<span class="pull-right">
					{{ $booking->additional_remarks }}
				</span>
				</small> 
			</div>
			@endif
		</div>
		<span>
			<a href="https://bdo.com.ph" style="text-decoration: none;" target="_blank">
				<img class="img-responsive" src="/image/title_logo_ecn.jpg" style="display: inline-block;">
			</a>
		</span>
		<span id="siteseal">
			<script async type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=F3lMRvKHBss9ETwg1Yhab0EH8QQRF7IPPuj5THMmsoBPeSYiLE95tYByngMe"></script>
		</span>
		
			
	</div>
	<div class="col-md-8 col-md-pull-4">
			<div style="background-color: #fff; padding: 5px;">


				<div class="text-center">
					<h1 class="text-success"><span class="glyphicon glyphicon-ok-circle" style="font-size:2.5em;"></span></h1>
					<h2>Your booking is confirmed!</h2>
					<p>The confirmation details has been sent to your email address.</p>
				</div>
				
				<div class="clearfix">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="id" value="{{$booking->id}}">
					<a href="/booking" class="btn btn-primary pull-right clearfix">
						<span class="glyphicon glyphicon-calendar"></span>
						Place another booking
					</a>
				</div>

				

			

			<div>
				<img src="/image/secured.png" class="img-responsive">
				</div>
			</div>
		</form>
	</div>
	
</div>
@endsection