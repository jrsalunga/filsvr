@extends("admin.layout.master")
@section("styles")
<style type="text/css">
	td
	{
		font-size:20px;
	}

	tr td:first-of-type
	{
		text-align:right;
		width:20%;
	}	

	.table > tbody > tr > td {
		vertical-align: middle;
	}

	.table tr:first-of-type td
	{
		border:0;
	}
	tr td:nth-of-type(2)
	{
		font-weight:bold;
	}

	.box-tiles
	{
		cursor:pointer;
	}
</style>
@endsection	
@section("scripts")
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea#full-description' });</script>
<script type="text/javascript">
	$(document).ready(function()
	{
		$(".box-tiles").click(function()
		{
			$("#modal-room").modal("show");
		})
	})
</script>
@endsection
@section("content")
<div class="row">
	<hr class="hr-primary" />
	<ol class="breadcrumb bread-primary ">
		<button href="/admin/rooms" class="btn btn-primary"><span class="glyphicon glyphicon-glyphicon glyphicon-user" aria-hidden="true"></span> Room Management </button>
		<li><a href="/admin/rooms/type/{{ $room->details->slug }}">Room Type ID: {{ $room->details->id }}</a></li>
		<li><a href="/admin/rooms/type/{{ $room->details->slug }}">Room ID : </a></li>
		<li class="active">Delete</li>
	</ol>
</div>

<div class="row row2" style="color:rgb(144, 58, 58);text-align:center">
	<span class="glyphicon glyphicon-trash" aria-hidden="true" style="font-size:100px;text-align:center"></span>
	<h1 class="text-center" style="color:rgb(144, 58, 58)"> Are you sure you want to delete this room? </h1>
	<BR><BR>
		<form method="POST" action="{{ url('admin/rooms/'.$room->id) }}">
			<input type="hidden" name="_method" value="DELETE">
			{{ csrf_field() }}
			<a href="/admin/rooms/type/{{ $room->details->slug }}" class="btn btn-danger btn-lg"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> NO</a>
			<button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> YES</button>
		</form>
		
	</div>
	@endsection