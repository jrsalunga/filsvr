@extends("admin.layout.master")
@section("scripts")
<script type="text/javascript" src="/asset/admin/js/table-formatter.js"></script>
@endsection
@section("content")
<div class="row">
	<hr class="hr-primary" />
	<ol class="breadcrumb bread-primary ">
		<a href="/admin/customer" class="btn btn-primary"><span class="glyphicon glyphicon-users" aria-hidden="true"></span> Customer Management </a>
		<li class="active"> Customer Index</li>
	</ol>
</div>
<div class="row row2">
	<div id="toolbar" class="btn-group">
		<a href="/admin/customers/create" type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create new Customer</a>
	</div>
	<table data-toolbar="#toolbar"
	data-toggle="table"
	data-url="/admin/customers"
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
			<th data-field="firstname" data-align="center" data-sortable="true" data-width="20%">firstname</th>
			<th data-field="lastname" data-align="center" data-sortable="true" data-width="20%">lastname</th>
			<th data-field="contact_no" data-align="center" data-sortable="true" data-width="10%">Contact#</th>
			<th data-field="birthday"  data-align="center" data-sortable="true" data-width="10%">Birthday</th>
			<th data-field="address" data-align="center" data-sortable="true" data-width="20%">Address</th>
			<th data-field	="email"  data-align="center" data-sortable="true" data-width="10%">Email</th>
			<th data-formatter="customerActionFormatter" data-events="customerEvents" data-align="center" data-sortable="true" data-width="10%">Action</th>
		</tr>
	</thead>
</table>
</div>
@endsection