<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield("title", "Filigans Hotel")</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="
	https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker.css">
	<link rel="stylesheet" type="text/css" href="/asset/frontend/css/style.css">
	
	<style type="text/css">
		.nav li.active
		{
			font-weight:bold;
		}
		.main-content .rooms a:hover:not(.ignore)
		{
			color:#E5AD66;
		}
		.main-content .rooms a:not(.ignore)
		{
			color:#ad977b;
		}
	</style>
	@yield("styles")
</head>
<body>
	<div id='page-wrapper' class='container-fluid'>
		<div class="row"><!-- 
			<div style='min-height:30px;background:red'>
			<span class="text-center">Something went wrong..</span>
		</div> -->
		<header class='header'>
			<div class="container-fluid">
				<div class="row" style='background: url(http://localhost:8787/images/background/texture4.jpg);min-height:30px'>
					<div class="container">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style='padding:0px'>
							<a  href='http://localhost:8787/booking' class="btn btn-xs btn-success pull-right" style='margin:5px;margin-left:10px'>RESERVE ROOM</a>
							<span style='color:white;font-size:20px;font-family:Open Sans' class='pull-right'>Call us at 8700 for inquiry</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="navbar navbar-default hidden-xs hidden-sm" role="navigation">
						<div class="container">
							<div style='height:100px;width:300px;background:url(http://localhost:8787/images/background/texture2.jpg) black;position:absolute;top:-33px;padding:15px;padding-top:0px;-webkit-box-shadow: 0px 3px 18px -1px rgba(0,0,0,0.75);
							-moz-box-shadow: 0px 3px 18px -1px rgba(0,0,0,0.75);
							box-shadow: 0px 3px 18px -1px rgba(0,0,0,0.75);'>
							<a href='http://localhost:8787'><img src="http://www.giligansrestaurant.com/site/images/gililogo.png"></a>
						</div>
						<!-- Brand and toggle get grouped for better mobile display -->
						<ul class="nav navbar-nav navbar-right">

							<li class='@if(Session::get("current_page", "") == "home") active @endif'><a href="{{ url('/') }}">Home</a></li>
							<li class='@if(Session::get("current_page", "") == "rooms") active @endif'><a href="{{ url('rooms') }}">Rooms</a></li>
							<li class='@if(Session::get("current_page", "") == "gallery") active @endif'><a href="{{ url('gallery') }}">Gallery</a></li>
							<li class='@if(Session::get("current_page", "") == "promos") active @endif'><a href="{{ url('promos') }}">Promos</a></li>
							<li class='@if(Session::get("current_page", "") == "about") active @endif'><a href="{{ url('about') }}">About</a></li>
							<li class='@if(Session::get("current_page", "") == "contact") active @endif'><a href="{{ url('contact') }}">Contact</a></li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</div>
			</div>
			<nav class="navbar navbar-default visible-xs visible-sm" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div style='height:100px;width:100%;background:url(http://localhost:8787/images/background/texture2.png) black;padding-left:20px;padding-top:0px;-webkit-box-shadow: 0px 3px 18px -1px rgba(0,0,0,0.75);
				-moz-box-shadow: 0px 3px 18px -1px rgba(0,0,0,0.75);
				box-shadow: 0px 3px 18px -1px rgba(0,0,0,0.75);'>
				<a href='http://localhost:8787'><img class='img-responsive' src="http://www.giligansrestaurant.com/site/images/gililogo.png"></a>
			</div>
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Giligans Hotel</a>
			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Home</a></li>
					<li><a href="#">Rooms</a></li>
					<li><a href="#">Features and Services</a></li>
					<li><a href="#">About</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
			</div>
		</nav>
	</div>
	<!-- slider -->
	<h1 class='text-center txt-shadow-white' style='margin:0;padding:50px;color:white;font-family:Open Sans, Arial'> @yield("headerTitle", "FILIGANS HOTEL") </h1>
</header>
</div>
<div class="row main-content">
	<div class="container">
		@yield("content")
	</div>
</div>

</div>
<footer class="site-footer">
	Filigans hotel 2016
</footer>

<!-- jQuery -->
<script src="//code.jquery.com/jquery.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="/asset/frontend/js/jssor.slider.mini.js"></script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js'></script>
<script type="text/javascript" src='/asset/frontend/js/slider.js'></script>
<script type="text/javascript" src="/asset/frontend/js/main.js"></script>
<script type="text/javascript">
	
	$('.datepicker').datepicker({
		format: 'mm/dd/yyyy',
		startDate: '-3d'
	});
</script>
@yield("scripts")
</body>
</html>