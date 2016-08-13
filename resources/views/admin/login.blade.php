<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Title Page</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<style type="text/css">
		
		body
		{
			background : url('img/green-fibers.png');
		}

		.login-container
		{
			width:450px;
			min-height:100px;
			margin-top:70px !important;
			background-color:white;
			margin:0 auto;
			border-radius:3px;
		}

		.form-control
		{
			font-size:25px;
			height:40px;
			border:2px solid #c8c8c8;
			font-family:Open Sans, Arial;
		}

		.login-container section
		{
			padding:10px;
		}

		.login-container header .glyphicon
		{
			display:block;
			font-size:50px;
			color:#92B994;
			margin:20px 0 10px 0;
		}

		hr
		{
			border:1px solid #c8c8c8;
		}

		.login-container header
		{
			font-size:30px;
			
			padding-top:10px;
			text-align:Center;
		}

		.login-container small
		{
			display:block;
			font-size:17px;
			color:#AEAEAE;
		}

	</style>
</head>
<body>
	<div class="login-container">
		<header>
			<span class="glyphicon glyphicon-
			glyphicon glyphicon-lock" aria-hidden="true"></span>
			Sign In
			<small>
				and get started...
			</small>
			<hr>

		</header>
		@if($errors->any())
		<div class="alert alert-danger">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<strong>Oops</strong> Something went wrong!
			<ul>
				@foreach($errors->all() as $error)
				<li> {{ $error }}</li>
				@endforeach
			</ul>
		</div>
		@endif
		<section>
			<form method='POST' action='/backend/login'>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="form-group">
					<label for="">Username</label>
					<input name='username' type="text" class="form-control" id="" placeholder="Please enter your username...">
				</div>
				<div class="form-group">
					<label for="">Password</label>
					<input name='password' type="password" class="form-control" id="" placeholder="Please enter your password...">
				</div>
				<button type="submit" class="btn btn-lg btn-block btn-primary"><span class="glyphicon glyphicon-glyphicon glyphicon-log-in" aria-hidden="true"></span> LOGIN</button>
			</form>
		</form>
	</section>

</div>

<!-- jQuery -->
<script src="//code.jquery.com/jquery.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</body>
</html>