@extends("frontend.layout.master")
@section("controller")
bookingController
@endsection	
@section("scripts")
<script src="/asset/frontend/js/jssor.slider.mini.js"></script>
<script type="text/javascript" src='/asset/frontend/js/slider.js'></script>
<script type="text/javascript" src="/asset/frontend/js/app.js"></script>
<script type="text/javascript" src="/asset/frontend/js/booking.js"></script>
<script type="text/javascript">

	$('.range-container').datepicker({
		inputs: $('.range'),
		format: "yyyy-mm-dd"
	});
	$('.range.start').datepicker("setDate", "{{ $check_in }}");
	$('.range.end').datepicker("setDate", "{{ $check_out }}");

	$(".range.start").on("changeDate", function()
	{
		
		$("#checkin-input").val($('.range.start').datepicker("getFormattedDate"));
	})

	$(".range.end").on("changeDate", function()
	{
		$("#checkout-input").val($('.range.end').datepicker("getFormattedDate"));
	})
	$('#dob').datepicker({
		format: "yyyy-mm-dd"
	});
</script>
@endsection
@section("content")
<div class="wizard">
	<ul class="nav nav-wizard">
		<li class="active">
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
		<li class="disabled" style=''>
			<a href="#step5" data-toggle="tab">5. Confirmation</a>
		</li>
	</ul>
</div>
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 rooms">
	<section>
		<div class="wizard">
			
			<form>
				<div class="tab-content" >
					<div class='loader-container'>
						<center>
							<img src="/asset/images/loader.gif">
						</center>
					</div>
					<div class='loader-mask'>
						<!--  -->
					</div>
					<div class="tab-pane active" id="step1">

						<div ng-cloak class="alert alert-danger" ng-show="errors!='' &&  errors!=null" style="margin-top:10px">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
							<strong>Oops!</strong> <span ng-bind="errors"></span>
						</div>
						<div class="range-container">
							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<h3 class='txt-shadow-black' style='color:rgb(112, 186, 112)'>
									Check-in date
								</h3>
								<input type="hidden" ng-init="booking.checkInDate='{{ $check_in }}'" ng-model="booking.checkInDate" id="checkin-input">
								<div class="range start"></div>
							</div>

							<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
								<h3 class='txt-shadow-black' style='color:rgb(112, 186, 112)'>
									Check-out date
								</h3>
								<input type="hidden" ng-init="booking.checkOutDate='{{ $check_out }}'" ng-model="booking.checkOutDate" id="checkout-input">
								<div class="range end"></div>
							</div>

							<div class="container-fluid">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
										<h3 class='txt-shadow-black' style='color:rgb(112, 186, 112)'>
											No of adult
										</h3>
										<select name="" ng-model="booking.noOfAdult" ng-init="booking.noOfAdult = '{{ $adult }}'" id="input" class="form-control" required="required">
											@for($i = 0; $i <=9; $i++)
											<option value="{{ $i }}"> {{ $i }}</option>

											@endfor
										</select>
									</div>
									
									<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
										<h3 class='txt-shadow-black' style='color:rgb(112, 186, 112)'>
											No of children

										</h3>
										<select name="" id="input" ng-init="booking.noOfChildren = '{{ $children }}'" class="top-shadow form-control" required="required" ng-model="booking.noOfChildren">
											@for($i = 0; $i <=9; $i++)
											<option value="{{ $i }}"> {{ $i }}</option>
											@endfor
										</select>
									</div>

								</div>
							</div>

						</div>
						<p>
							<ul class="list-inline pull-right" style='margin:20px 20px 0 0'>
								<li><button ng-click="checkAvailability(booking)" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Continue</button></li>
							</ul>
						</div>
						<div class="tab-pane" id="step2">
							<div ng-cloak class="alert alert-danger" ng-show="errors!='' &&  errors!=null" style="margin-top:10px">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<strong>Oops!</strong> <span ng-bind="errors"></span>
							</div>
							<div class="well">
								<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">

									<div class="form-group">
										<h4>Number of adults</h5>
											<select name="" ng-model="booking.noOfAdult" id="input" class="form-control" required="required">
												@for($i = 0; $i <=9; $i++)
												<option value="{{ $i }}"> {{ $i }}</option>

												@endfor
											</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
										<div class="form-group">
											<h4>Number of Children</h5>
												<select name="" ng-model="booking.noOfChildren" id="input" class="form-control" required="required">
													@for($i = 0; $i <=9; $i++)
													<option value="{{ $i }}"> {{ $i }}</option>
													@endfor
												</select>
											</div>
										</div>
										<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
											<div class="form-group">
												<button ng-click="checkAvailability(booking,false,false)" type="button" class="btn btn-md btn-block btn-primary"><span class="glyphicon glyphicon-glyphicon glyphicon-filter" aria-hidden="true"></span>Filter</button>
											</div>
										</div>
										<div class="clearfix">

										</div>
									</div>
									<div ng-cloak ng-show="availablerooms.length < 1" class="alert alert-warning">
										<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
										<strong>Oops!</strong> There is no available rooms at the moment.
									</div>
									<!-- for mobile viewing -->
									
									<div class="media container-fluid" ng-repeat="ar in availablerooms">
										<a class="pull-left" href="#" style='width:50%'>
											<img ng-src="/image/room-preview/[[ ar.details.picture ]]" class='img-thumbnail img-responsive' style='width:100%'>
										</a>
										<div class="media-body">
											<a href="javascript:void(0)"><h2  class='pull-left'  style='margin:0; padding:0' ng-bind="ar.details.name"></h2>
											</a>
											<div class="clearfix">
											</div>
											<hr>
											<p>
												<span class="glyphicon glyphicon-glyphicon glyphicon-check" aria-hidden="true"></span> <strong>Bed</strong> <span ng-bind="ar.details.beds"> </span> bed rooms
											</p>
											<p>
												<span class="glyphicon glyphicon-glyphicon glyphicon-check" aria-hidden="true"></span> <strong>Max</strong> <span ng-bind="ar.details.capacity"></span> People
											</p>
											<p>
												<span class="glyphicon glyphicon-glyphicon glyphicon-check" aria-hidden="true"></span> <strong> Room Size </strong> <span ng-bind="ar.details.room_area"></span> sqm
											</p>
											<p>
												<div class="clearfix">
												</div>
												<div class='room-description' ng-bind="ar.details.short_description">

												</div>
												<div class='rooms'>
													<div class="item" style='margin:0'>
														<h3 style='margin:10px'>Start From <span>P <span ng-bind="ar.details.display_price"></span> /night</span></h3>
													</div>
												</div>

											</div>
											<!-- form here -->
											<form></form>
											<form ng-submit="submitBooking($event,$index, ar)" class="bookingform" method="POST" action="/booking/temprooms/">
												<!-- end of form -->
												<button type="submit" class="btn btn-lg btn-block btn-primary" style='margin-top:20px'><span class="glyphicon glyphicon-glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Select this room</button>
											</form>
										</div>

										<!-- end of mobile view -->
																<!--
																													<div class="rooms visible-md visible-lg" style='margin:10px 0 0 0'>
																															<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 item">
																																	<img src="hotelrooms/column2.jpg" class='img-thumbnail img-responsive' style='width:100%'>
																																	<a href="javascript:void(0)"><h2  class='pull-left'>Deluxe Room</h2>
																																			<h4 class='pull-right'>Start From <span>P100.00 /night</span></h4></a>
																																			<div class="clearfix">
																																			</div>
																																			<hr>
																																				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 features-container	">
																																					<div class="features-content txt-shadow-white">
																																							<span style='float:right' class="glyphicon glyphicon-remove" aria-hidden="true"></span>
																																							No. of Bed: 3
																																					</div>
																																			</div>
																																				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 features-container	">
																																					<div class="features-content txt-shadow-white">
																																							<span style='float:right' class="glyphicon glyphicon-remove" aria-hidden="true"></span>
																																							Room Area:  3
																																					</div>
																																			</div>
																																				<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 features-container	">
																																					<div class="features-content txt-shadow-white">
																																							<span style='float:right' class="glyphicon glyphicon-remove" aria-hidden="true"></span>
																																							Max of 4 people
																																					</div>
																																			</div>
																																			<div class="clearfix">
																																			</div>
																																			<div class='room-description'>
																																					"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
																																			</div>
																																			<button type="button" class="btn btn-lg btn-block btn-primary" style='margin-top:10px'><span class="glyphicon glyphicon-glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Select this room</button>
																																	</div>
																																</div> -->
																															</div>
																															<div class="tab-pane" id="step3">
																																<div ng-cloak class="alert alert-danger" ng-show="errors!='' &&  errors!=null" style="margin-top:10px">
																																	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
																																	<strong>Oops!</strong> <span ng-bind="errors"></span>
																																</div>

																																<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
																																	<div class="form-group">
																																		<label for="">Firstname*</label>
																																		<input type="text" placeholder="Firstname" ng-model="customer.firstname" class="form-control" id="" placeholder="Input field">
																																	</div>
																																	<div class="form-group">
																																		<label for="">Email* <small style='display:inline-block;color:#676767'>
																																			For existing customer please use your old email address
																																		</small></label>
																																		<input type="text" placeholder="Email address" ng-model="customer.email" class="form-control" id="" placeholder="Input field">
																																	</div>
																																	<div class="form-group">
																																		<label for="">Birthday* <small style='display:inline-block;color:#676767'>
																																		</small></label>
																																		<input id="dob" class="datepicker form-control" type="text" placeholder="YYYY-MM-DD" ng-model="customer.birthday">
																																	</div>
																																	<div class="form-group">
																																		<label for="">Address <small style='display:inline-block;color:#676767'>
																																		</small></label>
																																		<textarea placeholder="Address" ng-model="customer.address" class='form-control'></textarea>
																																	</div>
																																</div>
																																<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
																																	<div class="form-group">
																																		<label for="">Lastname* <small style='display:inline-block;color:#676767'>
																																		</small></label>
																																		<input type="text" ng-model="customer.lastname" class="form-control" id="" placeholder="Lastname">
																																	</div>
																																	<div class="form-group">
																																		<label for="">Phone Number* <small style='display:inline-block;color:#676767'>
																																		</small></label>
																																		<input placeholder="Phone Number" type="text" class="form-control" id="" ng-model="customer.phone_number" placeholder="Input field">
																																	</div>
																																	<div class="form-group">
																																		<label for="">Nationality* <small style='display:inline-block;color:#676767'>
																																		</small></label>
																																		<input ng-model="customer.nationality" placeholder="Nationality" type="text" class="form-control" id="" ng-model="customer.phone_number" placeholder="Input field">
																																	</div>
																																	<div class="form-group">
																																		<label style="margin-bottom:7px;" for="">Flight Details <small style='display:block;color:#676767'>
																																		</small></label>
																																		<textarea ng-model="booking_details.flight_details" placeholder="e.g. 10:00 AM arrival at airport" class='form-control'></textarea>
																																	</div>
																																</div>
																																<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
																																	<div class="form-group">
																																		<h4 class="text-center">
																																			<label for="">Additional Note <small style='display:block;color:#676767'>
																																				Additional details for your reservation
																																			</small></label>
																																		</h4>
																																		<textarea ng-model="booking_details.additional_note" class='form-control'></textarea>
																																	</div>
																																</div>
																																<div class="clearfix">
																																</div>
																																<div class="clearfix">
																																</div>
																																<ul class="list-inline pull-right" style='margin-top:20px'>
																																	<li><button type="button" ng-click="btnProceedBooking(booked_details, customer)" class="btn btn-primary">
																																		<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
																																		Continue</button></li>
																																</ul>
																															</div>
																															<div class="tab-pane" id="step4">
																																<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding:5px;background-color:#fff">
																																	<table class="payment-table table table-bordered table-hover" style="margin-bottom:0px">
																																		<tr>
																																			<th colspan=2>Choose your payment option</th>
																																		</tr>
																																		<tr>
																																			<td class="text-center">
																																				<h3>Credit Card Payment</h3>
																																				<div class="radio">
																																					<label>
																																						<input type="radio" name="" id="input" value="" checked="checked">
																																					</label>
																																				</div>
																																			

																																			</td>
																																		</tr>
																																	</table>
																																	<a href="https://test.paydollar.com/ECN/eng/payment/payForm2.jsp" style="margin-top:20px;color:white" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Place your payment</a>
																																</div>
																															</div>
																															<div class="tab-pane" id="step5">
																																<h3 class="text-center">Complete</h3>
																																<p class="text-center">You have successfully created a reservation. Thank you for availing our service.</p> 
																																<h4 class="text-center">You will receive an email shortly. </h4>
																															</div>
																															<div class="clearfix"></div>
																														</div>
																													</form>
																												</div>
																											</section>
																										</div>
																										<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 reservation-sidebar ">
																											<h3 class="text-center" style='color:#D8D25F;border-bottom:2px solid #E7E39E;padding-bottom:5px;margin-bottom:0'>YOUR RESERVATION</h3>

																											<h4 class="text-center text-control pick-date-text" ng-hide="booking_details.check_in != '---' && booking_details.check_out !='---'"> Please pick a date first.</h4>

																											<div style="padding:10px" ng-cloak ng-show="booking_details.check_in != '---' && booking_details.check_out !='---'">
																												<div class="container-fluid">
																													<div class="row">

																														<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
																															<h5 class="date heading">Check In Date </h5>
																															<h4 class="date content" ng-bind="booking_details.check_in"></h4>
																														</div>

																														<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
																															<h5 class="date heading">Check Out Date </h5>
																															<h4 class="date content" ng-bind="booking_details.check_out"></h4>
																														</div>
																													</div>

																												</div>
																												<button ng-click="changeDate()" type="button" class="btn btn-md btn-block btn-warning"><span class="glyphicon glyphicon-glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Change Date</button>

																											</div>

																											<div ng-cloak class='rooms' style=' ' ng-show="booking_details.check_in != '---' && booking_details.check_out !='---' && booking_details.customer_booked_room.length >= 1" ng-repeat="brd in booking_details.booked_room_details">
																												<h5>Room # [[ $index ]]  <span ng-bind="brd.name">---</span> </h5>
																												<h5> [[ brd.adult ]] Adult [[ brd.children ]] Children</h5>
																												<h3  > <SPAN ng-bind="'P '+brd.room_price"></SPAN></h3>
																												<button ng-hide="submitbooking" type="button" class="btn btn-xs btn-danger" ng-click="removeBookedRoom(brd.room_id)"><span class="glyphicon glyphicon-glyphicon glyphicon-trash" aria-hidden="true"></span> Remove Room</button>
																											</div>

																											<div class='rooms' style='' ng-cloak ng-show="booking_details.check_in != '---' && booking_details.check_out !='---' && booking_details.customer_booked_room.length < 1">
																												<h4 class="text-center text-control pick-date-text"> Pick a room now.</h4>
																											</div>
																											<div style='padding:10px'>
																												<button id="submit-booking" style="display:none" ng-click="btnSubmitBooking()" ng-show="booking_details.check_in != '---' && booking_details.check_out !='---' && booking_details.customer_booked_room.length >= 1" type="button" class="btn btn-large btn-block btn-primary"><span class="glyphicon glyphicon-glyphicon glyphicon-send" aria-hidden="true"></span> Submit booking</button>
																											</div> 
																										</div>

																										@endsection