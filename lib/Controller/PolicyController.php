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

use OCP\IRequest;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http;

class PolicyController extends Controller {


    private $userId;

    public function __construct($AppName, IRequest $request, $UserId)
    {
        parent::__construct($AppName, $request);
        $this->userId = $UserId;
    }

    /**
     * @NoAdminRequired
     * @param string $password
     */
    public function setPassword($password='')
    {
        if(empty($password) or !\OCA\PasswordPolicyEnforcement\Policy::testPassword($password)) {
            return new DataResponse([
                'msg' => 'Password does not comply with the Password Policy.',
                'status' => 'error',
            ]);
        }
        else {
            return new DataResponse([
                'status' => 'success',
            ]);
        }
    }

}
