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
		<button href="/admin/rooms" class="btn btn-primary"><i class="fa fa-bed fa-lg"></i> Room Management </button>
		<li class="active">Add Rooms</li>
	</ol>
</div>
<div class="row row2">
	@include("admin.partial.notifications")
	<form method="POST" action="/admin/rooms/">
		{{ csrf_field() }}
		<table class="table table-hover">
			<tr>
				<td>
					Room Type <span>*</span>
				</td>
				<td>
					<select name="room_type" id="input" class="form-control" required="required">
						@foreach($roomtype as $room)
						<option value="{{ $room->id }}" @if($room->id == $selectedroomtype) selected @endif> {{ $room->name }} </option>
						@endforeach
					</select>
				</td>
			</tr>
			<tr>
				<td>
					View

				</td>
				<td>
					<input type="text" name="view" class='form-control'>
				</td>
			</tr>

			<tr>
				<td>
					Room No
					<h5> <small>Must be unique</small> </h5>
				</td>
				<td>
					<input name="room_no" type="text" class='form-control'>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>

					<button type="submit" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-glyphicon glyphicon-log-in" aria-hidden="true"></span> Submit</button>
				</td>
			</tr>

		</table>
	</form>
</div>
@endsection
