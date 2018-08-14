@extends("frontend.layout.master")
@section('title', 'Payment Options')
@section("controller")
bookingController
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
					PHP {{ number_format($booking->total_price,2) }}
				</span>
			</div>
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
		<form action="/booking/{{$booking->id}}/payment" method="POST" id="cardForm">
			<div style="background-color: #fff; padding: 5px;">

				@if (count($errors) > 0)
				    <div class="alert alert-danger alert-errors" role="alert">
				      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				      <span aria-hidden="true">&times;</span>
				    </button>
				      <ul>
				      @foreach($errors->all() as $message) 
				        <li>{{ $message }}</li>
				      @endforeach
				    </ul>
				    
				    </div>
				 
				@endif
				<table class="payment-table table table-bordered table-hover">
					<thead>
						<tr><th colspan="2">Choose your payment option</th></tr>
					</thead>
					<tbody>
						<tr class="tr-btn" style="cursor: pointer;">
							<td style="border-right: 1px solid #fff;" class="text-right">
								<input type="radio" name="payment" id="payment" value="cc">
							</td>
							<td>
								<h4>
									<label>Credit Card Payment</label>
								</h4>
								<img src="/image/gateway.jpg" class="img-responsive img-cc">
								
								<!--
								If your choose this option we will redirect you to our bank's secured payment gateway.
								-->
								<div style="margin-top: 20px; cursor: default;">
									<div class="collapse" id="collapseCard">
										<div class="row">
											<div class="col-md-12">
												<span class="card-img pull-left"></span>
											</div>
										</div>
									  <div class="row">
									    <div class="col-md-6 col-sm-7">
												<div class="form-group">
											    <label for="ccn">Card Number:</label>
											    <input type="text" class="form-control" id="ccn" name="ccn" placeholder="Credit Card Number" maxlength="19">
											  </div>
									    </div>
									    <div class="col-md-3 col-md-push-1 col-sm-5">
												<div class="form-group">
													<label for="expiry">Expiration:</label>
											    <input  class="form-control" type="text" name="expiry" id="expiry" placeholder="MM/YYYY">
											  </div>
									    </div>
									  </div><!-- end: .row -->
									  <div class="row">
									    <div class="col-md-8">
												<div class="form-group">
											    <label for="cardname">Name on card:</label>
											    <input type="text" class="form-control" id="cardname" name="cardname" placeholder="Name on card" maxlength="50">
											  </div>
									    </div>
									  </div><!-- end: .row -->
									  <div class="row">
									    <div class="col-md-3 col-sm-4">
												<div class="form-group">
											    <label for="cvc">Security Code:</label>
											    <input type="text" class="form-control" id="cvc" name="cvc" placeholder="CVC" maxlength="4">
											    <!--
											    <label for="ccm">Expiration Month:</label>
											    <select class="form-control" id="ccm" required>
											    	<option disabled selected value="">Select a month</option>
											    	<option value="01">01 - January	</option>
											    	<option value="02">02 - February	</option>
											    	<option value="03">03 - March	</option>
											    	<option value="04">04 - April	</option>
											    	<option value="05">05 - May	</option>
											    	<option value="06">06 - June	</option>
											    	<option value="07">07 - July	</option>
											    	<option value="08">08 - August	</option>
											    	<option value="09">09 - September	</option>
											    	<option value="10">10 - October	</option>
											    	<option value="11">11 - November	</option>
											    	<option value="12">12 - December	</option>
											    </select>
											    -->
											  </div>
									    </div>
									    <div class="col-md-3 ">
									    <!--
												<div class="form-group">
											    <label for="ccy">Expiration Year:</label>
											    <select class="form-control" id="ccy" required>
											    	<option disabled selected value="">Select a year</option>
											    	<?php 
											    		foreach (range(date('Y', strtotime('now')), 2040) as $value) 
											    			echo '<option value="'.$value.'">'.$value.'</option>';
											    	?>
											    </select>
											  </div>
											-->
									    </div>
									  </div><!-- end: .row -->
									</div>
								</div>
							</td>
						</tr>
						
					</tbody>
				</table>
				<div class="clearfix">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					@if(request()->has('method') && request()->input('method')=='direct')
						<input type="hidden" name="method" value="direct">
					@endif
					<input type="hidden" name="id" value="{{$booking->id}}">
					<button class="btn btn-primary pull-right clearfix" id="btn-placed" disabled>
						<span class="glyphicon glyphicon-ok"></span>
						Place your booking
					</button>
				</div>

				

			<small>
				
				By placing your booking, you agree to Filigans Hotel's <a target="_blank" href='http://bit.ly/filigans-cancellation-policy'>term and conditions of use.
				
			</small>

			<div>
				<img src="/image/secured.png" class="img-responsive">
				</div>
			</div>
		</form>
	</div>
	
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="/asset/frontend/js/app.js"></script>
<script type="text/javascript" src="/asset/frontend/js/booking.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/card/2.2.1/card.min.js"></script>
  <script type="text/javascript">

  	var setExpiry = function setExpiry() {
  		$('#expiry').val($('#ccm').val()+'/'+$('#ccy').val()).trigger('blur');
  		console.log($('#expiry').val());
  	}

  	var card = new Card({
	    form: '#cardForm', // *required*
	    container: '.card-img', // *required*
	    formSelectors: {
	      numberInput: 'input#ccn', // optional — default input[name="number"]
	      expiryInput: 'input#expiry', // optional — default input[name="expiry"]
	      cvcInput: 'input#cvc', // optional — default input[name="cvc"]
	      nameInput: 'input#cardname' // optional - defaults input[name="name"]
	    },
	    width: 200, // optional — default 350px
	    formatting: true, // optional - default true
	    messages: {
        validDate: 'valid\ndate', // optional - default 'valid\nthru'
	      monthYear: 'mm/yyyy', // optional - default 'month/year'
	    },
	    placeholders: {
        number: '•••• •••• •••• ••••',
        name: 'Full Name',
        expiry: '••/••',
        cvc: '•••'
	    },
	    masks: {
	      cardNumber: '•' // optional - mask card number
	    },
	    debug: true // optional - default false
		});
  	
  	$(document).ready(function(){

  		$('#payment').on('click', function(el){
  			$('#btn-placed').prop('disabled', false);
  		});

  		$('.tr-btn td').on('click', function(el){
  			$('#payment').prop('checked', true);
  			$('#btn-placed').prop('disabled', false);
  			//$('#collapseCard').collapse('show');
  			//$('.img-cc').hide();
  			$('.alert-errors').remove();

  		});


  		$('#ccm').on('change', function(e) {
  			console.log('ccm')
  			setExpiry();
  		})

  		$('#ccy').on('change', function(e) {
  			console.log('ccy')
  			setExpiry();
  		})

  		

  		
  	});

  </script>
@endsection