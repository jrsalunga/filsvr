@extends("frontend.layout.master")
@section("headerTitle")
Room
@endsection
@section("content")
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 rooms">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 item">
		<img src="/image/room-preview/{{ $room->picture }}" class='img-thumbnail img-responsive' style='width:100%'>
		<a href="javascript:void(0)"><h2  class='pull-left'>{{ $room->name }}</h2>
			<h4 class='pull-right'>Start From <span>P {{ number_format($room->display_price) }} /night</span></h4></a>

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
			</div>
			<div class='room-description'>
				{!! $room->full_description !!}
			</div>
		</div>
	</div>
	<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 reservation-sidebar ">
		<h3 class="text-center" style='color:#D8D25F;border-bottom:2px solid #E7E39E;padding-bottom:5px;margin-bottom:0'>YOUR RESERVATION</h3>
		<div class='rooms' style=''>
			<h5>Room #1 <span>Deluxe Room</span> </h5>
			<h5> 1 Adult 1 Children</h5>
			<button type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-glyphicon glyphicon-repeat" aria-hidden="true"></span> Change Room</button>
			<button type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-glyphicon glyphicon-trash" aria-hidden="true"></span> Delete Room</button>
		</div>
		<div class='rooms' style=''>
			<h5>Room #1 </h5>
		</div>
		<div style='padding:10px'>
			<div class="form-group">
				<label for="">check-in date</label>
				<input type="text" class="form-control" id="" placeholder="Input field">
			</div>
			<div class="form-group">
				<label for="">check-out date</label>
				<input type="text" class="form-control" id="" placeholder="Input field">
			</div>
			<div class="form-group">
				<label for="">Rooms</label>
				<select name="" id="input" class="form-control" required="required">
					<option value="">Number of Rooms</option>
				</select>
			</div>
			<table class="table" border=0>
				<tr>
					<td>
					</td>
					<td class='text-center'>
						<label>Adult</label>
					</td>
					<td class='text-center'>
						<label>Children</label>
					</td>
				</tr>
				<tr>
					<td>
						Room #1
					</td>
					<td>
						<select name="" id="input" class="form-control" required="required">
							<option value="">No of adults</option>
						</select>
					</td>
					<td>
						<select name="" id="input" class="form-control" required="required">
							<option value="">No of Child</option>
						</select>
					</td>
				</tr>
			</table>
		</div>
	</div>
	@endsection