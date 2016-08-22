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

// require_once __DIR__ . '/../../../tests/bootstrap.php';
// require_once __DIR__ . '/../appinfo/autoload.php';


if (!defined('PHPUNIT_RUN')) {
    define('PHPUNIT_RUN', 1);
}

require_once __DIR__.'/../../../lib/base.php';

\OC::$loader->addValidRoot(OC::$SERVERROOT . '/tests');
\OC_App::loadApp('pasword_policy');

if(!class_exists('PHPUnit_Framework_TestCase')) {
    require_once('PHPUnit/Autoload.php');
}

OC_Hook::clear();
