@extends("admin.layout.master")
@section("controller") 
galleryController
@endsection
@section("styles")
<style>
	.my-drop-zone { text-align:center;border: dotted 3px lightgray; padding:70px; }
	.nv-file-over { border: dotted 3px red; } /* Default class applied to drop zones on over */
	.another-file-over-class { border: dotted 3px green; }

	html, body { height: 100%; }
</style>
@endsection
@section("scripts")
<script type="text/javascript" src="/asset/admin/js/angular-file-upload.min.js"></script>
<script type="text/javascript" src="/asset/admin/js/angular-file-upload.js"></script>

<script type="text/javascript" src="/asset/admin/js/gallery.js"></script>
<script type="text/javascript" src="/asset/admin/js/image-preview-directive.js"></script>
<script type="text/javascript">
	app.constant("csrf_token", "{{ csrf_token() }}")
</script>
<script type="text/javascript">
	$('#drag-file').click(function() {
		$('#input-file').trigger('click');
	});
</script>
@endsection

@section("content")
<div class="row">
	<hr class="hr-primary" />
	<ol class="breadcrumb bread-primary ">
		<a href="javascript:void(0)" class="btn btn-primary"><span class="glyphicon glyphicon-cogs" aria-hidden="true"></span> Website Settings </a>
		<li class=""><a href="/admin/settings/gallery">Gallery</a></li>
		<li class="active">Upload Photo</li>
	</ol>
</div>

<div class="row row2" nv-file-drop="" uploader="uploader" filters="queueLimit, customFilter">
	<input id="input-file" style="visibility:hidden;position:absolute;" type="file" nv-file-select="" uploader="uploader" multiple  /><br/>
	<div id="drag-file" ng-show="uploader.isHTML5">
		<!-- 3. nv-file-over uploader="link" over-class="className" -->
		<div class="well my-drop-zone" nv-file-over="" uploader="uploader">
			Drop your files here or click here to add select images to upload.
		</div>
	</div>
	
	<div class="uploader-container">
		
		<h3>The queue</h3>
		<p>Queue length: [[ uploader.queue.length ]]</p>

		<table class="table">
			<thead>
				<tr>
					<th width="50%">Name</th>
					<th ng-show="uploader.isHTML5">Size</th>
					<th ng-show="uploader.isHTML5">Progress</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="item in uploader.queue">
					<td>
						<strong>[[ item.file.name ]]</strong>
						<!-- Image preview -->
						<!--auto height-->
						<!--<div ng-thumb="{ file: item.file, width: 100 }"></div>-->
						<!--auto width-->
						<div ng-show="uploader.isHTML5" ng-thumb="{ file: item._file, height: 100 }"></div>
						<!--fixed width and height -->
						<!--<div ng-thumb="{ file: item.file, width: 100, height: 100 }"></div>-->
					</td>
					<td ng-show="uploader.isHTML5" nowrap>[[ item.file.size/1024/1024|number:2 ]] MB</td>
					<td ng-show="uploader.isHTML5">
						<div class="progress" style="margin-bottom: 0;">
							<div class="progress-bar" role="progressbar" ng-style="{ 'width': item.progress + '%' }"></div>
						</div>
					</td>
					<td class="text-center">
						<span ng-show="item.isSuccess"><i class="glyphicon glyphicon-ok"></i></span>
						<span ng-show="item.isCancel"><i class="glyphicon glyphicon-ban-circle"></i></span>
						<span ng-show="item.isError"><i class="glyphicon glyphicon-remove"></i></span>
					</td>
					<td nowrap>
						<button type="button" class="btn btn-success btn-xs" ng-click="item.upload()" ng-disabled="item.isReady || item.isUploading || item.isSuccess">
							<span class="glyphicon glyphicon-upload"></span> Upload
						</button>
						<button type="button" class="btn btn-warning btn-xs" ng-click="item.cancel()" ng-disabled="!item.isUploading">
							<span class="glyphicon glyphicon-ban-circle"></span> Cancel
						</button>
						<button type="button" class="btn btn-danger btn-xs" ng-click="item.remove()">
							<span class="glyphicon glyphicon-trash"></span> Remove
						</button>
					</td>
				</tr>
			</tbody>
		</table>

		<div>
			<div>
				Queue progress:
				<div class="progress" style="">
					<div class="progress-bar" role="progressbar" ng-style="{ 'width': uploader.progress + '%' }"></div>
				</div>
			</div>
			<button type="button" class="btn btn-success btn-s" ng-click="uploader.uploadAll()" ng-disabled="!uploader.getNotUploadedItems().length">
				<span class="glyphicon glyphicon-upload"></span> Upload all
			</button>
			<button type="button" class="btn btn-warning btn-s" ng-click="uploader.cancelAll()" ng-disabled="!uploader.isUploading">
				<span class="glyphicon glyphicon-ban-circle"></span> Cancel all
			</button>
			<button type="button" class="btn btn-danger btn-s" ng-click="uploader.clearQueue()" ng-disabled="!uploader.queue.length">
				<span class="glyphicon glyphicon-trash"></span> Remove all
			</button>
		</div>

	</div>
</div>
@endsection