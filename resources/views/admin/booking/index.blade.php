@extends("admin.layout.master")
@section("styles")

@endsection

@section("scripts")
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js'></script>
<script type="text/javascript" src="/asset/admin/js/table-formatter.js"></script>

@endsection

@section("content")
<div class="row">
	<hr class="hr-primary" />
	<ol class="breadcrumb bread-primary ">
		<a href="/admin/booking" class="btn btn-primary"><i class="fa fa-calendar"></i> Booking Mangement</a>
		<li class="active"> Booking List </li>
	</ol>
</div>

<div class="row row2">
@if($customerDetails)
<div class="alert alert-info">
	<h4>
	<a href="/admin/customers" class="btn pull-right btn-small btn-primary"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>Go back to Customer's Page</a>
	
	You are now viewing <strong>{{ $customerDetails->firstname }} {{ $customerDetails->firstname }}(ID:{{ $customerDetails->id }})</strong> booking history
	</h4>
</div>
@endif
	<div id="toolbar" class="btn-group" style="width:100%;padding:0px">
		<div class="row">
		<form method="GET" action="/admin/booking">
			{{ csrf_field() }}
			<div style="padding: 5px 5px 5px 0" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<select name="filter" ng-init="filter='1'" ng-model="filter" name="" id="input" class="form-control" required="required">
					<option value="1">Display All</option>
					<option value="2">Today</option>
					<option value="3">Specific Date</option>
				</select>
			</div>
			<div ng-show="filter==3" style="padding: 5px 5px 5px 0" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<input type="text" name="filter_date" placeholder="pick a date" id="input" class="form-control datepicker-input" value="" ng-required="filter==3" title="">
			</div>
			<div style="padding: 5px 2px 5px 0" class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<button  type="submit" class=" btn btn-sm btn-primary"><span class="glyphicon glyphicon-glyphicon glyphicon-filter" aria-hidden="true"></span> Filter</button>
			</div>

		</div>
		
	</div>
	<table data-toolbar="#toolbar"
	data-toggle="table"
	data-url="/admin/booking?customer?={{ $customer }}&filter_date={{ $filter_date }}&filter={{  $filter }}"
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
			<th data-field="id" data-align="center" data-sortable="true" data-width="20%">ID</th>
			
			<th data-field="booking_no" data-align="center" data-sortable="true" data-width="20%">Booking Number</th>
			<th data-field="customer.full_name" data-align="center" data-sortable="true" data-width="20%">Customer</th>
			<th data-field="check_in" data-align="center" data-sortable="true" data-width="10%">Check In</th>
			<th data-field="check_out"  data-align="center" data-sortable="true" data-width="10%">Check Out</th>
			<th data-field="booking_status" data-align="center" data-sortable="true" data-width="20%">Booking Status</th>
			<th data-field	="payment_status"  data-align="center" data-sortable="true" data-width="10%">Payment Status</th>
			<th data-formatter="bookingFormatter" data-events="customerEvents" data-align="center" data-sortable="true" data-width="10%">Action</th>
		</tr>
		
	</thead>
</table>
</div>
@endsection