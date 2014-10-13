<?php

// Look up other security checks in the docs!
\OCP\App::checkAppEnabled('password_policy');
OC_Util::checkAdminUser();
\OCP\Util::addScript('password_policy', 'password_policy_admin');

$tpl = new OCP\Template("password_policy", "password_policy_admin");

$minlength = OC_Password_Policy::getMinLength();
$mixedcase = OC_Password_Policy::getMixedCase();
$mixedcase = ($mixedcase==1)?"checked":"";
$numbers = OC_Password_Policy::getNumbers();
$numbers = ($numbers==1)?"checked":"";
$specialcharacters = OC_Password_Policy::getSpecialChars();
$specialcharacters = ($specialcharacters==1)?"checked":"";
$specialcharslist = OC_Password_Policy::getSpecialCharsList();

$tpl->assign('numbers', $numbers);
$tpl->assign('minlength', $minlength);
$tpl->assign('mixedcase', $mixedcase);
$tpl->assign('specialcharacters', $specialcharacters);
$tpl->assign('specialcharslist', $specialcharslist);

return $tpl->fetchPage();
