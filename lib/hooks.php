<?php

class OC_password_policy_Hooks {
	static public function pre_setPassword($vars) {

		if(!OC_Password_Policy::testPassword($vars['password']))
		{
			exit();
		}
		else
		{
			return true;
		}
	}
}