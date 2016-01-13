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

// This is script of step 3
var total_fields = 0;
$('#add_field').click(function(){
	if(total_fields==0){
		$('#table_step3').append('<tr><td><span id="field_remove" data-id="'+total_fields+'" title="remove">&Chi;</span><input type="text" class="text_field_name" id="name'+total_fields+'" name="field_name'+total_fields+'" placeholder="typing field name...">: </td><td><input type="text" class="text" id="field'+total_fields+'" name="field_content'+total_fields+'" placeholder="typing content..."></td></tr>');
		total_fields++;
	}
	else if(total_fields>0){
		if($("input[name='field_name"+(total_fields-1)+"']").val()=='' && $("input[name='field_name"+(total_fields-1)+"']").parent().parent().css('display')!='none')
			$("input[name='field_name"+(total_fields-1)+"']").focus();
		else if($("input[name='field_content"+(total_fields-1)+"']").val()=='' && $("input[name='field_content"+(total_fields-1)+"']").parent().parent().css('display')!='none')
			$("input[name='field_content"+(total_fields-1)+"']").focus();
		else{
			$('#table_step3').append('<tr><td><span id="field_remove" data-id="'+total_fields+'" title="remove">&Chi;</span><input type="text" class="text_field_name" id="name'+total_fields+'" name="field_name'+total_fields+'" placeholder="typing field name...">: </td><td><input type="text" class="text" id="field'+total_fields+'" name="field_content'+total_fields+'" placeholder="typing content..."></td></tr>');
			total_fields++;
		}
	}
});
$(document).on('click', '#field_remove', function(){
	var id=$(this).data('id');
	$("input[name='field_name"+id+"']").val('');
	$(this).parent().parent().fadeOut(150);
});
$('#add_field').click(function(){
	if(total_fields==0){
		$('#table_step3').append('<tr><td><span id="field_remove" data-id="'+total_fields+'" title="remove">&Chi;</span><input type="text" class="text_field_name" id="name'+total_fields+'" name="field_name'+total_fields+'" placeholder="typing field name...">: </td><td><input type="text" class="text" id="field'+total_fields+'" name="field_content'+total_fields+'" placeholder="typing content..."></td></tr>');
		total_fields++;
	}
	else if(total_fields>0){
		if($("input[name='field_name"+(total_fields-1)+"']").val()=='' && $("input[name='field_name"+(total_fields-1)+"']").parent().parent().css('display')!='none')
			$("input[name='field_name"+(total_fields-1)+"']").focus();
		else if($("input[name='field_content"+(total_fields-1)+"']").val()=='' && $("input[name='field_content"+(total_fields-1)+"']").parent().parent().css('display')!='none')
			$("input[name='field_content"+(total_fields-1)+"']").focus();
		else{
			$('#table_step3').append('<tr><td><span id="field_remove" data-id="'+total_fields+'" title="remove">&Chi;</span><input type="text" class="text_field_name" id="name'+total_fields+'" name="field_name'+total_fields+'" placeholder="typing field name...">: </td><td><input type="text" class="text" id="field'+total_fields+'" name="field_content'+total_fields+'" placeholder="typing content..."></td></tr>');
			total_fields++;
		}
	}
});
$(document).on('click', '#field_remove', function(){
	var id=$(this).data('id');
	$("input[name='field_name"+id+"']").val('');
	$(this).parent().parent().fadeOut(150);
});