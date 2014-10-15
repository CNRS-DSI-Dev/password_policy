<?php
\OCP\JSON::callCheck();
OCP\JSON::checkLoggedIn();
OCP\JSON::checkAppEnabled('password_policy');

if(isset($_POST['password'])) {
	
	if(!OC_Password_Policy::testPassword($_POST['password']))
	{
		OCP\JSON::error();
	}
	else
	{
		OCP\JSON::success();
	}
}
else
{
	OCP\JSON::error();
}

exit();