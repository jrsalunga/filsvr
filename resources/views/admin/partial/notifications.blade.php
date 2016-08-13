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
@if(Session::has("success"))
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	<strong>Success!</strong> {!! Session::get("success") !!}
</div>
@endif	