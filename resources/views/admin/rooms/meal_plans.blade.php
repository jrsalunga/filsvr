@extends("admin.layout.master")
@section("scripts")
<script type="text/javascript" src="/asset/admin/js/table-formatter.js"></script>
@endsection
@section("content")
<input type="hidden" id="csrf_token" value="{{ csrf_token() }}" name="csrf_token">

<div class="row">
	<hr class="hr-primary" />
	<ol class="breadcrumb bread-primary ">
		<a href="/admin/rooms" class="btn btn-primary"><span class="glyphicon glyphicon-glyphicon glyphicon-user" aria-hidden="true"></span> Room Management </a>
		<li class="active">Meal Plans</li>
	</ol>
</div>


<div id="toolbar" class="btn-group">
<a href="/admin/rooms/meal-plans/create"  type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create Meal Plans</a>
</div>
<table data-toolbar="#toolbar"
data-toggle="table"
data-url="/admin/rooms/meal-plans"
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
		<th data-field="name" data-align="center" data-sortable="true" data-width="50%">Name</th>
		<th data-field="price" data-align="center" data-sortable="true" data-width="30%">Price Per Person</th>
		<th data-formatter="mealPlanFormatter" data-events="mealPlanEvents" data-align="center" data-sortable="true" data-width="15%">Action</th>
	</tr>
</thead>
</table>
@endsection