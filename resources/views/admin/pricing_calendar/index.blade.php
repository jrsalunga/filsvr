@extends("admin.layout.master")
@section("scripts")
<script type="text/javascript" src="/asset/admin/js/table-formatter.js"></script>
@endsection

@section("content")
<div class="row">
	<hr class="hr-primary" />
	<ol class="breadcrumb bread-primary ">
		<a href="/admin/pricing-calnedar" class="btn btn-primary"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Promo Management </a>
		<li class="active">Room Features</li>
	</ol>
</div>
<div class="row row2">
	<input type="hidden" id="csrf_token" value="{{ csrf_token() }}">
	<div id="toolbar" class="btn-group">
		<a href="/admin/pricing-calendar/create" type="button" class="btn btn-success"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Create new Promo</a>
	</div>
	<table data-toolbar="#toolbar"
	data-toggle="table"
	data-url="/admin/pricing-calendar"
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
			<th data-field="title" data-align="center" data-sortable="true" data-width="50%">Name</th>
			<th data-field="from" data-align="center" data-sortable="true" data-width="10%">From</th>
			<th data-field="to" data-align="center" data-sortable="true" data-width="10%">To</th>
			<th data-field="price" data-align="center" data-sortable="true" data-width="5%">Price</th>
			<th data-field="status" data-formatter="promoStatusFormatter" data-align="center" data-sortable="true" data-width="10%">Status</th>
			<th data-formatter="promoActionFormatter" data-events="pricingCalendarEvents" data-align="center" data-sortable="true" data-width="10%">Action</th>
		</tr>
	</thead>
</table>
</div>
@endsection