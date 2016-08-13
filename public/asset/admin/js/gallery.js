var app = angular.module('filigansApp', ["angularFileUpload"], function($interpolateProvider){
	$interpolateProvider.startSymbol("[[");
	$interpolateProvider.endSymbol("]]");
}).controller("galleryController", ['$scope','FileUploader','csrf_token', function($scope, FileUploader, csrf_token){

	var uploader = $scope.uploader = new FileUploader({
		url: '/admin/settings/gallery',
		removeAfterUpload : true,
		headers: {
			'X-CSRF-TOKEN': csrf_token
		},
	});

	// FILTERS

	uploader.filters.push({
		name: 'imageFilter',
		fn: function(item /*{File|FileLikeObject}*/, options) {
			var type = '|' + item.type.slice(item.type.lastIndexOf('/') + 1) + '|';
			return '|jpg|png|jpeg|bmp|gif|'.indexOf(type) !== -1;
		}
	});

	$scope.removeitem = function(){
		alert('hey')
	}

        // CALLBACKS

        uploader.onWhenAddingFileFailed = function(item /*{File|FileLikeObject}*/, filter, options) {
        	console.info('onWhenAddingFileFailed', item, filter, options);
        };
        uploader.onAfterAddingFile = function(fileItem) {
        	console.info('onAfterAddingFile', fileItem);
        };
        uploader.onAfterAddingAll = function(addedFileItems) {
        	console.info('onAfterAddingAll', addedFileItems);
        };
        uploader.onBeforeUploadItem = function(item) {
        	console.info('onBeforeUploadItem', item);
        };
        uploader.onProgressItem = function(fileItem, progress) {
        	console.info('onProgressItem', fileItem, progress);
        };
        uploader.onProgressAll = function(progress) {
        	console.info('onProgressAll', progress);
        };
        uploader.onSuccessItem = function(fileItem, response, status, headers) {
        	console.info('onSuccessItem', fileItem, response, status, headers);
        };
        uploader.onErrorItem = function(fileItem, response, status, headers) {
        	console.info('onErrorItem', fileItem, response, status, headers);
        };
        uploader.onCancelItem = function(fileItem, response, status, headers) {
        	console.info('onCancelItem', fileItem, response, status, headers);

        };
        uploader.onCompleteItem = function(fileItem, response, status, headers) {
        	console.info('onCompleteItem', fileItem, response, status, headers);
        };
        uploader.onCompleteAll = function() {
        	//$scope.uploader.queue = [];
        	console.log('je')
        };

        console.info('uploader', uploader);


    }]);
