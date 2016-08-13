@extends("admin.layout.master")
@section("content")
<div class="row">
	<hr class="hr-primary" />
	<ol class="breadcrumb bread-primary ">
		<button href="#" class="btn btn-primary"><i class="fa fa-cogs"></i> Website Settings</button>
		<li>
			About Page
		</li>
	</ol>
</div>

<div class="row row2">
	@include("admin.partial.notifications")
	<form action="/admin/settings/1" method="POST" role="form">
		{{ csrf_field() }}
		<input type="hidden" name="_method" value="PATCH">

		<legend>About Page</legend>
		<div class="form-group">
			<textarea name="about" class="form-control my-editor">{!! $about !!}</textarea>
		</div>
		<button type="submit" class="btn btn-primary btn-lg">Submit</button>
	</form>
</div>
@endsection
@section("scripts")
<script>
	var editor_config = {
		path_absolute : "/",
		selector: ".my-editor",
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
@stop