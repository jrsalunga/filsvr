@extends("admin.layout.master")
@section("initData")
<input type="hidden" ng-init="room_id='{{ $selectedroomtype->id }}'">
@endsection
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
					<tr>
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
			</div>
			<div class="modal-footer">
				<a ng-href="/admin/rooms/[[ selectedRoom.id ]]/delete" class="btn btn-danger pull-left"><span class="glyphicon glyphicon-glyphicon glyphicon-off" aria-hidden="true"></span> Delete this room</a>
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
	app.constant("csrf", {{ csrf_token() }});
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

	<div class="alert alert-info" ng-cloak ng-show="loading">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Loading</strong> Please wait...
	</div>

	<div class="alert alert-warning" ng-cloak ng-show="errors">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<strong>Oops!</strong> Something went wrong, please reload the page again.
	</div>

	<div class="row row2 room-type" style="position:relative">
		<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
			<img src="/image/small/hotel.jpg" class="img-responsive text-center box-shadow-white" style="display:block;margin:0 auto;">
			<header class="txt-shadow-black">
				<a ng-href="javascript:void(0)"><h3 class="text-center"> Superior Rooms </h3></a>
			</header>
			<div class="dropdown">
				<button class="btn  btn-block btn-warning btn-lg dropdown-toggle" type="button" data-toggle="dropdown">Room Settings
					<span class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="/admin/rooms/type/{{ $selectedroomtype->slug }}/edit"><span class="glyphicon glyphicon-glyphicon glyphicon-edit" aria-hidden="true"></span> Update this Room</a></li>
						
						<li class="divider"></li>
						<li><a href="/admin/rooms/type/{{$selectedroomtype->slug }}/delete"><span class="glyphicon glyphicon-glyphicon glyphicon-off" aria-hidden="true"></span> Delete this room</a></li>
					</ul>
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<table class="table">
					<tr>
						<td>
							Room Name
						</td>
						<td>
							{{ $selectedroomtype->name }}
						</td>
					</tr>
					<tr>
						<td>
							Short Description
						</td>
						<td style='font-weight:normal'>
							{{ $selectedroomtype->short_description }}
						</td>
					</tr>
					
					<tr>
						<td>
							Capacity
						</td>
						<td>
							Max Adult: {{ $selectedroomtype->max_adult }} | Max Children: {{ $selectedroomtype->max_children }}
						</td>
					</tr>
					<tr>
						<td>
							Room Area
						</td>

						<td>
							{{ $selectedroomtype->room_area }} sqm
						</td>
					</tr>

					<tr>
						<td>
							Room Price
						</td>

						<td style="color:#4AED46">
							P {{ number_format($selectedroomtype->displayPrice, 2) }}
						</td>
					</tr>
					<tr>
						<td>
							Last Updated
						</td>
						<td>
							{{ $selectedroomtype->updated_at }}
						</td>
					</tr>


				</table>
			</div>
			
		</div>
		<div class="row row2"  ng-cloak>
			<header>
				<a href="javascript:void(0)"> <h5 > Rooms in this room type</h5> </a>
				<a href="/admin/rooms/create?room-type={{ $selectedroomtype->id }}" class="btn btn-primary"><span class="glyphicon glyphicon-glyphicon glyphicon-plus-sign" aria-hidden="true"></span> Add more room</a>
				<br>
				<br>
			</header>
			<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 default-padding" ng-repeat="room in roomtype.rooms">
				<div class="box-tiles" ng-click='clickRoom(room, roomtype.name, $index, $parent.$index, roomtype.id)' ng-class="{'success':room.status=='available', 'warning': room.status=='cleaning', 'primary': room.status=='booked' }">
					<h1><span ng-bind='room.room_no'></span> <span class="pull-left" aria-hidden="true">RM</span></h1>
				</div>
			</div>
			<div class="alert alert-warning" ng-cloak ng-show="roomtype.rooms.length < 1">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<strong>No rooms registered in this room type.
				</div>
			</div>
			@endsection
