<?php
require_once("lib/PasswordGenerator.php");

\OCP\Util::addScript('password_policy', 'password_policy_user');
$tpl = new OCP\Template('password_policy', 'password_policy_user');

$minlength = OC_Password_Policy::getMinLength();

// if(OC_Password_Policy::getMixedCase())
// {
// 	$tpl->assign('mixedcase',"Must contain UPPER and lower case characters");
// }

// if(OC_Password_Policy::getNumbers())
// {
// 	$tpl->assign('numbers',"Must contain numbers");
// }

if(OC_Password_Policy::getSpecialChars())
{
	$tpl->assign('specialcharlist', OC_Password_Policy::getSpecialCharsList());
}

$tpl->assign('minlength', $minlength);

return $tpl->fetchPage();

function genpass($minlength)
{
	$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'.OC_Password_Policy::getSpecialCharsList();

	$result = PasswordGenerator::getCustomPassword(str_split($chars), $minlength);

	return $result;
}
