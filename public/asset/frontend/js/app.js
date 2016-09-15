var app = angular.module("filigansApp", [], function($interpolateProvider)
{
	$interpolateProvider.startSymbol("[[");
	$interpolateProvider.endSymbol("]]");
}).factory("bookingFactory", ["$http","csrf", function($http, csrf){
	return {
		test : function()
		{
			alert("test");
		}
	}
	}])
.controller('mainController', ['$scope', function($scope)
{
	//default controller
}]).controller('bookingController', ['$scope','bookingFactory', function($scope, bookingFactory)
{
	bookingFactory.test();
}]);