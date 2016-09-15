@extends("admin.layout.master")
@section("scripts")
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js" type"text/javascript">

</script>
@endsection

@section("styles")
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css">
@endsection
@section("content")
<div class="row">
	<hr class="hr-primary" />
	<ol class="breadcrumb bread-primary ">
		<a href="/admin/reports" class="btn btn-primary"><i class="fa fa-archive fa-lg"></i> Reports Management </a>
		<li class="active">Reports</li>
	</ol>
</div>

<div class="row row2">
	<div class="well">
		<h5 class="text-center">FILTER CONTROLS</h5>
		<form method="GET" action="?">
			<input type="hidden" ng-init="scope='monthly'">
			<table class="table table-hover">
				<tr>
					<th style="width:20%">Scope of filter</th>
					<th ng-show="scope=='monthly'">
						Month
					</th>
					<th ng-show="scope=='monthly'">
						Year
					</th>

					<th ng-show="scope=='range'">
						From
					</th>
					<th ng-show="scope=='range'">
						To
					</th>
				</tr>
				<tr>
					<td >

						<select name="scope" ng-model="scope" id="input" class="form-control" ng-init="scope='{{ $query_scope }}'" required="required">
							<option value="monthly" @if($query_scope=='monthly') selected="selected" @endif>monthly</option>
							<option value="range" @if($query_scope=='range') selected="selected" @endif>range</option>
						</select>
					</td>
					<td ng-show="scope=='monthly'">
						<select name="month" class="form-control">
							<?php
							$counter=1;
							while($counter<=12)
							{
								?>
								<option value="{{ $counter }}" @if($month==$counter) selected @endif> {{ date("F", strtotime("2016-$counter"))}} </option>
								<?php
								$counter++;
							}
							?>
						</select>
					</td>
					<td ng-show="scope=='monthly'">
						<select name="year" id="inputYear" class="form-control" required="required">
							<?php
							$counter1=1;
							while($counter1<=12)
							{
								$year1=(int) date("Y")+$counter1-12;
								?>
								<option value="{{ $year1 }}" @if($year==$year1) selected @endif>{{ $year1}}</option>
								<?php
								$counter1++;
							}
							?>
						</select>
					</td>
					<td ng-show="scope=='range'">
					<input type="text" value="{{ $from }}" class="form-control datepicker-input" name="from">
					</td>
					<td ng-show="scope=='range'">
					<input type="text" value="{{ $to }}"class="form-control datepicker-input" name="to">
					</td>
					<td>
						<button type="submit" class="btn btn-large btn-block btn-primary">button</button>
					</td>
				</table>
			</form>
		</div>
	</div>




	<div id="stocks-chart"></div>
	<?php 

	echo $lava->render('LineChart', 'MyStocks', 'stocks-chart'); ?>

	<div id="cancelled-booking"></div>
	<?php 

	echo $lava->render('LineChart', 'CancelledBooking', 'cancelled-booking'); ?>

	<div id="roomtype-chart"></div>
	<?php 

	echo $lava->render('LineChart', 'RoomType', 'roomtype-chart'); ?>

	@endsection