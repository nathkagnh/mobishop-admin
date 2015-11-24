var name=null;
var price=null;
var manufacture=null;
var inventory_number=null;
var date=null;
var show=null;
var send1=false;

var images=[];

var display=null;
var os=null;
var cpu=null;
var camera=null;
var internal_memory=null;
var ram=null;
var battery=null;
var more=null;
var total_fields=0;
var send3=false;

function loadAjax(id){
	$.ajax({
		url: url_ajax + '/create-product-step-' + id,
		data: {},
		dataType: 'text',
		method: 'GET',
		success: function(response){
			$('#create').html(response);
		},
		error: function(jqXHR, textStatus, errorThrown){
			console.log('Error: ' + textStatus);
		}
	}).done(function(){
		if(id==1 && send1){
			loadDataStep1();
		}
		else if(id==2 && images!=null){
			images.forEach(function(f) {
				var reader = new FileReader();
				reader.onload = function (e) {
					$('#thumbs').append('<div class="image"><img src="' + e.target.result + '"><span class="img_remove" title="remove" data-name="' + f.name + '">&Chi;</span></div>');
				}
				reader.readAsDataURL(f);
			});
		}
		else if(send3){
			loadDataStep3();
		}
	});
}

$(document).ready(function(){
	loadAjax(1);
});

function prevStep1(){
	loadAjax(1);
}

function loadDataStep1(){
	$('#name').val(name);
	$('#price').val(price);
	$('#manufacture').val(manufacture);
	$('#inventory_number').val(inventory_number);
	$('#date').val(date);
	$('#show').val(show);
}

function setDataStep1(){
	send1=true;
	name=$('#name').val();
	price=$('#price').val();
	manufacture=$('#manufacture').val();
	inventory_number=$('#inventory_number').val();
	date=$('#date').val();
	show=$('#show').val();
}

function loadStep2(){
	setDataStep1();
	loadAjax(2);
}

function prevStep2(){
	setDataStep3();
	loadAjax(2);
}

function loadStep3(){
	loadAjax(3);
}

function loadDataStep3(){
	$('#display').val(display);
	$('#os').val(os);
	$('#cpu').val(cpu);
	$('#camera').val(camera);
	$('#internal_memory').val(internal_memory);
	$('#ram').val(ram);
	$('#battery').val(battery);
	$.each(more, function(i, obj){
		$('#table_step3').append('<tr><td><span id="field_remove" data-id="'+i+'" title="remove">&Chi;</span><input type="text" class="text_field_name" id="name'+i+'" name="field_name'+i+'" value="'+obj.name+'" placeholder="typing field name...">: </td><td><input type="text" class="text" id="field'+i+'" name="field_content'+i+'" value="'+obj.content+'" placeholder="typing content..."></td></tr>');
	});
}

function setDataStep3(){
	display=$('#display').val();
	os=$('#os').val();
	cpu=$('#cpu').val();
	camera=$('#camera').val();
	internal_memory=$('#internal_memory').val();
	ram=$('#ram').val();
	battery=$('#battery').val();
	more=[];
	var total=0;
	for(var i=0; i<total_fields; i++){
		var field_name=$("input[name='field_name"+i+"']").val();
		var content=$("input[name='field_content"+i+"']").val();
		if(field_name!=''){
			var strJson='{"name":"'+field_name+'", "content":"'+content+'"}';
			var obj=JSON.parse(strJson);
			more.push(obj);
			total++;
		}
	}
	total_fields=total;
	send3=true;
}

function createPro(){
	
}