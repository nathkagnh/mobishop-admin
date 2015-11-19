var name=null;
var price=null;
var manufacture=null;
var inventory_number=null;
var date=null;
var show=null;
var image=null;
var detail=null;

function loadAjax(id){
	$.ajax({
		url: 'http://nhatkhang.admin:81/ajax/create-product-step-'+id,
		data: {},
		dataType: 'text',
		method: 'GET',
		success: function(response){
			$('#create').html(response);
		},
		error: function(){
			console.log('error');
		}
	});
}

$(document).ready(function(){
	loadAjax(1);
});
function prevStep1(){
	loadAjax(1);
	$('#name').val(name);
	$('#price').val(price);
	$('#manufacture').val(manufacture);
	$('#inventory_number').val(inventory_number);
	$('#date').val(date);
	$('#show').val(show);
}
function loadStep2(){
	name=$('#name').val();
	price=$('#price').val();
	manufacture=$('#manufacture').val();
	inventory_number=$('#inventory_number').val();
	date=$('#date').val();
	show=$('#show').val();

	loadAjax(2);
}
function prevStep2(){
	loadAjax(2);
}
function loadStep3(){
	loadAjax(3);
}
function createPro(){
	
}