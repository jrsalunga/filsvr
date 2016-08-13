@extends("admin.layout.master")
@section("controller")
dashboardController
@endsection
@section("scripts")
<script>
	angular.module('filigansApp', [], function($interpolateProvider)
	{
		$interpolateProvider.startSymbol("[[");
		$interpolateProvider.endSymbol("]]");
	}).config(['$httpProvider',function($httpProvider)
	{
		$httpProvider.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
	}])
	.controller("dashboardController", ["$scope", "$http",function($scope, $http)
	{
		$scope.statistics_data = [];
		$scope.next = function(date)
		{
			
			$("#loader-container").fadeIn(300);
			$http.get("/admin?next="+date).success(function(data)
			{
				$scope.statistics_data = angular.copy(data);
				console.log($scope.statistics_data);
				$("#loader-container").fadeOut(300);
			}).error(function()
			{
				$("#loader-container").fadeOut(300);
			});
		}

		$scope.previous = function(date)
		{
			$("#loader-container").fadeIn(300);
			var input = 
			{
				date: date,
				control : "previous"
			}
			$("#loader-container").fadeIn(300);
			$http.get("/admin?previous="+date).success(function(data)
			{
				$scope.statistics_data = angular.copy(data);
				console.log($scope.statistics_data);
				$("#loader-container").fadeOut(300);
			}).error(function()
			{
				$("#loader-container").fadeOut(300);
			});
		}

		$("#loader-container").fadeIn(300);
		$http.get("/admin/").success(function(data)
		{
			$scope.statistics_data = angular.copy(data);
			console.log($scope.statistics_data);
			$("#loader-container").fadeOut(300);
		}).error(function()
		{

		});

	}])
</script>
@endsection
@section("content")
<div class="row">
	<hr class="hr-primary" />
	<ol class="breadcrumb bread-primary ">
		<button href="#" class="btn btn-primary"><i class="fa fa-newspaper-o"></i> Dashboard</button>
	</ol>
</div>
<div class="row row2">
	<h1 class='pull-right page-header'>
		<div class="btn-group" style="margin:5px">
			<button type="button" ng-click="previous(statistics_data.date)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span></button>
			<button type="button" ng-click="next(statistics_data.date)" class="btn btn-default"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span></button>
		</div>Daily Statistics <small>(<span ng-bind="statistics_data.date"> </span>)</small></h1>
		<div class="clearfix">
		</div>
		
		<div ng-show="statistics_data.date=='{{ date('Y-m-d') }}'" class="col-xs-12 col-sm-12 col-md-5 col-lg-5 default-padding">
			<div class="box-tiles info">
				<h1><span ng-bind="statistics_data.available_rooms">0 </span> <span class="glyphicon pull-left glyphicon-glyphicon glyphicon-info-sign" aria-hidden="true"></span></h1>
				<h5>Available Rooms at the moment</h5>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-7 col-lg-7 default-padding">
			<div class="box-tiles success">
				<h1><span ng-bind="statistics_data.total_revenue">0 </span> <span class="glyphicon glyphicon-ruble pull-left" aria-hidden="true"></span></h1>
				<h5>Total revenue has been made</h5>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 default-padding">
			<div class="box-tiles success">
				<h1><span ng-bind="statistics_data.checking_in">0 </span> <span class="glyphicon glyphicon-log-in pull-left" aria-hidden="true"></span></h1>
				<h5>Number of checking in</h5>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 default-padding">
			<div class="box-tiles warning">
				<h1><span ng-bind="statistics_data.checking_out">0 </span> <span class="glyphicon glyphicon-log-out pull-left" aria-hidden="true"></span></h1>
				<h5>Number of checking out</h5>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 default-padding">
			<div class="box-tiles danger">
				<h1><span ng-bind="statistics_data.cancelled_booking">0 </span> <span class="glyphicon glyphicon-info-sign pull-left" aria-hidden="true"></span></h1>
				<h5>Number of cancelled bookings</h5>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 default-padding">
			<div class="box-tiles info">
				<h1><span ng-bind="statistics_data.for_checking_out">0 </span> <span class="glyphicon glyphicon-exclamation-sign pull-left" aria-hidden="true"></span></h1>
				<h5>Bookings for checking out</h5>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 default-padding">
			<div class="box-tiles primary">
				<h1><span ng-bind="statistics_data.checking_in+statistics_data.checking_out">0 </span> <i class="fa pull-left fa-check-circle" aria-hidden="true"></i></h1>
				<h5>Success Bookings has been made</h5>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 default-padding">
			<div class="box-tiles warning">
				<h1><span ng-bind="statistics_data.pending_booking">0 </span> <span class="glyphicon pull-left glyphicon-glyphicon glyphicon-question-sign" aria-hidden="true"></span></i></h1>
				<h5>Pending Bookings</h5>
			</div>
		</div>
	</div>
	@endsection