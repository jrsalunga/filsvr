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
<script>
	var editor_config = {
		path_absolute : "/",
		selector: "#full-description",
		plugins: [
		"advlist autolink lists link image charmap print preview hr anchor pagebreak",
		"searchreplace wordcount visualblocks visualchars code fullscreen",
		"insertdatetime media nonbreaking save table contextmenu directionality",
		"emoticons template paste textcolor colorpicker textpattern"
		],
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
		relative_urls: false,
		file_browser_callback : function(field_name, url, type, win) {
			var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
			var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

			var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
			if (type == 'image') {
				cmsURL = cmsURL + "&type=Images";
			} else {
				cmsURL = cmsURL + "&type=Files";
			}

			tinyMCE.activeEditor.windowManager.open({
				file : cmsURL,
				title : 'Filemanager',
				width : x * 0.8,
				height : y * 0.8,
				resizable : "yes",
				close_previous : "no"
			});
		}
	};
	tinymce.init(editor_config);
</script>
<script type="text/javascript">


	$(document).ready(function()
	{
		document.getElementById("input-picture").onchange = function () {
			var reader = new FileReader();
			reader.onload = function (e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview-image").src = e.target.result;
    };

    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
};



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
		<a href="/admin/rooms" class="btn btn-primary"><i class="fa fa-bed fa-lg"></i> Room Management </a>
		<li class="active">Create Rooms</li>
	</ol>
</div>
<div class="row row2">
	@include("admin.partial.notifications")
	<form method="POST" action="/admin/rooms/type" enctype="multipart/form-data">
		{{ csrf_field() }}
		<table class="table table-hover">
			<tr>
				<td>
					Room Name
				</td>
				<td>
					<input name="name" type="text" class='form-control'>
				</td>
			</tr>
			<tr>
				<td>
					Short Description
					<h5><small>Maximum of 255 characters.</small></h5>
				</td>
				<td>
					<textarea name="short_description" class="form-control"></textarea>
				</td>
			</tr>
			<tr>
				<td>
					Full Description
				</td>
				<td>
					<textarea name="full_description" id='full-description' class="form-control"></textarea>
				</td>
			</tr>
			<tr>
				<td>
					Room Area
					<h5><small>In square meter</small></h5>
				</td>
				<td>
					<input name="room_area" type="text" class='form-control'>
				</td>
			</tr>
			<tr>
				<td>
				<h4>
					Max Online Booking
					<div class="clearfix">
					
					</div>
					<small style="display
					">Per day</small>
				</h4>
				</td>
				<td>
					<select name="max_online_booking" id="input" class="form-control" required="required">
						@for($i=1;$i<50;$i++)
						<option value="{{ $i }}">{{ $i }}</option>
						@endfor
					</select>
				</td>
			</tr>
			<tr>
				<td>
					Max Adult
				</td>
				<td>
					<select name="max_adult" id="input" class="form-control" required="required">
						@for($i=1;$i<10;$i++)
						<option value="{{ $i }}">{{ $i }}</option>
						@endfor
					</select>
				</td>
			</tr>
			<tr>
				<td>
					No of Beds
				</td>
				<td>
					<select name="beds" id="input" class="form-control" required="required">
						@for($i=1;$i<10;$i++)
						<option value="{{ $i }}">{{ $i }}</option>
						@endfor
					</select>
				</td>
			</tr>
			<tr>
				<td>
					Max Children
				</td>
				<td>
					<select name="max_children" id="input" class="form-control" required="required">
						@for($i=1;$i<10;$i++)
						<option value="{{ $i }}">{{ $i }}</option>
						@endfor
					</select>
				</td>
			</tr>
			<tr>
				<td>
					Meal Plan
				</td>
				<td>
					<select name="meal_plan" id="inputMeal_plan" class="form-control" required="required">
						<option value="">No Selected Meal Plan</option>
						@foreach($mealplans as $mp)
						<option value="{{ $mp->id }}"> {{ $mp->display_name }} </option>
						@endforeach
					</select> 
				</td>		  
			</tr>			  
			<tr>			  
				<td>		  
					Base Price
					<h5>
					</h5>	
				</td>		  
				<td>		  
					<input name="base_price" type="text" class="form-control">
				</td>
			</tr>
			<tr>
				<td> 
					Pricing Table
				</td>
				<td>
					<table class="table">
						<tr>
							<td style="text-align:left;width:14.28%">
								<div class="form-group">
									<label for="">Sunday</label>
									<input name="price_sunday" type="text" class="form-control" id="" placeholder="00.00">
								</div>
							</td>
							<td style="width:14.28%">
								<div class="form-group">
									<label for="">Monday</label>
									<input name="price_monday" type="text" class="form-control" id="" placeholder="00.00">
								</div>
							</td>
							<td style="width:14.28%">
								<div class="form-group">
									<label for="">Tuesday</label>
									<input name="price_tuesday" type="text" class="form-control" id="" placeholder="00.00">
								</div>
							</td>
							<td style="width:14.28%">
								<div class="form-group">
									<label for="">Wednesday</label>
									<input name="price_wednesday" type="text" class="form-control" id="" placeholder="00.00">
								</div>
							</td>

							<td style="width:14.28%">
								<div class="form-group">
									<label for="">Thursday</label>
									<input name="price_thursday" type="text" class="form-control" id="" placeholder="00.00">
								</div>
							</td>
							<td style="width:14.28%">
								<div class="form-group">
									<label for="">Friday</label>
									<input name="price_friday" type="text" class="form-control" id="" placeholder="00.00">
								</div>
							</td>
							<td style="width:14.28%">

								<div class="form-group">
									<label for="">Saturday</label>
									<input name="price_saturday" type="text" class="form-control" id="" placeholder="00.00">
								</div>
							</td>
						</tr>

					</table>
					
				</td>
			</tr>
			<tr>
				<td>Room Features</td>
				<td style="font-weight:normal">
					@if($room_features->count() < 1)
					<div class="alert alert-warning">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						There's no room features has been created yet.
					</div>
					@else
					@foreach($room_features as $rf)
					<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
						<div class="checkbox">
							<label>
								<input type="checkbox"  name='room_feature[]' value="{{ $rf->id }}">
								{{ $rf->name }}
							</label>
						</div>
					</div>
					@endforeach
					@endif
				</td>
			</tr>
			<tr>
				<td>
					Display Picture
				</td>
				<td>
					<input name="picture" id="input-picture" type="file">
				</td>
				<tr>
					<td>

					</td>

					<td>
						<img src="" id="preview-image" style="height:100px;width:100px">
					</td>

				</tr>
				<td></td>
				<td>
					<button type="submit" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-glyphicon glyphicon-log-in" aria-hidden="true"></span> Submit</button>
				</td>
			</tr>
		</table>
	</form>
</div>
@endsection
