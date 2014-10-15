$(document).ready(function() {
	$('#password_policy').submit(function(event){savePolicy(event)});
});

function savePolicy(event) {


	event.preventDefault();
	//url = $('#add_url').val();
	var len = $('#password_policy_min_length').val();
	var mixedcase = $('#password_policy_mixed_case').prop('checked');
	var numbers = $('#password_policy_numbers').prop('checked');
	var specialcharslist = $('#password_policy_special_chars_list').val();
	var specialcharacters = $('#password_policy_special_characters').prop('checked');

	var password_policy = {minlength: len, mixedcase: mixedcase, specialcharslist: specialcharslist, specialcharacters: specialcharacters, numbers: numbers};

	$.ajax({
		type: 'POST',
		url: OC.filePath('password_policy', 'ajax', 'savePolicy.php'),
		data: {password_policy: password_policy},
		success: function(data){
			if (data.status == 'success') {
				// First remove old BM if exists
				$('#save_password_policy_status').html(t('password_policy', "Policy saved."));
			}
			else {
				// First remove old BM if exists
				$('#save_password_policy_status').html(t("Error saving policy."));
			}
		}
	});
}
