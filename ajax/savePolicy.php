<?php
\OCP\JSON::callCheck();
OCP\JSON::checkLoggedIn();
OCP\JSON::checkAppEnabled('password_policy');

if(isset($_POST['password_policy']) && OC_User::isAdminUser(OC_User::getUser())) {
	
	if(isset($_POST['password_policy']['minlength']))
	{
		$len = intval($_POST['password_policy']['minlength']);
		OC_Password_Policy::setMinLength($len);
	}
	
	if(isset($_POST['password_policy']['mixedcase']))
	{
		$mixed = ($_POST['password_policy']['mixedcase'] == "true")?1:0;
		
		OC_Password_Policy::setMixedCase($mixed);
	}
	
	if(isset($_POST['password_policy']['numbers']))
	{
		$numbers = ($_POST['password_policy']['numbers'] == "true")?1:0;
		
		OC_Password_Policy::setNumbers($numbers);
	}

	if(isset($_POST['password_policy']['specialcharacters']))
	{
		$special = ($_POST['password_policy']['specialcharacters'] == "true")?1:0;
		
		OC_Password_Policy::setSpecialChars($special);
	}

	if(isset($_POST['password_policy']['specialcharslist']))
	{
		
		$specialchars = ($_POST['password_policy']['specialcharslist']);
		
		OC_Password_Policy::setSpecialCharsList($specialchars);
	}

	OCP\JSON::success();
}
else
{
	OCP\JSON::error();
}

exit();