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

/**
 * Create your routes in here. The name is the lowercase name of the controller
 * without the controller part, the stuff after the hash is the method.
 * e.g. page#index -> OCA\Password\Controller\PageController->index()
 *
 * The controller class has to be registered in the application.php file since
 * it's instantiated in there
 */
return [
    'routes' => [
	   ['name' => 'Page#index', 'url' => '/', 'verb' => 'GET'],
	   ['name' => 'Page#do_echo', 'url' => '/echo', 'verb' => 'POST'],
       ['name' => 'Policy#set_password', 'url' => 'policy/set_password', 'verb' => 'POST'],
    ]
];
