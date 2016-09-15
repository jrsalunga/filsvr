@extends("admin.layout.master")
@section("scripts")
<script type="text/javascript" src="/asset/admin/js/table-formatter.js"></script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js'></script>
@endsection
@section("modal")
<div class="modal fade" id="create-feature-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Create new Feature</h4>
			</div>
			<div class="modal-body">
				<div style="display:none" class="modal-error alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Oops!</strong> Something went wrong. Please try again.
				</div>
				<div style="display:none" class="modal-success alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Success!</strong> Successfully saved in the database.
				</div>
				<form id='create-feature-form'>
				{{ csrf_field() }}
				<table class="table table-hover">
					<tr>
						<td>
							Feature Name
						</td>
						<td>
							<input type="text" name="name" class="feature-name form-control">
						</td>
					</tr>
				</table>

				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" id="create-feature" class="btn btn-primary">Create Feature</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="update-feature-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Update feature with ID of <strong> </strong></h4>
			</div>
			<div class="modal-body">
				<div style="display:none" class="modal-error alert alert-danger">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Oops!</strong> Something went wrong. Please try again.
				</div>
				<div style="display:none" class="modal-success alert alert-success">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<strong>Success!</strong> Successfully saved in the database.
				</div>
				<form id='update-feature-form'>
				{{ csrf_field() }}
				<table class="table table-hover">
					<tr>
						<td>
							Feature Name
						</td>
						<td>
							<input type="text" name="name" class="feature-name form-control">
						</td>
					</tr>
				</table>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" id="update-feature" class="btn btn-primary">Update Feature</button>
			</div>
		</div>
	</div>
</div>

@endsection
@section("content")
<input id="csrf_token" type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="row">
	<hr class="hr-primary" />
	<ol class="breadcrumb bread-primary ">
		<a href="/admin/rooms" class="btn btn-primary"><i class="fa fa-bed fa-lg"></i> Room Management </a>
		<li class="active">Room Features</li>
	</ol>
</div>
<div class="row row2">
<div style="display:none" class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>Success!</strong> You have successfully deleted a feature.
</div>

<div style="display:none" class="alert alert-danger">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>Oop!</strong> Something went wrong. Please try again.
</div>
	<div id="toolbar" class="btn-group">
		<button id="add-feature" type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Add Feature</button>
	</div>
	<table data-toolbar="#toolbar"
	data-toggle="table"
	data-url="/admin/rooms/features"
	data-pagination="true"
	data-show-export="true"
	data-side-pagination="server"
	data-page-list="[5, 10, 20, 50, 100, 200]"
	data-search="true"
	data-show-refresh="true"
	data-show-toggle="true"
	data-show-columns="true"
	data-row-style='rowStyle'
	data-toolbar="#toolbar"
	>
	<thead>
		<tr>
			<!-- <th data-field="state" data-checkbox="true"></th> -->
			<th data-field="id" data-align="right" data-sortable="true" data-width="5%">ID</th>
			<th data-field="name" data-align="center" data-sortable="true" data-width="80%">Name</th>
			<th data-formatter="featuresActionFormatter" data-events="featureEvents" data-align="center" data-sortable="true" data-width="15%">Action</th>
		</tr>
	</thead>
</table>
</div>
@endsection