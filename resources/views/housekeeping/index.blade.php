@extends("housekeeping.layout.master")
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

@section("scripts")
<script type="text/javascript" src="/asset/housekeeping/js/room.js"></script>

<script type="text/javascript">
	app.constant("csrf", "{{ csrf_token() }}");
</script>
@endsection
@section("content")
<div class="row">
	<hr class="hr-primary" />
	<ol class="breadcrumb bread-primary ">
		<button href="#" class="btn btn-primary"><span class="glyphicon glyphicon-glyphicon glyphicon-user" aria-hidden="true"></span> Room Management </button>
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
			<a href="javascript:void(0)"><h3 > <span ng-bind='rt.name'></span> <small><span ng-bind='rt.rooms.length'></span> total rooms</small></h3></a>
		</header>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 default-padding" ng-repeat="room in rt.rooms">
			<div class="box-tiles" ng-click='clickRoom(room, rt.name, $index, $parent.$index)' ng-class="{'success':room.status=='available', 'warning': room.status=='cleaning', 'primary': room.status=='booked' }">
				<h1><span ng-bind='room.room_no'></span> <span class="pull-left" aria-hidden="true">RM</span></h1>
			</div>
		</div>
		<div class="alert alert-warning" ng-cloak ng-show="rt.rooms.length < 1">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>No rooms registered in this room type.
			</div>
		</div>
		@endsection
