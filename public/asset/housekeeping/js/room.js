app.factory("roomFactory", ["$http", function($http, csrf){
	return {
		test : function()
		{
			alert("Test");
		},
		loadRooms : function(id)
		{
			return $http.get("/housekeeping/rooms?room_id="+id);
		},
		loadSpecificRoom : function(selected)
		{
			return $http.get("/admin/rooms?selected="+selected);
		},
		updateRoom : function(value)
		{

			var data = 
			{
				name : value.room_name,
				id : value.id,
				room_no : value.room_no,
				view : value.view,
				status : value.status,
				room_type : value.room_type_id
			}
			if(value.selectedRoomType)
			{

				data = angular.extend({selectedRoomType : value.selectedRoomType}, data);
			}
			return $http.patch("/admin/rooms/"+value.id, data);
		}
	}
}])
.config(['$httpProvider', function($httpProvider) {
	$httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
}])
.controller("roomController", ["$scope","roomFactory",'$timeout', function($scope, roomFactory,$timeout)
{
	$scope.$watch('room_id',function(newVal, oldVal)
	{
		if(angular.isUndefined(newVal))
		{
			loadRooms()	
		}else
		{
			loadRooms(newVal)
		}
		
	})



	
	/*initial data*/
	$scope.roomtype = [];
	$scope.selectedRoom = [];
	$scope.editmode = false;
	$scope.updateSelectedRoom = [];
	$scope.errorUpdate=null;

function loadRooms(selected)
{	

	selected = (selected==null) ? "": selected;
	$scope.loading = true;
	roomFactory.loadRooms(selected).success(function(data)
	{
		$scope.loading=false;
		$scope.roomtype = angular.copy(data);

	}).error(function()
	{
		$scope.loading=false;
		$scope.errors=true;
	});	
}



}]);