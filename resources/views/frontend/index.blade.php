<!DOCTYPE html>
<html lang="">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title>Filigans Hotel</title>
	<!-- Bootstrap CSS -->

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="/asset/frontend/css/style.css">
	<link rel="stylesheet" type="text/css" href="
	https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker.css">

</head>
<body>
	<div id='page-wrapper' class='container-fluid'>
		<div class="row"><!-- 
			<div style='min-height:30px;background:red'>
			<span class="text-center">Something went wrong..</span>
		</div> -->
		<header>
			<div class="container-fluid">
				<div class="row" style='background: url("/image/full/texture4.jpg");min-height:30px'>
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
							<li class="active"><a href="http://localhost:8787">Home</a></li>
							<li><a href="http://localhost:8888/rooms">Rooms</a></li>
							<li><a href="http://localhost:8888/gallery">Gallery</a></li>
							<li><a href="http://localhost:8888/promos">Promos</a></li>
							<li><a href="http://localhost:8888/about">About</a></li>
							<li><a href="http://localhost:8888/contact">Contact</a></li>
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
	<div class="container slider top-shadow">
		<div class="row">
			<div id="slider1_container" style="visibility: hidden; position: relative; margin: 0 auto; width: 1140px; height: 442px; overflow: hidden;">

				<!-- Loading Screen -->
				<div u="loading" style="position: absolute; top: 0px; left: 0px;">
					<div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;

					background-color: #000; top: 0px; left: 0px;width: 100%; height:100%;">
				</div>
				<div style="position: absolute; display: block; background: url(img/loading.gif) no-repeat center center;

				top: 0px; left: 0px;width: 100%;height:100%;">
			</div>
		</div>

		<!-- Slides Container -->
		<div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1140px; height: 442px;
		overflow: hidden;">
		<div>
			<img u="image" src2="/image/full/slider01.jpg" />
		</div>
		<div>
			<img u="image" src2="/image/full/slider02.jpg" />
		</div>
		<div>
			<img u="image" src2="/image/full/slider03.jpg" />
		</div>
		<div>
			<img u="image" src2="/image/full/slider04.jpg" />
		</div>
	</div>
	<!-- bullet navigator container -->
	<div u="navigator" class="jssorb05" style="bottom: 16px; right: 6px;">
		<!-- bullet navigator item prototype -->
		<div u="prototype"></div>
	</div>

</div>
</div>
</header>
</div>

<div class="row home-reservation">
	<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
		<h4>Make Reservation</h4>
	</div>

	<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
		<input type='text' class='form-control datepicker' placeholder='Select check-in date'>
	</div>

	<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
		<input type='text' class='form-control datepicker' placeholder='Select check-out date'>
	</div>

	<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
		<select name="" id="input" class="form-control" required="required">
			<option value="">No. of Adults</option>
		</select>
	</div>

	<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
		<select name="" id="input" class="form-control" required="required">
			<option value="">No. of Children</option>
		</select>
	</div>

	<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
		<button type="button" class="btn btn-block btn-danger"><span class="glyphicon glyphicon-calendar" aria-hidden="true" style='color:rgb(210, 219, 149)'></span> Check Availability</button>
	</div>

</div>

<div class="row home-page-2">
	<h2 class='text-center'>HOTEL ROOMS</h2>
	<h3 class='text-center' > <small>
		<span class="glyphicon glyphicon-glyphicon glyphicon-chevron-right" aria-hidden="true"> </span>View all rooms</small> </h3>

		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 rooms">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<img src='/image/full/sample1.jpg' class='img-thumbnail img-responsive'>


			</div>
			<div class="visible-md visible-lg col-md-4 col-lg-4">
				<p>
				</p>
				<p>
					<span class="glyphicon glyphicon-glyphicon glyphicon-check" aria-hidden="true"></span> 2 Bed Rooms
				</p>
				<p>
					<span class="glyphicon glyphicon-glyphicon glyphicon-check" aria-hidden="true"></span> Maximum of 4 people
				</p>
				<p>
					<span class="glyphicon glyphicon-glyphicon glyphicon-check" aria-hidden="true"></span> 2 Bed Rooms
				</p>
				<p>
					<span class="glyphicon glyphicon-glyphicon glyphicon-check" aria-hidden="true"></span> Breakfast Included
				</p>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style='margin-top:10px;'>
				<button type="button" style='font-weight:bold' class="btn btn-lg btn-block btn-primary"><span class="glyphicon glyphicon-glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Check room details</button>
			</div>
		</div>


		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 rooms">
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<img src='/image/full/sample1.jpg' class='img-thumbnail img-responsive'>


			</div>
			<div class="visible-md visible-lg col-md-4 col-lg-4">
				<p>

				</p>
				<p>
					<span class="glyphicon glyphicon-glyphicon glyphicon-check" aria-hidden="true"></span> 2 Bed Rooms
				</p>
				<p>
					<span class="glyphicon glyphicon-glyphicon glyphicon-check" aria-hidden="true"></span> Maximum of 4 people
				</p>
				<p>
					<span class="glyphicon glyphicon-glyphicon glyphicon-check" aria-hidden="true"></span> 2 Bed Rooms
				</p>
				<p>
					<span class="glyphicon glyphicon-glyphicon glyphicon-check" aria-hidden="true"></span> Breakfast Included
				</p>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style='margin-top:10px;'>
				<button type="button" style='font-weight:bold' class="btn btn-lg btn-block btn-primary"><span class="glyphicon glyphicon-glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Check room details</button>
			</div>
		</div>

	</div>

	<div class="row home-page-3">
		<div class="container">
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<img src='/image/full/column1.jpg' class='img-responsive'>
				<h3 class='text-center'>Perfect for Relaxing</h3>
				<div style='margin:20px auto;width:100px;border:2px solid green'></div>
				<p>
					"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
				</p>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<img src='/image/full/column2.jpg' class='img-responsive'>
				<h3 class='text-center'>Elegant Room</h3>
				<div style='margin:20px auto;width:100px;border:2px solid green'></div>
				<p>
					"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
				</p>
			</div>

			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<img src='image/full/column3.jpg' class='img-responsive'>
				<h3 class='text-center'>Best for Dining</h3>
				<div style='margin:20px auto;width:100px;border:2px solid green'></div>
				<p>
					"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
				</p>
			</div>
		</div>
	</div>
	<div class="row home-page-4">
		<div class="container">
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
				<h1 class='text-center'>A little about us...</h1>	
				<div style='margin:20px auto;width:100px;border:2px solid white'></div>
				<p class='text-center'>
					Giligan’s Island Restaurant & Bar  was established in January of 1997. The name Giligan’s was derived from their father’s name “Guillermo or Guilly for short”  combined with the old TV series  Gilligan’s Island.
				</p>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">

				<p>
					Before Giligan’s was formed, the owner’s family was very busy servicing bulk food orders and offering catering services. It was all their delighted customers that convinced them to put up a restaurant where anybody can enjoy their unique quality of food whenever they want to. Soon they registered with SEC the Alquiros Food Corporation to operate and manage their business.
				</p>
				<p>
					The restaurant’s first venture on Blue Ridge, Quezon City along Katipunan Avenue was very successful. It paved the way to open their next branches. Today, Giligan’s Restaurant is operating with more than 50 branches nationwide and continue expanding.
				</p>
			</div>
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
<script type="text/javascript" src='/asset/frontend/js/slider.js'></script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js'></script>
<script type="text/javascript">
	
	$('.datepicker').datepicker({
		format: 'mm/dd/yyyy',
		startDate: '-3d'
	});

</script>
</body>
</html>