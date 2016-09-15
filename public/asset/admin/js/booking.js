app.factory("bookingFactory", ["$http","csrf", function($http, csrf){
	return {
		changeDate : function(checkin, checkout)
		{
			var data = 
			{
				check_in : checkin,
				check_out : checkout
			}
			return $http.post("/admin/booking/date", data);
		},
		resetBookingDetails : function()
		{
			return $http.get("/admin/booking/details/reset");
		},
		removeBookedRoom : function(id)
		{
			
			return $http.get("/admin/booking/details/removeroom?id="+id);
		},
		storeBooking : function(data)
		{
			
			//angular.extend(data,csrf_t);
			return $http.post("/admin/booking/",data);
		},
		getBookingDetails : function()
		{
			return $http.get("/admin/booking/details");
		},

		addToBooking : function(data)
		{
			var info = {
				room_id : data.id,
				room_type_id : data.room_type_id,
				adult : data.input_adult,
				children : data.input_children,
				food : data.input_food
			}
			return $http.post("/admin/booking/addrooms", info)
		}
	}
}])
.config(['$httpProvider', function($httpProvider) {
	$httpProvider.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
}])
.controller("bookingController", ["$scope","bookingFactory",'$timeout',"csrf", function($scope, bookingFactory,$timeout, csrf)
{
	$scope.errors = null;

	$scope.booking_details = {
		check_in : "---",
		check_out : "---",
		rooms : [],
		total_price : "00.00"
	};
	$scope.isValidCapacity = function(value1,value2, index)
	{
		value1 = parseInt(value1);
		value2 = parseInt(value2)
		value1 = isNaN(value1) ? 0 : value1;
		value2 = isNaN(value2) ? 0 : value2;
		console.log(value1,value2);
		if(isValidCapacity(value1, value2))
		{
			$scope.availablerooms[index].disable_booking = false;
		}else
		{
			$scope.availablerooms[index].disable_booking = true;
		}
	}
	var updatePrevious = function(newPrevious) {
		angular.copy(newPrevious, previous);
	};
	
	$scope.$watch("booking_details", function(newVal, oldVal)
	{
		if(newVal != oldVal)
		{
			$scope.computeChange(newVal.amount_paid, newVal.total_price);	
			console.log("new values booking details", newVal.amount_paid, newVal.total_price);
		}
	},true);
	var previous = [];
	//validate if all inputs of the booking is correct
	$scope.btnProceedBooking = function(data)
	{
		if(angular.isUndefined(data.payment_mode) || angular.isUndefined(data.change) ||  angular.isUndefined(data.customer) || (angular.isDefined(data.cutomer) && parseInt(data.cutomer) > 0))
		{
			$scope.errors = "Please fill in all the necessary fields correctly.";
		}else
		{
			$("#loader-container").fadeIn(300);
			var csrf_info =
			{
				csrf_token : csrf
			}
			angular.extend($scope.booking_details, csrf_info);
			bookingFactory.storeBooking($scope.booking_details).success(function()
			{
				$("#loader-container").fadeOut(300);
				$scope.changeDate();
				$("#modal-check-out").modal("hide");
			}).error(function()
			{

				$("#loader-container").fadeOut(300);
			});
			$scope.errors = "";

		}
	}

	$scope.submitBooking = function(event, index, values, $element)
	{
		event.preventDefault();
		$("#loader-container").fadeIn(300);
		$scope.availablerooms[index].disable_booking = true;
		bookingFactory.addToBooking(values).success(function(data)
		{
			$scope.availablerooms.splice(index,1);
			bookingFactory.getBookingDetails().success(function(data)
			{
				$scope.booking_details = angular.copy(data);

				$("#loader-container").fadeOut(300);
				console.log("booking details", data);
				console.log("booking details has been refreshed");
			}).error(function()
			{
				$scope.errors = "Failed to re initialize Reservation Details. Please refresh the page.";
				$("#loader-container").fadeOut(300);
			})
		}).error(function(data)
		{
			$scope.errors = angular.copy(data);
			$scope.availablerooms.splice(index,1);
			$("#loader-container").fadeOut(300);
		})
	}

	$scope.booking = {
		checkInDate : null,
		checkOutDate : null,
		rooms : [],
		noOfChildren: 0,
		noOfAdult:0,
		customer : null,
		additional_transaction : []
	}

	$scope.names = ["Emil", "Tobias", "Linus"];
	$scope.availablerooms = [];
	
	$scope.removeBookedRoom = function(id)
	{
		bookingFactory.removeBookedRoom(id).success(function(data)
		{
			console.log("1")
			var tmp_available_rooms = [];
			angular.forEach(data, function(value, key)
			{
				if(value.rooms.length >0)
				{
					angular.forEach(value.rooms, function(value1, key1)
					{
						tmp_available_rooms.push(value1);	
					});
					console.log("2")
					$scope.availablerooms = angular.copy(tmp_available_rooms)
				}
			})

			bookingFactory.getBookingDetails().success(function(bookingdetails){
				$scope.booking_details = angular.copy(bookingdetails);

				$("#loader-container").fadeOut(300);
			}).error(function(){
				$("#loader-container").fadeOut(300);
				$scope.errors = "Something went wrong with booking details";
			});

		}).error(function(error)
		{
			$scope.errors = angular.copy(error);
			$("#loader-container").fadeOut(300);
		})
		$("#loader-container").fadeIn(300);
	}

	$scope.proceedCheckout = function(data)
	{
		$("#modal-check-out").modal({backdrop:'static',keyboard:false, show:true});
		
	}

	$scope.availableroomtype = [
	{
		id: "all",
		name:"All Room Types"
	}];

	$scope.currentroomtype = 0;

	function computeChange(amount_paid, total_price)
	{	
		
			total_price = total_price.replace(/,/g, "");
			total_price = parseInt(total_price);
			
			console.log("change is computed", $scope.booking_details);
			if($scope.booking_details.payment_option == "partial_payment")
			{
				total_price = total_price * 0.10;
			}
			amount_paid = (isNaN(parseInt(amount_paid))) ? 0 : parseInt(amount_paid);
			$scope.booking_details.change = amount_paid - total_price;

	}


	$scope.computeChange = computeChange;
	$(".range.start").on("changeDate", function()
	{
		$scope.booking.checkInDate = $(this).datepicker("getFormattedDate");
		$scope.$apply();
	})

	$(".range.end").on("changeDate", function()
	{
		$scope.booking.checkOutDate = $(this).datepicker("getFormattedDate");
		$scope.$apply();
	})

	$("form.bookingform").on("click",function(e){
		alert("test");
		e.preventDefault();
	});

	function isValidCapacity(input1, input2)
	{
		input1 = parseInt(input1);
		input2 = parseInt(input2);

		if(!isNaN(input1) && !isNaN(input2))
		{
			var total_capacity = input1+input2;
			if(total_capacity < 1)
			{
				return false;
			}
			return true
		}
		return false;
	}

	function isValid(input)
	{
		if(isNaN(input))
		{
			
			return !input;
		}else
		{
			
			if(input==0)
			{
				return false;
			}else
			{
				return true;
			}
		}

	}

	$scope.changeDate = function()
	{
		$("#loader-container").fadeIn(300);
		bookingFactory.resetBookingDetails().success(function()
		{
			$scope.booking_details = {
				check_in : "---",
				check_out : "---",
				rooms : [],
				total_price : "00.00"
			};
			$scope.availablerooms = [];
			$("#loader-container").fadeOut(300);
			$("#step2").hide();
			$("#step1").fadeIn();
		}).error(function()
		{
			$("#loader-container").fadeOut(300);
			$scope.errors = "Can't reset booking details. Please try again.";
		});
		
	}
	$scope.checkAvailability = function(input)
	{
		if(!isValid(input.checkOutDate) && !isValid(input.checkInDate))
		{
			$("#loader-container").fadeIn(300);

			bookingFactory.changeDate(input.checkInDate, input.checkOutDate).success(function(data)
			{
				var misc_data = 
				{
					id : 0,
					name : "All Room Type",
					rooms : []
				}
				
				$scope.availableroomtype = angular.copy(data);
				angular.forEach(data, function(value, key)
				{
					if(value.rooms.length >0)
					{
						angular.forEach(value.rooms, function(value1, key1)
						{
							console.log(key1, value1)
							$scope.availablerooms.push(value1);	
						});
					}
				})
				
				$scope.errors = null;
				$("#step1").hide();
				$("#step2").fadeIn();
				bookingFactory.getBookingDetails().success(function(bookingdetails){
					$scope.booking_details = angular.copy(bookingdetails);
					console.log("data", data);

					$("#loader-container").fadeOut(300);
				}).error(function(){

					$scope.errors = "Something went wrong with booking details";
				});
				
			}).error(function()
			{

				$scope.errors = "Please fill in all the fields correctly";
				$("#loader-container").fadeOut(300);
			})
		}else
		{
			$scope.errors = "Please fill in all the fields correctly";
		}
		console.log("checking availability")
	}
}]);

// jquery side


$(".select-customer").select2({
	minimumInputLength: 2,
	tags: [],
	ajax: {
		url: '/admin/customers/search',
		dataType: 'json',
		type: "GET",
		quietMillis: 50,
		data: function (keyword) {
			return {
				keyword : keyword
			};
		},
		results: function (data) {
			return { results : data }
		}
	}
});
