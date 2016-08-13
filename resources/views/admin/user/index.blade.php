@extends("admin.layout.master")
@section("scripts")
<script type="text/javascript" src="/asset/admin/js/table-formatter.js"></script>
@endsection
@section("content")
<div class="row">
	<hr class="hr-primary" />
	<ol class="breadcrumb bread-primary ">
		<button href="#" class="btn btn-primary"><span class="glyphicon glyphicon-glyphicon glyphicon-user" aria-hidden="true"></span> User Management </button>
	</ol>
</div>

<div class="row row2">
	<table data-toolbar="#toolbar"
data-toggle="table"
data-url="/admin/users"
data-pagination="true"
data-show-export="true"
data-side-pagination="server"
data-page-list="[5, 10, 20, 50, 100, 200]"
data-search="true"
data-show-refresh="true"
data-show-toggle="true"
data-show-columns="true"
data-row-style='rowStyle'
>
<thead>
	<tr>
		<!-- <th data-field="state" data-checkbox="true"></th> -->
		<th data-field="id" data-align="right" data-sortable="true" data-width="10%">User ID</th>
		<th data-field="firstname" data-align="center" data-sortable="true" data-width="15%">Firstname</th>
		<th data-field="lastname" data-align="center" data-sortable="true" data-width="15%">Lastname</th>
		
		<th data-field="email" data-align="center" data-sortable="true" data-width="20%">Email Address</th>

		<th data-field="user_type" data-width="10%" data-align="center" data-sortable="true" data-width="10%">User Type</th>
		<th data-field="created_at_str" data-width="15%" data-align="center" data-width="10%">Created at</th>
		<th data-field="price" data-formatter="userTableFormatter" data-sortable="true" data-width="20%">Action</th>
	</tr>
</thead>
</table>
</div>
@endsection