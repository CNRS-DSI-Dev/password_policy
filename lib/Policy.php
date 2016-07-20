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

namespace OCA\PasswordPolicyEnforcement;

use OCP\IL10N;

class Policy
{
    const AppName = 'password_policy';

    /** @var IL10N */
    protected $l;

    /**
     * @param IL10N $l
     */
    public function __construct(IL10N $l)
    {
        $this->l = $l;
    }

    public static function testPassword($password)
    {
        //admin can set any password
        if(\OC_User::isAdminUser(\OCP\User::getUser())) {
            return true;
        }

        //test length
        if(strlen($password)< self::getMinLength()) {
            return false;
        }

        //test special characters
        if(self::getSpecialChars() === 'yes') {
            $special_chars = self::getSpecialCharsList();

            if(!self::checkSpecialChars($special_chars,$password)) {
                return false;
            }
        }

        //test Mixed case
        if(self::getMixedCase() === 'yes') {
            if(!self::checkMixedCase($password))
                return false;
        }

        //test Numbers
        if(self::getNumbers() === 'yes') {
            if(preg_match("/[0-9]/",$password)!=1)
                return false;
        }

        return true;
    }

    public static function setMinLength($limit)
    {
        $result = \OCP\Config::setAppValue(self::AppName, 'min_length', $limit);
    }

    public static function setSpecialCharsList($list)
    {
        $result = \OCP\Config::setAppValue(self::AppName, 'specialcharslist', $list);
    }

    public static function setSpecialChars($specialcharsrequired)
    {
        $result = \OCP\Config::setAppValue(self::AppName, 'specialcharacters', $specialcharsrequired);
    }

    public static function setMixedCase($mixedcase)
    {
        $result = \OCP\Config::setAppValue(self::AppName, 'mixedcase', $mixedcase);
    }

    public static function setNumbers($numbers)
    {
        $result = \OCP\Config::setAppValue(self::AppName, 'numbers', $numbers);
    }

    public static function getMinLength()
    {
        return \OCP\Config::getAppValue(self::AppName, 'min_length', 15);
    }

    public static function getSpecialCharsList()
    {
        return \OCP\Config::getAppValue(self::AppName, 'specialcharslist', '');

    }

    public static function getSpecialChars()
    {
        return \OCP\Config::getAppValue(self::AppName, 'specialcharacters', 'no');
    }

    public static function getMixedCase()
    {
        return \OCP\Config::getAppValue(self::AppName, 'mixedcase', 'yes');
    }

    public static function getNumbers()
    {
        return \OCP\Config::getAppValue(self::AppName, 'numbers', 'yes');
    }

    public static function checkSpecialChars($special, $input)
    {
            for($i=0;$i<strlen($special);$i++)
            {
                    $x=substr ($special, $i, 1);

                    if(strstr($input,$x))
                    {
                            return true;
                    }
            }

            return false;
    }

    public static function checkMixedCase($input)
    {
            if(strtoupper($input) == $input || strtolower($input) == $input) {
                return false;
            }
            return true;
    }
}

