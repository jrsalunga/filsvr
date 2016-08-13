@extends("frontend.layout.master")
@section("content")
<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 rooms">
	@foreach($rooms as $room)

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 item">
		<img src="{{ url('image/room-preview/'.$room->picture) }}" class='img-thumbnail img-responsive' style='width:100%'>	
		<a href="javascript:void(0)"><h2>{{ $room->name }}</h2></a>
		<p>
			<span class="glyphicon glyphicon-glyphicon glyphicon-check" aria-hidden="true"></span> <strong>Bed</strong> {{ $room->beds }} bed room(s)
		</p>
		<p>
			<span class="glyphicon glyphicon-glyphicon glyphicon-check" aria-hidden="true"></span> <strong>Max Children</strong> {{ $room->max_children }} bed rooms
		</p>
		<p>
			<span class="glyphicon glyphicon-glyphicon glyphicon-check" aria-hidden="true"></span> <strong>Max Adult</strong> {{ $room->max_adult }} bed rooms
		</p>
		<p>
			<span class="glyphicon glyphicon-glyphicon glyphicon-check" aria-hidden="true"></span> <strong>Room Area</strong> {{ $room->room_area }} sqm
		</p>
		<p>
		{{ $room->short_description }}
		</p>
		
		<h3>Start From <span>P {{ number_format($room->display_price) }} /night</span> <small> price varies depending on the day of booking</small></h3>
		<a href="/rooms/{{ $room->slug }}" class="btn btn-primary btn-lg ignore"><span class="glyphicon glyphicon-glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Check details</a>
	</div>
	@endforeach
</div>

<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 reservation-sidebar">
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