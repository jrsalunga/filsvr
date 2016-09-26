@extends("frontend.layout.master")
@section("styles")
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/justifiedGallery/3.6.1/css/justifiedGallery.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.swipebox/1.4.4/css/swipebox.min.css">
@endsection
@section("scripts")
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.swipebox/1.4.4/js/jquery.swipebox.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/justifiedGallery/3.6.1/js/jquery.justifiedGallery.min.js"></script>

<script src="https://npmcdn.com/masonry-layout@4.0/dist/masonry.pkgd.min.js"></script>
<script type="text/javascript">
	
	$("#gallery-container").justifiedGallery(
	{
		rowHeight : 150,
		margins: 10,

	}).on('jg.complete', function () {
		$('#gallery-container a').swipebox();
	});
	var stop = false;
	$(window).scroll(function() {
		if(stop)
			return false;
		$(".infinite-loading").fadeIn();
		if($(window).scrollTop() + $(window).height() == $(document).height()) {
			var data = 
			{
				skip : $("#gallery-container a").length,
				take : 20
			}
			$.ajax({
				url: "/gallery",
				data : data
			}).done(function(data) {
				if(data.length ==0) stop=true;
				$.each(data, function(index, value)
				{
					console.log(value.image);
					$('#gallery-container').append('<a alt="'+value.caption+'" href="/gallery-images/'+value.image+'">' +
						'<img src="/gallery-images/'+value.image+'" />' + 
						'</a>');
				})
				$(".infinite-loading").fadeOut();
			});
			
			$('#gallery-container').justifiedGallery('norewind');
		}
	});
</script>
@endsection
@section("headerTitle")
Gallery
@endsection
@section("content")
<div id="gallery-container">
	@if($gallery->count() > 0)
	@foreach($gallery as $image)
	<a href="/image/full/{{ $image->image }}">
		<img alt="{{ $image->caption }}" src="/image/gallery-thumb/{{ $image->image }}" />
	</a>
	@endforeach
	@else
	<div class="row  row2 box-shadow" style="display:none">
		<h3 class="text-center">No data to display.</h3>
	</div>
	@endif
</div>

<div class="row infinite-loading row2 box-shadow" style="display:none">
	<h3 class="text-center">Loading...</h3>
</div>

@endsection