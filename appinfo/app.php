<?php

OC::$CLASSPATH['OC_password_policy_Hooks'] = 'password_policy/lib/hooks.php';
OC::$CLASSPATH['OC_Password_Policy'] = 'password_policy/lib/password_policy.php';
OCP\Util::connectHook('OC_User', 'pre_setPassword', 'OC_password_policy_Hooks', 'pre_setPassword');

OCP\App::registerAdmin('password_policy','admin');
OCP\App::registerPersonal('password_policy', 'personal');
/*
if(OC_User::isAdminUser(OC_User::getUser())){
	\OCP\App::addNavigationEntry(array(
	
	    // the string under which your app will be referenced in owncloud
	    'id' => 'password_policy',
	
	    // sorting weight for the navigation. The higher the number, the higher
	    // will it be listed in the navigation
	    'order' => 99,
	
	    // the route that will be shown on startup
	    'href' => \OCP\Util::linkToRoute('password_policy_index'),
	
	    // the icon that will be shown in the navigation
	    // this file needs to exist in img/example.png
	    'icon' => \OCP\Util::imagePath('password_policy', 'actions/lock.png'),
	
	    // the title of your application. This will be used in the
	    // navigation or on the settings page of your app
	    'name' => 'Pwd. Policy'
	));
}*/