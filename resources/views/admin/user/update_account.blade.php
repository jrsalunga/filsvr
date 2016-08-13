@extends("admin.layout.master")
<!-- update account settings page -->
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
		<button href="#" class="btn btn-primary"><i class="fa fa-user"></i> My Profile</button>
		
	</ol>
</div>

<div class="row row2">
	@include("admin.partial.notifications")
	<form method="POST" action="/admin/users/myprofile/account">
		<input type="hidden" name="_method" value="PATCH">
		{{ csrf_field() }}

		<h3> Account Settings <small><a href="/admin/users/myprofile/"> <span class="glyphicon glyphicon-glyphicon glyphicon-edit" aria-hidden="true"></span>Change Profile settings</a></small></small></h3>
		<br>
		<table class="table table-hover">
			<tr>
				<td>
					Username
				</td>
				<td>
					<input name="username" type="text" class="form-control" value="{{ $user->username }}">
				</td>
			</tr>
			<tr>
				<td>
					Password

					<button ng-show="changepassword" ng-click="changepassword=false" type="button" class="btn btn-xs btn-default">Cancel Password Change</button>
				</td>
				<td>
				<button ng-click="changepassword=true" ng-hide="changepassword" type="button" class="btn btn-xs btn-warning">Change Password</button>
					<input ng-show="changepassword" name="password" type="password" class="form-control">
				</td>
			</tr>
			<tr ng-show="changepassword">
				<td>
					Confirm Password
				</td>
				<td>
					<input name="password_confirmation" type="password" class="form-control">
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