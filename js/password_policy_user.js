$(document).ready(function() {
	$('#passwordform').after($('#password_policy').detach());
	$("#passwordbutton").bindFirst('click',function(e){
		check_password_policy(e);
	});
});

function check_password_policy(e) {
	
	var password = $('#pass2').val();
	
	$.ajax({
		type: 'POST',
		url: OC.filePath('password_policy', 'ajax', 'testPassword.php'),
		data: {password: password},
		success: function(data){
			if (data.status == 'success') {
					
				return true;	
			}
			else {
				$('#passworderror').html('Password does not comply with the Password Policy.');
				$('#passworderror').show();
				
				e.stopImmediatePropagation();
				e.stopPropagation();
				e.preventDefault();
				return false;
			}
		}
	});

}

$.fn.bindFirst = function(name, fn) {
    this.on(name, fn);

    this.each(function() {
        var handlers = $._data(this, 'events')[name.split('.')[0]];

        var handler = handlers.pop();

        handlers.splice(0, 0, handler);
    });
};