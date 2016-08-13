/*action formatters*/

function featuresActionFormatter(value, row, index) {
	return [
	'<button class="btn edit btn-xs btn-warning"><span class="glyphicon glyphicon-',
	'glyphicon glyphicon-edit" aria-hidden="true" title="Update Row"></span></button>',
	'<button title class="btn remove btn-xs btn-danger"> <span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete this row"></span>'
	].join('');
}

function promoActionFormatter(value, row, index) {
	return [
	'<a href="/admin/pricing-calendar/'+row.id+'/edit" class="btn edit btn-xs btn-warning"><span class="glyphicon glyphicon-',
	'glyphicon glyphicon-edit" aria-hidden="true" title="Update Row"></span></a>',
	'<button title class="btn remove btn-xs btn-danger"> <span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete this row"></span>'
	].join('');
}

function galleryActionFormatter(value,row,index){
	return [
	'<button type="button" class="edit btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i> Edit</button>',
	'<button type="button" class="delete btn btn-sm btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>',
	].join('');
}

function userTableFormatter(value, row, index) {
	return [
	'<a class="btn btn-sm  btn-block btn-warning" href="/admin/users/'+row.id+'" title="Update" style="margin-right:5px">',
	'<i class="glyphicon glyphicon-edit"></i> Edit',
	'</a>',
	,
	].join('');
}

function previewImageFormatter(value,row, index)
{
	return [
	'<img src="/image/extra-small/'+row.image+'" width=50 height=50>',
	].join('');
}

function mealPlanFormatter(value,row, index)
{
return [
		'<a href="/admin/rooms/meal-plans/'+row.id+'/edit" title="edit" type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-glyphicon glyphicon-edit" aria-hidden="true"></span> edit</a>',
		'<button title="remove" type="button" class="btn btn-xs btn-danger remove"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> delete</button>'
		].join('');
}

function bookingFormatter(value,row, index)
{
return [
		'<a href="/admin/booking/'+row.booking_no+'" title="View this booking" type="button" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> view</a>',
		].join('');
}

function customerActionFormatter(value,row, index)
{
	return ['<a href="/admin/customers/'+row.id+'/edit" title="Update Customer" type="button" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Update Customer</a>',
		'<a href="/admin/booking?customer='+row.id+'" title="View booking history" type="button" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> View booking history</a>',
		].join('');
}


function promoStatusFormatter(value, row, index) {
	if(row.status==1)
	{
		return [
		'<span class="label label-success">active</span>',
		].join('');
	}else
	{
		return [
		'<span class="label label-warning">inactive</span>',
		].join('');
	}
}

/*action events*/
window.mealPlanEvents = {
	'click .remove' : function(e, value, row, index)
	{
		var confirm1 = confirm("Are you sure you want to delete this row?");
		if(confirm1)
		{
			$.ajax({
				url : '/admin/rooms/meal-plans/'+row.id,
				data : {
					_token : $("#csrf_token").val()
				},
				type : 'delete',
			}).done(function(){
				$("table").bootstrapTable('refresh');
			}).fails(function()
			{

			});
		}
	}
}

window.pricingCalendarEvents= 
{
	'click .remove' : function(e, value, row, index)
	{
		var confirm1 = confirm("Are you sure you want to delete this row?");
		if(confirm1)
		{
			$.ajax({
				url : '/admin/pricing-calendar/'+row.id,
				data : {
					_token : $("#csrf_token").val()
				},
				type : 'delete',
			}).done(function()
			{
				$("table").bootstrapTable('refresh');
				$(".alert-success").fadeIn();
				setTimeout(function()
				{
					$(".alert-success").fadeOut();
				},3000);
			}).error(function()
			{
				$(".alert-danger").fadeIn();
				setTimeout(function()
				{
					$(".alert-danger").fadeOut();
				},3000);

			});	
		}
	}
}
window.featureEvents = {
	'click .edit': function (e, value, row, index) {
		$("#update-feature-modal .feature-name").val(row.name)
		$("#update-feature-modal .modal-title strong").html(row.id)
		$("#update-feature-modal").attr("feature-id", row.id)
		$("#update-feature-modal").modal({
			backdrop: 'static',
			keyboard: true
		});
	},
	'click .remove': function (e, value, row, index) {
		var confirm1 = confirm("Are you sure you want to delete this row?");
		if(confirm1)
		{
			$.ajax({
				url : '/admin/rooms/features/'+row.id,
				data : {
					_token : $("#csrf_token").val()
				},
				type : 'delete',
			}).done(function()
			{
				$("table").bootstrapTable('refresh');
				$(".alert-success").fadeIn();
				setTimeout(function()
				{
					$(".alert-success").fadeOut();
				},3000);
			}).error(function()
			{
				$(".alert-danger").fadeIn();
				setTimeout(function()
				{
					$(".alert-danger").fadeOut();
				},3000);

			});	
		}
		
	}	
};

window.galleryEvents = {
	'click .edit': function(e, value, row, index)
	{
		$("#modal-edit-caption img").attr("src", "/image/avatar/"+row.image);
		$("#modal-edit-caption form").attr("data-photoid", row.id);
		$("#modal-edit-caption textarea").text(row.caption);
		$("#modal-edit-caption").modal({
			backdrop: 'static',
			keyboard: true
		});
		
	},
	'click .delete': function(e, value,row, index)
	{
		$(".row2 alert-warning").fadeIn();
		var confirm1 = confirm("Are you sure you want to delete this?");
		if(confirm1)
		{
			$.ajax({
				url : '/admin/settings/gallery/'+row.id,
				data : {
					_token : $("#csrf_token").val()
				},
				type : 'delete',
			}).done(function()
			{
				$("table").bootstrapTable('refresh');
				$(".row2 alert").hide();
				$(".row2 .alert-success").fadeIn();
				setTimeout(function()
				{
					$(".row2 alert").fadeIn();
				},3000);

			}).fails(function()
			{
				$(".row2 alert").hide();
				$(".row2 .alert-danger").fadeIn();
				setTimeout(function()
				{
					$(".row2 alert").fadeIn();
				},3000);
			})
		}
	}
}