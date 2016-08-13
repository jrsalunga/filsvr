
/*initialize angular app*/
var app = angular.module('filigansApp', [], function($interpolateProvider){
	$interpolateProvider.startSymbol("[[");
	$interpolateProvider.endSymbol("]]");
}).controller("mainController", ['$scope', function($scope){

}]);

/*jquery codes here*/


$(document).ready(function()
{
	/*table initial settings*/

	$(".datepicker-input").datepicker(
	{
		format: 'yyyy-mm-dd'
	});
	function getIdSelections() {
		return $.map($("table").bootstrapTable('getSelections'), function (row) {
			return row.id
		});
	}

	$('table').on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', function (row, element) {
		$(".num-selected").text(getIdSelections().length)
		console.log(getIdSelections().length);
		if(getIdSelections().length < 1)
		{
			$(".multi-delete").fadeOut();
		}else
		{
			$(".multi-delete").fadeIn();
		}
	});
	/*end of table initial settings*/


	/*gallery page codes */
	$(".multi-delete.gallery").click(function()
	{
		
		$(".row2 alert-warning").fadeIn();
		var confirm1 = confirm("Are you sure you want to delete this?");
		if(confirm1)
		{
			$.ajax({
				url : '/admin/settings/gallery/multiple',
				data : {
					selected : getIdSelections(),
					_token : $("#csrf_token").val()
				},
				type : 'delete',
			}).done(function()
			{
				$("table").bootstrapTable('refresh');
				$(".row2 alert").hide();
				$(".row2 .alert-success").fadeIn();
				setTimeOut(function()
				{
					$(".row2 alert").fadeIn();
				},3000);

			}).fails(function()
			{
				$(".row2 alert").hide();
				$(".row2 .alert-danger").fadeIn();
				setTimeOut(function()
				{
					$(".row2 alert").fadeIn();
				},3000);
			})
		}
	});

	$("#modal-edit-caption form").submit(function(e)
	{
		$("#modal-edit-caption .alert").fadeOut();
		e.preventDefault();
		$.ajax({
			url : '/admin/settings/gallery/'+$(this).attr("data-photoid"),
			data : $(this).serialize(),
			type : 'PATCH',
		}).done(function()
		{
			refreshTable()
			$("#modal-edit-caption .alert-success").fadeIn();
			setTimeout(function()
			{
				$("#modal-edit-caption").modal("hide");
			},3000);
		}).fails(function()
		{
			$("#modal-edit-caption .alert-success").fadeIn();
		})
	})
	/*end of gallery page codes*/

	/*features page code*/
	$("#add-feature").click(function()
	{
		$("#create-feature-modal").modal("show");
	})
	$("#create-feature").click(function()
	{
		var thisObj = $(this);
		$(thisObj).attr("disabled", "disabled");
		console.log("inputs",  $("#create-feature-form").serialize());
		$.post("/admin/rooms/features", $("#create-feature-form").serialize()).done(function()
		{
			refreshTable()
			$(".feature-name").val("");
			$(".modal-success").fadeIn();

			setTimeout(function()
			{
				$(".modal-success").fadeOut();
			},3000)
			$(thisObj).removeAttr("disabled");
		}).fail(function()
		{
			$(thisObj).removeAttr("disabled");
			$(".modal-error").fadeIn();
			setTimeout(function()
			{
				$(".modal-error").fadeOut();
			},3000)

		})
	});

	function refreshTable()
	{
		$("table").bootstrapTable('refresh');
	}
	
	$("#update-feature").click(function()
	{
		var thisObj = $(this);
		$(thisObj).attr("disabled", "disabled");
		console.log($("#update-feature-form").serialize())
		$.ajax({
			url : '/admin/rooms/features/'+$("#update-feature-modal").attr("feature-id"),
			data : $("#update-feature-form").serialize(),
			type : 'PATCH',

		}).done(function(data){
			refreshTable()
			$(".feature-name").val(data);
			$(".modal-success").fadeIn();

			setTimeout(function()
			{
				$(".modal-success").fadeOut();
			},3000)
			$(thisObj).removeAttr("disabled");
		}).fail(function()
		{
			$(thisObj).removeAttr("disabled");
			$(".modal-error").fadeIn();
			setTimeout(function()
			{
				$(".modal-error").fadeOut();
			},3000)

		})
	})
	/*end of features page code*/
})

