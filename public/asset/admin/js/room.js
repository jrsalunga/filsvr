app.factory("roomFactory", ["$http", function($http, csrf){
	return {
		test : function()
		{
			alert("Test");
		},
		loadRooms : function(id)
		{
			return $http.get("/admin/rooms?room_id="+id);
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
				target_booking : value.target_booking,
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

	$scope.clickRoom = function(value,room_name, index, parentindex, selectedRoomType)
	{
		console.log(value);
		$scope.selectedRoom = angular.copy(value);
		/*if you have clicked a room type*/
		if(selectedRoomType)
		{
			$scope.selectedRoom = angular.extend($scope.selectedRoom, {"room_name" : room_name, "index" : index, "parentindex" : parentindex, "selectedRoomType" : selectedRoomType});
		}else
		{
			$scope.selectedRoom = angular.extend($scope.selectedRoom, {"room_name" : room_name, "index" : index, "parentindex" : parentindex});
		}
		
		console.log($scope.selectedRoom);
		$timeout(function()
		{
			$("#modal-room").modal({backdrop: 'static', keyboard: false})  
		},10)
	}

	$scope.save = function(data, $event)
	{
		if($scope.updateSelectedRoom.status == "booked")
		{
			console.log("confirm trigger")
			var confirmd = confirm("Changing this status will result in cancellation of current booking related to this room.")
			if(!confirmd)
			{
				return;
			}
		}

		angular.element($event.currentTarget).css("disabled","disabled");
		$(".modal-body").css("opacity","0.5");
		$(".modal-body :input").attr("disabled", "disabled");
		
		$timeout(function()
		{
			roomFactory.updateRoom(data).success(function(data)
			{
				console.log("this is a data", data);
				angular.element($event.currentTarget).removeAttr("disabled");
				$(".modal-body").css("opacity","1");
				$(".modal-body :input").removeAttr("disabled");
				$scope.errorUpdate = false;
				var tmp_var = {
					parentindex : $scope.selectedRoom.parentindex,
					index :$scope.selectedRoom.index,
					room_name : $scope.selectedRoom.room_name
				}

				$scope.selectedRoom = angular.copy(data.selected);
				$scope.selectedRoom = angular.extend($scope.selectedRoom, tmp_var)
				console.log($scope.selectedRoom);
				console.log("this is it", $scope.roomtype[$scope.selectedRoom.parentindex].rooms[$scope.selectedRoom.index])
				$scope.roomtype = angular.copy(data.allroom);
				$scope.editmode = false;
				console.log($scope.roomtype);

			}).error(function(data)
			{
				angular.element($event.currentTarget).removeAttr("disabled");
				$(".modal-body").css("opacity","1");
				$(".modal-body :input").removeAttr("disabled");
				$scope.errorUpdate = true;
			})
		},100)

}

$scope.edit = function()
{
	$scope.errorUpdate=null;
	$scope.editmode=!$scope.editmode;
	if($scope.editmode==false)
	{
		$scope.updateSelectedRoom = [];
	}
	else
	{
		$scope.updateSelectedRoom = angular.copy($scope.selectedRoom)
	}
}

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