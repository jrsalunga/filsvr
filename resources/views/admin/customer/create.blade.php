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
	$(".datepicker").datepicker({format: "yyyy-mm-dd"});
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
	<form method="POST" action="/admin/customers	">
		{{ csrf_field() }}
		<table class="table table-hover">
			<tr>
				<td>
					Firstname
				</td>
				<td>
					<input type="text" class="form-control" name="firstname" value='{{ old("firstname") }}'>
				</td>
			</tr>
			<tr>
				<td>
					Lastname
				</td>
				<td>
					<input type="text" class="form-control" name="lastname" value="{{ old('lastname') }}">
				</td>
			</tr>
			
			<tr>
				<td>
					Birthday
				</td>
				<td>
					<input  class="datepicker form-control" name="birthday" type="text" value="{{ old('birthday') }}">
				</td>
			</tr>
			
			<tr>
				<td>
					Contact No
				</td>
				<td>
					<input name="contact_no" class="form-control" type="text" value="{{ old('contact_no') }}">
				</td>
			</tr>
			
			<tr>
				<td>
					Email Address
				</td>
				<td>
					<input class="form-control" name="email" type="text" value="{{ old('email') }}">
				</td>
			</tr>
			
			<tr>
				<td>
					Address
				</td>
				<td>
					<textarea class="form-control" name="address">{{ old('address') }}</textarea>
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