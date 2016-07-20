<?php

/**
 * ownCloud - password
 *
 * This file is licensed under the Affero General Public License version 3 or
 * later. See the COPYING file.
 *
 * @author Patrick Paysant / CNRS <ppaysant@linagora.com>
 * @copyright Patrick Paysant / CNRS 2016
 */

// Look up other security checks in the docs!
\OCP\App::checkAppEnabled('password_policy');
OC_Util::checkAdminUser();

$tpl = new OCP\Template("password_policy", "settings-admin");

$minlength = \OCA\PasswordPolicyEnforcement\Policy::getMinLength();
$mixedcase = \OCA\PasswordPolicyEnforcement\Policy::getMixedCase();
$mixedcase = ($mixedcase==='yes')?'checked="checked"':"";
$numbers = \OCA\PasswordPolicyEnforcement\Policy::getNumbers();
$numbers = ($numbers==='yes')?'checked="checked"':"";
$specialcharacters = \OCA\PasswordPolicyEnforcement\Policy::getSpecialChars();
$specialcharacters = ($specialcharacters==='yes')?'checked="checked"':"";
$specialcharslist = \OCA\PasswordPolicyEnforcement\Policy::getSpecialCharsList();

$tpl->assign('numbers', $numbers);
$tpl->assign('minlength', $minlength);
$tpl->assign('mixedcase', $mixedcase);
$tpl->assign('specialcharacters', $specialcharacters);
$tpl->assign('specialcharslist', $specialcharslist);

return $tpl->fetchPage();
