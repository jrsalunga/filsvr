@extends("admin.layout.master")
@section("controller")
bookingController
@endsection
@section("styles")
link
<link rel="stylesheet" type="text/css" href="
https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker.css">
<style type="text/css">
	td
	{
		font-size:20px;
	}
	
	tr td:first-of-type
	{
		text-align:right;
	}	

	tr td:nth-of-type(2)
	{
		font-weight:bold;
	}

	.box-tiles
	{
		cursor:pointer;
	}
</style>

@endsection
@section("modal")
<div class="modal fade" id="modal-check-out">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Proceed to check out</h4>
			</div>
			
			<div class="modal-body">
				<div class="alert alert-warning" ng-cloak ng-show="errors">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Oops!</strong> <span ng-bind='errors'></span>
				</div>
				<table class="table table-hover">
					<Tr> 
						<td style="width:40%;"> 
							Sub Total
						</td>
						<td ng-bind="booking_details.sub_total_price">

						</td>
					</Tr>
					<tr>
						<td>
							Tax Price(<span ng-bind="booking_details.tax+'%'"> </span>)
						</td>
						<td ng-bind="booking_details.tax_price">

						</td>
					</tr>
					<td> 
						Total Price
					</td>
					<td ng-bind="booking_details.total_price">

					</td>
				</tr>
			</table>
			<table class="table">
				<tr>
					<td>
						Payment Method
					</td>
					<td>
						<select ng-model="booking_details.payment_mode"  class="form-control" required="required">
							<option value="Cash">Cash</option>
							<option value="Credit Card">Credit Card</option>
							<option value="Pre Paid">Pre-Paid</option>
							<option value="Voucher">Voucher</option>
						</select>
					</td>
				</tr>
				<tr>
					<td style="width:20%">
						Amount Paid
					</td>
					<td>
						<input type="text" class="form-control" ng-model="booking_details.amount_paid" ng-change="computeChange(booking_details.amount_paid, booking_details.total_price)" placeholder="Enter amount Paid">
					</td>
				</tr>
				<tr>
					<td>
						Change
					</td>
					<td>
						<input ng-value="booking_details.change | currency:'':2" type="text" placeholder="Change" class="form-control" disabled="disabled">
					</td>
				</tr>
				<tr>
					<td>
						Customer
					</td>

					<td>
						<select ng-model="booking_details.customer" class="select-customer" style='width:100%;'>
							<option selected="selected">Please select a customer</option>
						</select>
					</td>
				</tr>
				
			</table>

		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			<button type="button" ng-click="btnProceedBooking(booking_details)" class="btn btn-primary">Submit</button>
		</div>

	</div>
</div>
</div>
@endsection
@section("scripts")
<script type="text/javascript" src="/asset/admin/js/booking.js"></script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js'></script>
<script type="text/javascript">

	$('.range-container').datepicker({
		inputs: $('.range'),
		format: "yyyy-mm-dd"
	});

	$(".range.start").on("changeDate", function()
	{
		$("#checkin-input").val($('.range.start').datepicker("getFormattedDate"));
	})

	$(".range.end").on("changeDate", function()
	{
		$("#checkout-input").val($('.range.end').datepicker("getFormattedDate"));
	})

</script>


<script type="text/javascript">
	app.constant("csrf", "{{ csrf_token() }}");
</script>
@endsection
@section("content")
<div class="row">
	<hr class="hr-primary" />
	<ol class="breadcrumb bread-primary ">
		<a href="/admin/booking" class="btn btn-primary"><span class="glyphicon glyphicon-glyphicon glyphicon-calendar" aria-hidden="true"></span> Booking Management </a>
		<li class="active">Create booking</li>
	</ol>
</div>
<div class="row row2">
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
		<div class="alert alert-warning" ng-cloak ng-show="errors">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Oops!</strong> <span ng-bind='errors'></span>
		</div>

		<div id="step1" class="row">
			<div class="range-container">

				<div class="col-xs-6 col-sm-12 col-md-6 col-lg-6">
					<input type="hidden" ng-model="booking.checkInDate" id="checkin-input">
					<h4 class='txt-shadow-black' style='color:rgb(112, 186, 112)'>
						Check-in date
					</h4>
					<div class=" range start"></div>
				</div>

				<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
					<input type="hidden" ng-model='booking.checkOutDate' id="checkout-input">
					<h4 class='txt-shadow-black' style='color:rgb(112, 186, 112)'>
						Check-out date
					</h4>
					<div class=" range end"></div>
				</div>	
			</div>

			<button ng-click="checkAvailability(booking)" type="button" class="btn btn-lg btn-block btn-primary"><span class="glyphicon glyphicon-glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Check Availability</button>

			<div class="alert alert-info" ng-cloak ng-show="loading">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>Loading</strong> Please wait...
			</div>
		</div>
		<div id="step2" class="row" style="display:none;">
			<div>

				<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5" >
					<select  class="form-control" ng-model="currentroomtype" ng-options="ar.id as ar.name for ar in availableroomtype"></select>
				</div>
			</div>

			<div class="clearfix">

			</div>
			<div style="margin-top:10px">

				<div class="media border box-shadow-xs" ng-repeat="ar in availablerooms |filter:(currentroomtype==0) ? '' : { room_type_id:currentroomtype }">

					<a class="pull-left" href="#">
						<img class="media-object" ng-src="/image/avatar/[[ ar.details.picture]]" alt="Image">
					</a>
					<div class="media-body">
						<h4 class="media-heading" ><span ng-bind="ar.details.name"> </span> <small>RM <span ng-bind="ar.room_no_str"> </span></small></h4>
						<p>Description: <span ng-bind="ar.details.short_description"></span></p>
						
						<p ng-show="ar.details.meal_plans!=null">Meal Plans:  <span ng-bind="ar.details.meal_plans.name"></span></p>
						<form ng-submit="submitBooking($event,$index, ar)" class="bookingform" method="POST" action="/admin/booking/temprooms/">
							<table class="table table-hover">
								<tr>
									<th style="border:0" ng-show="ar.details.meal_plan!=null"> 
										Food
									</th>
									<th style="border:0">
										Adult
									</th>
									<th style="border:0">
										Children
									</th>
									<tr>

										<td  style="border:0;width:20%">
											<select ng-disabled="ar.details.meal_plans==null" required ng-model="ar.input_food" ng-show="ar.details.meal_plan!=null" name="" id="input" class="form-control" required="required">
												<option value="0">0</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>

											</select>
										</td>
										<td  style="border:0"> 

											<select ng-cloak ng-change="isValidCapacity(ar.input_children, ar.input_adult, $index)" required ng-model="ar.input_adult" ng-show="ar.details.meal_plan!=null" name="" id="input" class="form-control" required="required">
												<option value="0">0</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
											</select>
										</td>
										<td  style="border:0"> 

											<select required ng-model="ar.input_children" ng-show="ar.details.meal_plan!=null" name="" id="input" class="form-control" ng-change="isValidCapacity(ar.input_children, ar.input_adult, $index)" required="required">
												<option value="0">0</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option value="3">3</option>
												<option value="4">4</option>
												<option value="5">5</option>
												<option value="6">6</option>
												<option value="7">7</option>
												<option value="8">8</option>
												<option value="9">9</option>
											</select>
										</td>
										<td style="border:0"> <button type="submit" ng-disabled="ar.disable_booking" class="btn btn-sm btn-block btn-primary"><span class="glyphicon glyphicon-glyphicon glyphicon-send" aria-hidden="true"></span> Book this room</button></td>
									</tr>
								</table>
							</form>
						</div>
					</div>
					<div class="alert alert-warning" ng-show="availablerooms.length < 1" ng-cloak>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>Oops</strong> There is no available room
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">

			<div class="booking-sidebar">
				<label> Reservation Details</label>
				<table class="table"> 
					<thead>
						<th>
							Check In
						</th>
						<th>
							Check Out
						</th>
					</thead>
					<tbody>
						<tr>
							<td ng-bind="booking_details.check_in" style="text-align:center">
								---
							</td>

							<td ng-bind="booking_details.check_out" style="font-weight:500;text-align:center">
								---
							</td>
						</tr>
						<tr>
							<td colspan=2>
								<button type="button" class="btn btn-sm btn-block btn-default" ng-click="changeDate()"><span class="glyphicon glyphicon-glyphicon glyphicon-cog" aria-hidden="true" style="color:#444"></span> change date</button>
							</td>
						</tbody>
					</table>

					<h5 ng-show="booking_details.tax">Rooms</h5>

					<table ng-show="booking_details.tax" class="table table-hover table-striped" style="padding-top:0">
						<tr ng-repeat="rooms in booking_details.booked_room_details">
							<td  style="width:70%;text-align:left"><h6 ng-cloak style="font-weight:bold" ng-bind="rooms.name"> </h6>
								<h6 style="margin:3px 0 0 0">Children (<label ng-bind="rooms.children"> </label>) Adult(<label ng-bind="rooms.adult"></label>) </h6>
								<button type="button" class="btn btn-xs btn-danger" ng-click="removeBookedRoom(rooms.room_id)">remove</button>
							</td>
							<td>
								<h5>Room Price</h5>
								<h6 ng-bind="rooms.room_price"> </h6>
								<h5>Food </h5>
								<h6 ng-bind="rooms.food_price"> </h6>
							</td>
						</tr>
						<tr>
							<td><h5>Sub Total</h5></td>
							<td>
								<h6 ng-bind="booking_details.sub_total_price">---</h6>
							</td>
						</tr>
						<tr>	
							<td><h5>Total (<span ng-bind="booking_details.tax+'%'"> --- </span>) </h5></td>
							<td>
								<h6 ng-bind="booking_details.total_price">---</h6>
							</td>
						</tr>
						<tr>
							<td colspan=2 ng-show="booking_details.booked_room_details.length > 0">
								<button ng-click="proceedCheckout(booking_details)" type="button" class="btn btn-large btn-block btn-primary"><span class="glyphicon glyphicon-chevron-right" style="color:white" aria-hidden="true"></span>Proceed Check Out</button>
							</td>
						</table>
					</div>

				</div>
				@endsection
