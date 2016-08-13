@extends("admin.layout.master")
@section("styles")
<style type="text/css">
	td
	{
		font-size:20px;
	}
	tr td:first-of-type
	{
		text-align:right;
		width:20%;

	}	

	.table > tbody > tr > td {
		vertical-align: middle;
	}


	.table tr:first-of-type td
	{
		border:0;
	}
	tr td:nth-of-type(2)
	{
		font-weight:bold;
	}
	
	.box-tiles
	{
		cursor:pointer;
	}
</style>
<link rel="stylesheet" type="text/css" href="
https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker.css">

@endsection
@section("scripts")
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>
<script type="text/javascript" src="/asset/admin/js/table-formatter.js"></script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js'></script>
<script type="text/javascript">
	$('.range-container').datepicker({
		inputs: $('.range'),
		format: "yyyy-mm-dd"
	});

	$(".range.start").on("changeDate", function()
	{
		$("#from").val($('.range.start').datepicker("getFormattedDate"));
	})

	$(".range.end").on("changeDate", function()
	{
		$("#to").val($('.range.end').datepicker("getFormattedDate"));
	})

</script>
@endsection
@section("content")
<div class="row">
	<hr class="hr-primary" />
	<ol class="breadcrumb bread-primary ">
		<a href="/admin/promos" class="btn btn-primary"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Promo Management </a>
		<li class="active">Create new Promo</li>
	</ol>
</div>
<div class="row row2">
	@include("admin.partial.notifications")
	<form method="POST" action="/admin/pricing-calendar">
		{{ csrf_field() }}
		<table class="table table-hover">
			<tr>
				<td>
					Title
				</td>
				<td>
					<input type="text" class="form-control" name="title">
				</td>
			</tr>
			<tr>
				<td>
					Description
				</td>
				<td>
					<textarea name="description" class="form-control text-area"></textarea>
				</td>
			</tr>
			<tr>
				<td>
					Duration
				</td>
				<td>
					<div class="range-container">

						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<input type="hidden" name="from" id="from">
							<h4 class='txt-shadow-black' style='color:rgb(112, 186, 112)'>
								From
							</h4>
							<div class=" range start"></div>
						</div>

						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
							<input type="hidden" name="to" id="to">
							<h4 class='txt-shadow-black' style='color:rgb(112, 186, 112)'>
								To
							</h4>
							<div class=" range end"></div>
						</div>	
					</div>
				</td>
			</tr>
			
			<tr>
				<td>
					Price

				</td>
				<td>
					<input type="text" class="form-control" name="price">
				</td>
			</tr>
			<tr>
				<td>
					Target
					<h5> <small>Please select rooms in this input </small>
					</td>
					<td>
						<select name="target" id="input" class="form-control" required="required">
							@foreach($roomtype as $rt)
							<option value="{{ $rt->id }}">{{ $rt->name }}</option>
							@endforeach
						</select>
					</td>
				</tr>
				<tr>
					<td>
						Status
					</td>
					<td>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="status" value="1">
								Set to Active
							</label>
						</div>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<button type="submit" class="btn btn-lg btn-primary">Submit</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
	@endsection