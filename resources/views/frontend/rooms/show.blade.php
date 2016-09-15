@extends("frontend.layout.master")
@section("headerTitle")
Room Details
@endsection
@section("content")
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 rooms">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 item">
		<img src="/image/room-preview/{{ $room->picture }}" class='img-thumbnail img-responsive' style='width:100%'>
		<a href="javascript:void(0)"><h2  class='pull-left'>{{ $room->name }}</h2>
			<h4 class='pull-right'>Start From <span>P {{ $room->display_price }} /night</span></h4></a>

			<div class="clearfix">

			</div>
			<hr>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 features-container	">
				<div class="features-content txt-shadow-white">
					<span style='float:right' class="glyphicon glyphicon-ok" aria-hidden="true"></span>
					Max of <strong>{{ $room->max_adult }}</strong> adult
				</div>

			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 features-container	">
				<div class="features-content txt-shadow-white">
					<span style='float:right' class="glyphicon glyphicon-ok" aria-hidden="true"></span>
					Max of <strong>{{ $room->max_children }}</strong> Children
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 features-container	">
				<div class="features-content txt-shadow-white">
					<span style='float:right' class="glyphicon glyphicon-ok" aria-hidden="true"></span>
					Room Area of <strong>{{ $room->room_area }}</strong> sqm
				</div>
			</div>
			<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 features-container	">
				<div class="features-content txt-shadow-white">
					<span style='float:right' class="glyphicon glyphicon-ok" aria-hidden="true"></span>
					<strong>{{ $room->beds }}</strong> number of beds
				</div>
			</div>
			@foreach($features as $key=>$feature)
			<?php
			$column_class = "col-md-6 col-lg-6";
			if(($key+1)%2!=0 && $key+1==count($features))
			{
				$column_class = "col-md-12 col-lg-12";
			}
			$class="remove";
			foreach($room->features as $rf)
			{
				?>

				<?php
				if($rf->feature_id == $feature->id)
				{	

					$class="ok";
				}
			}
			?>
			<div class="col-xs-12 col-sm-12 {{ $column_class }} features-container	">
				<div class="features-content txt-shadow-white">
					<span style='float:right' class="glyphicon glyphicon-{{ $class }}" aria-hidden="true"></span>
					{{ $feature->name }}
				</div>

			</div>
			@endforeach

			<div class="clearfix">

			</div>
			<div>
				<!--
				<table  class="pricing table table-hover">
					<tr>
					<th colspan=7 style="text-align:center">
							Pricing Table
						</th>

					</tr>
					<tr>
						<td>
							Monday
						</td>
						<td>
							Tuesday
						</td>
						<td>
							Wednesday
						</td>
						<td>
							Thursday
						</td>
						<td>
							Friday
						</td>
						<td>
							Saturday
						</td>
						<td>
							Sunday
						</td>
					</tr>
					<tr>
						<td>
							P {{ number_format($room->displayPriceMonday,2)}}
						</td>
						<td>
							P {{ number_format($room->displayPriceTuesday,2)}}
						</td>
						<td>
							P {{ number_format($room->displayPriceWednesday,2)}}
						</td>
						<td>
							P {{ number_format($room->displayPriceThursday,2)}}
						</td>
						<td>
						P {{ number_format($room->displayPriceFriday,2)}}
						</td>
						<td>
							P {{ number_format($room->displayPriceSaturday,2)}}
						</td>
						<td>
							P {{ number_format($room->displayPriceSunday,2)}}
						</td>
					</tr>
				</table>
				-->
			</div>
			<div class='room-description'>
				{!! $room->full_description !!}
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 reservation-sidebar">
	<h3 class="text-center" style='color:#D8D25F;border-bottom:2px solid #E7E39E;padding-bottom:5px;margin-bottom:0'>YOUR RESERVATION</h3>

	<div style="padding:20px">
		<a href="/booking" class="btn btn-large btn-block btn-warning"><span class="glyphicon glyphicon-glyphicon glyphicon-calendar" aria-hidden="true"></span> Make a reservation now!</a>
		<label style="margin:10px;">Or you can also call us at <strong>{{ $contact_number }}</strong></label>

	</div>
<div style="padding:0px 20px 20px 20px">
	<p style="color:#999">
		At Filigans Hotel, good things come together to whip up a worry-free hotel experience. With great location, affordable pricing, clean and secure rooms, and the full assistance of our staff, guests are able to make the most out of their stay in Palawan. At the end of a long day, when it’s time to rest your head, our no-frills accommodation and well-trained personnel will give you more time to relax and unwind comfortably.
	</p>
	</div>
</div>
	@endsection