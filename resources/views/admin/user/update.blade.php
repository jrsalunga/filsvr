@extends("admin.layout.master")
<!-- update profile page -->
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
@endsection
@section("content")
<div class="row">
	<hr class="hr-primary" />
	<ol class="breadcrumb bread-primary ">
		<button href="#" class="btn btn-primary"><i class="fa fa-user"></i> My Account</button>
	</ol>
</div>

<div class="row row2">
	@include("admin.partial.notifications")
	<form method="POST" action="/admin/users/myprofile">
		<input type="hidden" name="_method" value="PATCH">
		{{ csrf_field() }}

		<h3> Profile Settings @if(\Auth::id() == $user->id) <small><a href="/admin/users/myprofile/account"> <span class="glyphicon glyphicon-glyphicon glyphicon-edit" aria-hidden="true"></span>Change Account settings</a></small></small> @endif </h3>
		<br>
		<table class="table table-hover">
			<tr>
				<td>
					Firstname
				</td>
				<td>
					<input name="firstname" type="text" class="form-control" value="{{ $user->firstname }}">
				</td>
			</tr>
			<tr>
				<td>
					Middlename
				</td>
				<td>
					<input name="middlename" type="text" class="form-control" value="{{ $user->middlename }}">
				</td>
			</tr>
			<tr>
				<td>
					Lastname
				</td>
				<td>
					<input name="lastname" type="text" class="form-control" value="{{ $user->lastname }}">
				</td>
			</tr>

			<tr>
				<td>
					Email Address
				</td>
				<td>
					<input name="email" type="text" class="form-control" value="{{ $user->email }}">
				</td>
			</tr>

			<tr>
				<td></td>
				<td>
					<button type="submit" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Submit</button>
				</td>
			</tr>
		</table>
	</form>
</div>
@endsection