@extends("admin.layout.master")
@section("styles")
<style type="text/css">
	.alert{
		display:none;
	}
</style>
@endsection
@section("scripts")
<input type="hidden" id="csrf_token" name="csrf_token" value="{{ csrf_token() }}">
<script type="text/javascript" src="/asset/admin/js/table-formatter.js"></script>
@endsection
@section("modal")
<div class="modal fade" id="modal-edit-caption">
	<div class="modal-dialog">
		<form>
			<input type="hidden" value="patch" name="_method">
			{{ csrf_field() }}
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Update Caption</h4>
				</div>
				<div class="modal-body">
					<div class="alert alert-danger" style="display:none">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>Oops!</strong> Please fill up the form correctly.
					</div>
					<div class="alert alert-success" style="display:none">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>Success!</strong> You have successfully updated the caption of this photo.
					</div>
					<table class="table">
						<tr>
							<td style="width:20%">
								<img height=100 width=100>
							</td>
							<td style="width:80%">
								<textarea name="caption" placeholder="add some caption here" class="form-control"></textarea>
							</td>
						</tr>
					</table>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
@section("content")
<div class="row">
	<hr class="hr-primary" />
	<ol class="breadcrumb bread-primary ">
		<a href="/admin/settings/gallery" class="btn btn-primary"><span class="glyphicon glyphicon-cogs" aria-hidden="true"></span> Website Settings </a>
		<li class="active">Gallery</li>
	</ol>
</div>
<div id="toolbar">
	<a href="/admin/settings/gallery/create" class="btn btn-success"><span class="glyphicon glyphicon-
		glyphicon glyphicon-circle-arrow-up" aria-hidden="true"></span> Upload Photo</a>
		<button type="button" style="display:none" class="multi-delete gallery btn btn-danger"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete Selected(<span class="num-selected"></span>) </button>
	</div>

	<div class="row row2">
		<div class="alert alert-warning" >
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Please wait.</strong> Deletion of row in database is taking place.
		</div>
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Success!</strong> You have successfully deleted a row in database.
		</div>

		<div class="alert alert-danger" >
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Oops!</strong> Something went wrong. Please try again.
		</div>
		<table data-toolbar="#toolbar"
		data-toggle="table"
		data-url="/admin/settings/gallery"
		data-pagination="true"
		data-click-to-select="true"
		data-show-export="true"
		data-side-pagination="server"
		data-page-list="[5, 10, 20, 50, 100, 200]"
		data-search="true"
		data-maintain-selected="true"
		data-show-refresh="true"
		data-show-toggle="true"
		data-show-columns="true"
		data-row-style='rowStyle'>
		<thead>
			<tr>
				<!-- <th data-field="state" data-checkbox="true"></th> -->
				<th data-checkbox="true" data-click-to-select="true" data-align="center" data-sortable="false" data-width="5%"></th>
				<th data-field="id" data-unique-id="id"  data-align="center" data-sortable="true" data-width="10%">ID</th>
				<th data-field="firstname" data-formatter="previewImageFormatter" data-align="center" data-sortable="true" data-width="15%">Image</th>
				<th data-field="caption" data-align="left" data-sortable="true" data-width="50%">Caption</th>
				<th data-field="updated_at" data-align="center" data-sortable="true" data-width="20%">Updated At</th>
				<th data-formatter="galleryActionFormatter" data-events="galleryEvents" data-sortable="true" data-width="20%">Action</th>
			</tr>
		</thead>
	</table>
</div>
@endsection