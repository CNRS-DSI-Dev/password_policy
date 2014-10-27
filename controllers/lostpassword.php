<?php

$tpl = new OCP\Template('password_policy', 'lostpassword');

$minlength = OC_Password_Policy::getMinLength();
$tpl->assign('minlength', $minlength);

if(OC_Password_Policy::getSpecialChars())
{
    $tpl->assign('specialcharlist', OC_Password_Policy::getSpecialCharsList());
}

echo $tpl->fetchPage();
