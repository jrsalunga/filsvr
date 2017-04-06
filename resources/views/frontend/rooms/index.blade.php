@extends("frontend.layout.master")
@section("title")
Rooms
@endsection
@section("headerTitle")
Rooms
@endsection
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
			<span class="glyphicon glyphicon-glyphicon glyphicon-check" aria-hidden="true"></span> <strong>Max Children</strong> {{ $room->max_children }} 
		</p>
		<p>
			<span class="glyphicon glyphicon-glyphicon glyphicon-check" aria-hidden="true"></span> <strong>Max Adult</strong> {{ $room->max_adult }} 
		</p>
		<p>
			<span class="glyphicon glyphicon-glyphicon glyphicon-check" aria-hidden="true"></span> <strong>Room Area</strong> {{ $room->room_area }} sqm
		</p>
		<p>
			{{ $room->short_description }}
		</p>
		
		<h3>Start From <span>P {{ $room->display_price }} /night</span> <small> price varies depending on the day of booking</small></h3>
		<a href="/rooms/{{ $room->slug }}" class="btn btn-primary btn-lg ignore"><span class="glyphicon glyphicon-glyphicon glyphicon-chevron-right" aria-hidden="true"></span> Check details</a>
	</div>
	@endforeach
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