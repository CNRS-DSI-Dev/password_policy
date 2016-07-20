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

namespace OCA\PasswordPolicyEnforcement\Controller;

use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\IRequest;

class SettingsController extends Controller {


    private $userId;

    public function __construct($AppName, IRequest $request, $UserId){
        parent::__construct($AppName, $request);
        $this->userId = $UserId;
    }

    public function displayAdmin()
    {
        return new TemplateResponse('$AppName', 'settings-admin', [], '');
    }
