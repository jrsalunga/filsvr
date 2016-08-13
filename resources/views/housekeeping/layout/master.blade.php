<!DOCTYPE html>
<html lang="" ng-app="filigansApp">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield("title", "Filigans Hotel Reservation | ADMIN")</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="/asset/admin/css/style.css">
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
	@yield("styles")
</head>
@yield("initData")
<body  ng-controller="@yield('controller', 'mainController')">
	<!-- loader mask -->
	<div id="loader-container" >
		<div style='width:100%;height:100%;position:absolute;background-color:black;opacity:0.5;'>
		</div>
		<div style='padding-top:150px;width:100%;height:100%;position:absolute;color:white'>
			<center>
				<img src="/asset/images/loader.gif"> 
			</center>
			<h2 class='text-center' style=" text-shadow: 1px 1px 1px rgba(0, 0, 0, 1);">LOADING</h2>
		</div>
	</div>
	<!--  -->
	@yield("modal")
	<div class="container-fluid">
		<div class="row">
			<div class="nav-side-menu">
				<div class="brand">Filigans Admin</div>
				<div class='user-type admin'>
					You are logged in as Housekeeper
				</div>
				<div style="padding:20px;">
					<img src="/image/avatar/default-user.jpg" class='img-responsive text-center' style='margin:0 auto'>				
					<div style='width:100%;font-size:15px;color:white'>
					</div>
					<h4 class='text-center'>Jonathan Espanol</h4>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style='padding:3px;'>
						<button type="button" class="btn btn-sm btn-block btn-warning"><span class="glyphicon glyphicon-glyphicon glyphicon-cog" aria-hidden="true"></span> Account Settings </button>
					</div>
					<div style='padding:3px;' class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<button type="button" class="btn btn-sm btn-block btn-danger"><span class="glyphicon glyphicon-glyphicon glyphicon-log-out" aria-hidden="true"></span> Logout</button>
					</div>
				</div>
				<div class="clearfix">
				</div>
				<i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
				
			</div>

			<div class="col-xs-offset-0 col-sm-offset-3 col-md-offset-3 col-lg-offset-3   colcol-xs-12 col-sm-12 col-md-9 col-lg-9">
				<div class="container-fluid">
					<!-- contents here -->
					@yield("content")
				</div>
			</div>

		</div>
	</div>
</div>


<!-- jQuery -->
<script src="//code.jquery.com/jquery.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.10.1/bootstrap-table.min.js"></script>
<script type="text/javascript" src="/asset/admin/js/table.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
<script type="text/javascript" src="/asset/admin/js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
@yield("scripts")
<script type="text/javascript">
	/* check if all components is fully loaded */
	
	$(window).load(function(){
		//$('select').select2();
		setTimeout(function()
		{
			$("#loader-container").fadeOut(300);
		},10);
		
	});

	$(document).ready(function()
	{
		$(".fa.toggle-btn").click(function() {
			setTimeout(function()
			{
				$('html, body').animate({
					scrollTop: $("#menu-content").offset().top
				}, 500);
			},50)

		});
	})
</script>

</body>
</html>