@extends("admin.layout.master")
@section("controller")
roomController
@endsection
@section("styles")
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
<div class="modal fade" id="modal-room">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h2 class="modal-title text-center">RM <span ng-bind="selectedRoom.room_no"></span></h2>
			</div>
			<div class="modal-body">
				<div class="alert alert-danger" ng-cloak ng-show='errorUpdate'>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Oops!</strong>Please fill up the form correctly 
				</div>
				<div class="alert alert-success" ng-show='errorUpdate==false'>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Success!</strong> You have successfully updated this room.
				</div>
				<table class="table table-hover">
					<tr >
						<td style='border:0'>
							Target Booking
						</td>
						<td style='border:0'>
							<span ng-hide="editmode" ng-bind="selectedRoom.target_booking"></span>
							<select ng-show="editmode"  id="input" class="form-control" required="required" ng-model="updateSelectedRoom.target_booking">
								<option value="online">Online Booking</option>
								<option value="walk-in">Walk-in Booking</option>
							</select>
						</td>
					</tr>
					<tr ng-show="editmode">
						<td>Room No</td>
						<td><input ng-show="editmode" type="text"  ng-model="updateSelectedRoom.room_no" class="form-control"></td>
					</tr>

					<tr>
						<td style='border:0'>
							View
						</td>
						<td style='border:0' >
							<span ng-hide="editmode" ng-bind="selectedRoom.view"></span>
							<input ng-show="editmode" type="text" class="form-control" ng-model="updateSelectedRoom.view">
						</td>
					</tr>
					<tr>
						<td >
							Room Type
						</td>
						<td>
							<span ng-hide="editmode" ng-bind="selectedRoom.room_name"></span>
							<select ng-model="updateSelectedRoom.room_type_id" id="input" class="form-control" ng-show="editmode" required="required">
								@foreach($roomtype as $rt)
								<option value="{{ $rt->id }}">{{ $rt->name }}</option>
								@endforeach
							</select>
						</td>
					</tr>
					<tr ng-hide="selectedRoom.status=='booked'">
						<td >
							Status
						</td>
						<td >
							<span ng-hide='editmode' ng-bind='selectedRoom.status'></span>
							<select ng-show='editmode' name="" id="input" ng-model='updateSelectedRoom.status' class="form-control" required="required">
								<option value="available">available</option>
								<option value="cleaning">cleaning</option>
							</select>
						</td>
					</tr>
					<tr>
						<td >
							Last Updated
						</td>
						<td ng-bind="selectedRoom.updated_at">

						</td>
					</tr>
				</table>
				<div class="alert alert-warning" ng-show="selectedRoom.status=='booked'">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Alert</strong> This room is booked today. You can't make some modification with room status.
				</div> 
			</div>
			<div class="modal-footer">
				<a class="btn pull-left btn-danger" ng-href="/admin/rooms/[[ selectedRoom.id ]]/delete"><span class="glyphicon glyphicon-glyphicon glyphicon-off" aria-hidden="true"></span> Delete this room</a>
				<button ng-hide='editmode' type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<!-- <button type="button" class="btn btn-primary">Save changes</button> -->
				<div class="btn-group" ng-show='editmode'>
					<button type="button" ng-click='edit()' class="btn btn-warning">Cancel</button>
					<button ng-click="save(updateSelectedRoom, $event, $index, $parent.index)" type="button" class="btn btn-success"><span class="glyphicon glyphicon-glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Save</button>
					
				</div>
				<button  ng-hide='editmode' ng-click="edit()" type="button" class="btn btn-warning"><span class="glyphicon glyphicon-glyphicon glyphicon-edit" aria-hidden="true"></span> Update this room</button>
			</div>
		</div>
	</div>
</div>
@endsection
@section("scripts")
<script type="text/javascript" src="/asset/admin/js/room.js"></script>

<script type="text/javascript">
	app.constant("csrf", "{{ csrf_token() }}");
</script>
@endsection
@section("content")
<div class="row">
	<hr class="hr-primary" />
	<ol class="breadcrumb bread-primary ">
		<a href="/admin/rooms" class="btn btn-primary"><i class="fa fa-bed fa-lg"></i> Room Management </a>
	</ol>
</div>
<div class="row row2">
	@include("admin.partial.notifications")
	<div class="alert alert-info" ng-cloak ng-show="loading">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Loading</strong> Please wait...
	</div>
	<div class="alert alert-warning" ng-cloak ng-show="errors">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Oops!</strong> Something went wrong, please reload the page again.
	</div>
	<div class="row row2" ng-repeat='rt in roomtype' ng-cloak>
		<header>
			<a ng-href="/admin/rooms/type/[[ rt.slug ]]"><h3 > <span ng-bind='rt.name'></span> <small><span ng-bind='rt.rooms.length'></span> total rooms</small></h3></a>

		</header>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 default-padding" ng-repeat="room in rt.rooms">
			<div class="box-tiles" ng-click='clickRoom(room, rt.name, $index, $parent.$index)' ng-class="{'success':room.status=='available', 'warning': room.status=='cleaning', 'primary': room.status=='booked' }">
				<h1><span ng-bind='room.room_no'></span> <span class="pull-left" aria-hidden="true">RM</span></h1>
				<p> For <strong ng-bind="room.target_booking"> </strong> booking.
				</div>
			</div>
			<div class="alert alert-warning" ng-cloak ng-show="rt.rooms.length < 1">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>No rooms registered in this room type.
				</div>
			</div>
			@endsection
