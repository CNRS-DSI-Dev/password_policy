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

    /** @var @var \OCP\Config */
    protected $config = null;

    /**
     * @param IL10N $l
     */
    public function __construct(IL10N $l)
    {
        $this->l = $l;
        if (is_null($this->config)) {
            $this->setConfig();
        }
    }

    public function setConfig(\OCP\Config $config = null)
    {
        $this->config = $config;
        if (is_null($this->config)) {
            $this->config = new \OCP\Config;
        }
    }

    public function testPassword($password)
    {
        //admin can set any password
        if(\OC_User::isAdminUser(\OCP\User::getUser())) {
            return true;
        }

        //test length
        if(strlen($password)< $this->getMinLength()) {
            return false;
        }

        //test special characters
        if($this->getSpecialChars() === 'yes') {
            $special_chars = $this->getSpecialCharsList();

            if(!$this->checkSpecialChars($special_chars,$password)) {
                return false;
            }
        }

        //test Mixed case
        if($this->getMixedCase() === 'yes') {
            if(!$this->checkMixedCase($password))
                return false;
        }

        //test Numbers
        if($this->getNumbers() === 'yes') {
            if(preg_match("/[0-9]/",$password)!=1)
                return false;
        }

        return true;
    }

    public function setMinLength($limit)
    {
        $result = $this->config->setAppValue(self::AppName, 'min_length', $limit);
    }

    public function setSpecialCharsList($list)
    {
        $result = $this->config->setAppValue(self::AppName, 'specialcharslist', $list);
    }

    public function setSpecialChars($specialcharsrequired)
    {
        $result = $this->config->setAppValue(self::AppName, 'specialcharacters', $specialcharsrequired);
    }

    public function setMixedCase($mixedcase)
    {
        $result = $this->config->setAppValue(self::AppName, 'mixedcase', $mixedcase);
    }

    public function setNumbers($numbers)
    {
        $result = $this->config->setAppValue(self::AppName, 'numbers', $numbers);
    }

    public function getMinLength()
    {
        return $this->config->getAppValue(self::AppName, 'min_length', 15);
    }

    public function getSpecialCharsList()
    {
        return $this->config->getAppValue(self::AppName, 'specialcharslist', '');
    }

    public function getSpecialChars()
    {
        return $this->config->getAppValue(self::AppName, 'specialcharacters', 'no');
    }

    public function getMixedCase()
    {
        return $this->config->getAppValue(self::AppName, 'mixedcase', 'yes');
    }

    public function getNumbers()
    {
        return $this->config->getAppValue(self::AppName, 'numbers', 'yes');
    }

    public function checkSpecialChars($special, $input)
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

    public function checkMixedCase($input)
    {
            if(strtoupper($input) == $input || strtolower($input) == $input) {
                return false;
            }
            return true;
    }
}

