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

namespace OCA\PasswordPolicyEnforcement\AppInfo;

use OCP\App;
use OCP\AppFramework\IAppContainer;

class Application extends \OCP\AppFramework\App {
	/**
	 * @param array $urlParams
	 */
	public function __construct($urlParams = array()) {
		parent::__construct('password_policy', $urlParams);
	}

	/**
	 * register setting scripts
	 */
	public function registerSettings() {
		App::registerAdmin($this->getContainer()->getAppName(), 'settings/settings-admin');
		App::registerPersonal($this->getContainer()->getAppName(), 'settings/settings-personal');
	}

	/**
	 * register "preSetPassword" hook
	 */
	public function registerHooks() {
		// \OCP\Util::connectHook('OC_User', 'pre_setPassword', 'OCA\PasswordPolicyEnforcement\Hooks\Hooks', 'preSetPassword');
		$this->getContainer()->query('ServerContainer')->getUserManager()->listen('\OC\User', 'preSetPassword', ['OCA\PasswordPolicyEnforcement\Hooks\Hooks', 'preSetPassword']);
	}
}
