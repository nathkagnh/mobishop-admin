$(document).ready(function(){
	$('#user').focus();
	$('#error').css('display', 'none');
	$('#button').click(function(){
		$('#error').text('');
		$('#error').css('display', 'none');
		var valid = true;
		if($('#pass').val() == '')
		{
			$('#error').text('Vui lòng nhập Password.');
			$('#error').css('display', 'block');
			valid = false;
			$('#pass').focus();
		}
		if($('#user').val() == '')
		{
			$('#error').append('Vui lòng nhập Username.');
			$('#error').css('display', 'block');
			valid = false;
			$('#user').focus();
		}
		if(valid)
		{
			$.ajax({
				'url': url_ajax_login,
				'data': {
					'user': $('#user').val(),
					'pass': $('#pass').val()
				},
				'dataType': 'json',
				'method': 'POST',
				'success': function(response){
					switch(response['id']){
						case 1:
						$('#error').text(response['msg']);
						$('#error').css('display', 'block');
						break;
						case 2:
						$('#error').text(response['msg']);
						$('#error').css('display', 'block');
						break;
						case 3:
						$('#error').text(response['msg']);
						$('#error').css('display', 'block');
						break;
						default:
						window.location.href = '/';
						break;
					}
				},
				'error': function(){
					$('#error').text('Error!! Please try again!!');
				}
			});
		}
	});
});