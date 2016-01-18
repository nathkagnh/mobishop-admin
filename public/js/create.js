function showStep(id){
	$('#step'+id).css({display: 'block'});
}

function hideStep(id){
	$('#step'+id).css({display: 'none'});
}

function showStep1(){
	showStep(1);
	hideStep(2);
	hideStep(3);
}

function showStep2(){
	showStep(2);
	hideStep(1);
	hideStep(3);
}

function showStep3(){
	showStep(3);
	hideStep(1);
	hideStep(2);
}

// Show step 1 (default)
showStep1();

// This is script of step 2
$(document).on('change', 'input[name="img_upload[]"]', function(e){
	var current = curr = $('#files').data('current');

	var reader = new FileReader();
	reader.onload = function(event){
		$('#thumbs').append('<div class="block-image">'
			+'<img src="'+event.target.result+'" class="thumbs">'
			+'<span class="delete-image" data-id="'+curr+'"></span>'
			+'</div>'
			);
	};
	reader.readAsDataURL(e.target.files[0]);

	$(this).css({display: 'none'});
	current++;
	$('#files').append('<input type="file" id="image'+current+'" data-id="'+current+'" name="img_upload[]" accept="image/*" style="display: inline;">');
	$('#files').data('current', current);
});

$(document).on('click', '.delete-image', function(e){
	var id = $(this).data('id');
	$(this).parent().fadeOut(150, function(){
		$(this).remove();
	});
	$('#image'+id).remove();
});

// This is script of step 3
var current_field = total_field = 0;
var arrFieldId = [];
$('#add_field').click(function(){
	if(current_field==0){
		$('#table_step3').append('<tr><td><span id="field_remove" data-id="'+current_field+'" title="remove"></span><input type="text" class="text_field_name" id="name'+current_field+'" name="field_name'+current_field+'" placeholder="typing field name...">: </td><td><input type="text" class="text" id="field'+current_field+'" name="field_content'+current_field+'" placeholder="typing content..."></td></tr>');
		arrFieldId.push(0);
		current_field++;
	}
	else if(current_field>0){
		if($("input[name='field_name"+(current_field-1)+"']").val()=='' && $("input[name='field_name"+(current_field-1)+"']").parent().parent().css('display')!='none')
			$("input[name='field_name"+(current_field-1)+"']").focus();
		else if($("input[name='field_content"+(current_field-1)+"']").val()=='' && $("input[name='field_content"+(current_field-1)+"']").parent().parent().css('display')!='none')
			$("input[name='field_content"+(current_field-1)+"']").focus();
		else{
			$('#table_step3').append('<tr><td><span id="field_remove" data-id="'+current_field+'" title="remove"></span><input type="text" class="text_field_name" id="name'+current_field+'" name="field_name'+current_field+'" placeholder="typing field name...">: </td><td><input type="text" class="text" id="field'+current_field+'" name="field_content'+current_field+'" placeholder="typing content..."></td></tr>');
			arrFieldId.push(current_field);
			current_field++;
		}
	}
});
$(document).on('click', '#field_remove', function(){
	var id=$(this).data('id');
	$(this).parent().parent().fadeOut(150, function(){
		$(this).remove();
		arrFieldId.pop(id);
	});
});

// Create product
function createPro(url){
	// Form data
	var formData = new FormData();

	// Data of step 1:
	formData.append('name', $('#name').val());
	formData.append('price', $('#price').val());
	formData.append('manufacture', $('#manufacture').val());
	formData.append('inventory_number', $('#inventory_number').val());
	formData.append('date', $('#date').val());
	formData.append('show', $('#show').val());

	// Data of step 2:
	var images = $('input[name="img_upload[]"]');
	var imgTotal = images.length-1;
	for(var i=0; i<imgTotal; i++){
		formData.append('image_'+i, images[i].files[0]);
	}
	formData.append('imgTotal', imgTotal);

	// Data of step 3:
	formData.append('display', $('#display').val());
	formData.append('os', $('#os').val());
	formData.append('cpu', $('#cpu').val());
	formData.append('camera', $('#camera').val());
	formData.append('internal_memory', $('#internal_memory').val());
	formData.append('ram', $('#ram').val());
	formData.append('battery', $('#battery').val());

	var arrTemp = {};
	arrFieldId.forEach(function(index){
		arrTemp[$('input[name="field_name'+index+'"]').val()]=$('input[name="field_content'+index+'"]').val();
	});

	formData.append('more', JSON.stringify(arrTemp));

	$.ajax({
		url: url,
		method: 'POST',
		data: formData,
		dataType: "text",
		success: function(response){
			$('#step3').hide();
			$('#message').html('<center>' + response + '</center>');
		},
		error: function( jqXHR, textStatus, errorThrown){
			$('#message').html('<center>' + textStatus + '</center>');
			$('#step3').hide();
		},
		processData: false, // tell jQuery not to process the data
		contentType: false 	// tell jQuery not to set contentType
	});
};