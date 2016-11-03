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

\OCP\App::checkAppEnabled('password_policy');
\OC_Util::checkLoggedIn();

$tpl = new OCP\Template("password_policy", "settings-personal");

$policy = new \OCA\PasswordPolicyEnforcement\Policy(\OCP\Util::getL10N('password_policy'));

$minlength = $policy->getMinLength();
$mixedcase = $policy->getMixedCase();
$mixedcase = ($mixedcase==='yes')?true:false;
$numbers = $policy->getNumbers();
$numbers = ($numbers==='yes')?true:false;
$specialcharacters = $policy->getSpecialChars();
$specialcharacters = ($specialcharacters==='yes')?true:false;
$specialcharslist = $policy->getSpecialCharsList();

$tpl->assign('numbers', $numbers);
$tpl->assign('minlength', $minlength);
$tpl->assign('mixedcase', $mixedcase);
$tpl->assign('specialcharacters', $specialcharacters);
$tpl->assign('specialcharslist', $specialcharslist);

return $tpl->fetchPage();
