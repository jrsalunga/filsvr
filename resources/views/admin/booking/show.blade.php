@extends("admin.layout.master")
@section("modal")

<div class="modal fade" id="modal-additional-transaction">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="form-additional-transaction" method="POST" action="/admin/booking/additionaltransaction">
				{{ csrf_field() }}
				<input type="hidden" name="booking_id" value="{{ $booking->id }}">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Create additional transaction</h4>
				</div>
				<div class="modal-body">
					<table class="table table-hover">
						<tr>
							<td style='width:20%'>
								Reference Number
							</td>
							<td>
								<input name="reference_no" type="text" class="form-control" placeholder="Enter Reference Number | Not Required">
							</td>
						</tr>
						<tr>
							<td>
								Description
							</td>
							<td>
								<textarea name="description" placeholder="Enter description" class="form-control"></textarea>
							</td>
						</tr>
						<tr>
							<td>
								Amount
							</td>
							<td>
								<input type="text" name="amount" class='form-control' placeholder="Enter amount">
								<small>This is a number only input. You can input negative numbers.</small>
							</td>
						</tr>
					</table>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="disable-on-click btn btn-primary">Submit</button>
				</div>

			</form>
		</div>
	</div>
</div>
@endsection
@section("styles")
<style type="text/css">
	table thead tr:first-of-type
	{
		font-size:18px;	
	}
</style>
@endsection

@section("scripts")
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js'></script>
<script type="text/javascript" src="/asset/admin/js/table-formatter.js"></script>
<script type="text/javascript">
	$(".disable-on-click").click(function()
		{	$("#form-additional-transaction").trigger("submit");
		$(this).attr("disabled", "disabled");
	})
</script>
@endsection

@section("content")
<div class="row">
	<hr class="hr-primary" />
	<ol class="breadcrumb bread-primary ">
		<a href="/admin/booking" class="btn btn-primary"><i class="fa fa-calendar"></i> Booking Mangement</a>
		<li> <a href="/admin/booking"> Booking List </a> </li>
		<li class="active">Booking REF No: {{ $booking->booking_no }}</li>
	</ol>
</div>


<div class="row row2">
	@include("admin.partial.notifications")
	@if(Session::has("caution"))
	<div class="alert alert-warning">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Caution</strong> {{ Session::get("caution") }}
		<form method="POST" action="/admin/booking/{{ $booking->id}}" style="pull-right">
			{{ csrf_field() }}
			<input type="hidden" name="_method" value="patch">
			<input type="hidden" name="sure" value="true">
			<button type="submit" name="booking_status" value="completed" class="btn btn-sm btn-success"><span style="color:white" class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Set Complete Booking</button>
		</form>
	</div>
	@endif

	@if(Session::has("cancelled"))
	<div class="alert alert-warning">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Caution</strong> {{ Session::get("caution") }}
		<form method="POST" action="/admin/booking/{{ $booking->id}}" style="pull-right">
			{{ csrf_field() }}
			<input type="hidden" name="_method" value="patch">
			<input type="hidden" name="sure" value="true">
			{{ Session::get("cancelled") }}
			<button type="submit" name="booking_status" value="cancelled" class="btn btn-sm btn-danger"><span style="color:white" class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Cancel this booking now.</button>
		</form>
	</div>
	@endif

	<table class="table table-striped">
		<thead>
			<th colspan=2>

				BOOKING INFORMATION <a href="/admin/booking/{{ $booking->booking_no }}/invoice" class="pull-right btn btn-primary"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Print Invoice</a>
				<a href="/admin/booking/{{ $booking->booking_no }}/registration" class="pull-right btn btn-success"><span class="glyphicon glyphicon-list-users" aria-hidden="true"></span>Print Registration</a>
			</th>
		</thead>
		<tbody>

			<tr>
				<th style="width:20%;border:0">
					Booking ID 
				</th>
				<td>
					{{ $booking->id }}
				</td>
			</tr>

			<tr>
				<th>
					Booking Ref#
				</th>
				<td>
					{{ $booking->booking_no }}
				</td>
			</tr>

			<tr>
				<th>
					Customer
				</th>
				<td>
					{{ $booking->customer->fullname}}
				</td>
			</tr>
			<tr>
				<th>
					Check In 
				</th>
				<td>
					{{ $booking->check_in }}
				</td>
			</tr>
			<tr>
				<th>
					Check Out 
				</th>
				<td>
					{{ $booking->check_out }}
				</td>
				<tr>
					<th>
						Booking Status
					</th>
					<td>
						@if($booking->booking_status == "Checked In")
						<form method="POST" action="/admin/booking/{{ $booking->id}}">
							{{ csrf_field() }}
							<input type="hidden" name="_method" value="patch">
							{{ $booking->booking_status }} <button type="submit" name="booking_status" value="completed" class="btn btn-sm btn-success"><span style="color:white" class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Set Complete Booking</button>
						</form>
						
						@elseif(strtolower($booking->booking_status) == "pending")	
						<form method="POST" action="/admin/booking/{{ $booking->id}}">
							{{ csrf_field() }}
							<input type="hidden" name="_method" value="patch">
							{{ $booking->booking_status }} <button type="submit" name="booking_status" value="Booked" class="btn btn-sm btn-success"><span style="color:white" class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Confirm this booking</button>
						</form>
						
						@elseif(strtolower($booking->booking_status) == "booked")	
						<form method="POST" action="/admin/booking/{{ $booking->id}}">
							{{ csrf_field() }}
							<input type="hidden" name="_method" value="patch">
							{{ $booking->booking_status }} <button type="submit" name="booking_status" value="Checked In" class="btn btn-sm btn-success"><span style="color:white" class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Check In this booking</button>
						</form>
						@else

						{{ $booking->booking_status }}
						@endif
					</td>
				</tr>
				<tr>
					<th>
						Payment Status
					</th>
					<td>
						@if($booking->payment_status=="Partially Paid")
						Partially Paid
						<form method="POST" action="/admin/booking/{{ $booking->id}}">
							{{ csrf_field() }}
							<input type="hidden" name="_method" value="patch">
							<button name="payment_status" value="Fully Paid" type="submit" class="btn btn-sm btn-primary"><span style="color:white" class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>Set Full Payment</button>
						</form>
						
						@else
						{{ $booking->payment_status }}
						@endif
					</td>

				</tr>
				<tr>
					<th>Remaining Credits</th>
					<td>
						{{ number_format($booking->credits,2) }}
					</td>
				</tr>
				
				<tr>	

					<tr>
						<th>Total Room Price</th>
						<td>
							{{ number_format($booking->total_room_price,2) }}
						</td>
					</tr>
					<th>
						Tax Price
					</th>
					<td>
						{{ number_format($booking->tax_price, 2) }}
					</td>
				</tr>
				<tr>	
					<th>
						Additional Transaction Price
					</th>
					<td>
						{{ number_format($booking->additional_transaction_price,2) }}
					</td>
				</tr>
				<tr>	
					<th>
						Total Price
					</th>
					<td>
						{{ number_format($booking->total_price,2) }}
					</td>
				</tr>
				<tr>
					<th>Amount Paid</th>
					<td>{{ number_format($booking->amount_paid,2) }}</td>
				</tr>
			</tbody>
		</table>
		@if($booking->booking_status != "cancelled")
		<div class="well">
			<form method="POST" action="/admin/booking/{{ $booking->id}}" style="pull-right">
				{{ csrf_field() }}
				<input type="hidden" name="_method" value="patch">
				Cancel booking. This process is ireversible. 
				<button type="submit" name="booking_status" value="cancelled" class="btn btn-danger"><span class="glyphicon glyphicon-glyphicon glyphicon-remove" aria-hidden="true"></span> Cancel Booking</button>
			</form>
		</div>
		@endif
		<table  class="table table-striped">
			<thead>
				<tr>
					<th colspan=9 > 
						DETAILS
					</th>
				</tr>
				<tr>
					<th>
						#
					</th>
					<th>Room No</th>
					<th>Room Type</th>
					<th>Check In</th>
					<th>Check Out</th>
					<th>Room Price</th>
					<th>Food Price</th>
					<th>Adult</th>
					<th>Children</th>

				</tr>

			</thead>
			<tbody>
				@foreach($booking->rooms as $key=>$rooms)
				<tr>
					<td>
						{{ $key+1 }}
					</td>
					<td>
						<form method="POST" action="/admin/booking/{{ $booking->id }}">
							<input type="hidden" name="booked_room_id" value="{{ $rooms->id }}">
							<input type="hidden" name="_method" value="PATCH">
							{{ csrf_field() }}
							<select name="room_id" id="input" class="form-control" required="required">
								<option value="{{ $rooms->room_id }}"> {{ $rooms->roomDetails->room_no }}</option>
								@foreach($available_rooms1 as $ar1)
								<option value="{{ $ar1->id }}"> {{ $ar1->room_no }}</option>
								@endforeach
							</select>
							<button name="updateroom" value="true;" type="submit" class="btn btn-xs btn-large btn-block btn-primary"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Update</button>
						</form>
					</td>
					<td>
						{{ $rooms->roomTypeDetails->name }}
					</td>
					<td>
						{{ $rooms->check_in }}
					</td>
					<td>
						{{ $rooms->check_out }}
					</td>
					<td>
						{{ number_format($rooms->room_price,2) }}
					</td>
					<td>
						{{ number_format($rooms->food_price,2)}}
					</td>
					<td>
						{{ $rooms->num_adults }}
					</td>
					<td>
						{{ $rooms->num_children }}
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<table class="table table-striped">
			<thead>
				<tr>
					<th colspan=5>Additional Transaction
						<a  data-backdrop="static"  data-keyboard="false"  class="btn btn-sm btn-primary" data-toggle="modal" href='#modal-additional-transaction'><span class="glyphicon glyphicon-glyphicon glyphicon-plus" aria-hidden="true"></span> Add Transaction</a>
					</tr>
					<tr>
						<th style="width:10%">
							#
						</th>
						<th>
							Reference Number
						</th>
						<th>
							Description
						</th>

						<th>
							Amount
						</th>
						<th>
							Created at
						</th>

					</tr>
					@if(count($booking->additionalTransaction) > 0)
					@foreach($booking->additionalTransaction as $key=>$at)
					<tr>
						<td>
							{{ $key+1 }}
						</td>
						<td>
							{{ $at->reference_no }}
						</td>
						<td>
							{{ $at->description }}
						</td>
						<td>
							{{ number_format($at->amount,2) }}
						</td>
						<td>
							{{ $at->created_at}}
						</td>
					</tr>
					@endforeach
					@else
					<tr>
						<td colspan=5 class="text-center"> No records to display.</td>
					</tr>
					@endif
				</thead>
				<tbody>

				</tbody>
			</table>

		</div>

		@endsection