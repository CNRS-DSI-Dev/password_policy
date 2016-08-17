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

namespace OCA\PasswordPolicyEnforcement\Tests;

use PHPUnit_Framework_TestCase;

use OCP\AppFramework\Http\TemplateResponse;


// class PolicyTest extends PHPUnit_Framework_TestCase
class PolicyTest extends \Test\TestCase
{
    const AppName = "password_policy";
    public $mockConfig;

    public function setUp()
    {
        $map = [
            [self::AppName, 'min_length', 15, 4],
            [self::AppName, 'mixedcase', 'yes', 'yes'],
            [self::AppName, 'numbers', 'yes', 'no'],
            [self::AppName, 'specialcharacters', 'no', 'yes'],
            [self::AppName, 'specialcharslist', '', 'ABC'],
        ];

        $this->mockConfig = $this->getMockBuilder('\OCP\IConfig')
            ->getMock();

        $this->mockConfig->method('getAppValue')
            ->will($this->returnValueMap($map));
    }

    public function tearDown()
    {
        unset($this->mockConfig);
    }

    public function testPasswordPolicy()
    {
        $policy = new \OCA\PasswordPolicyEnforcement\Policy;
        $policy->setConfig($this->mockConfig);

        $this->assertEquals(4, $policy->getMinLength());
        $this->assertEquals('yes', $policy->getSpecialChars());
        $this->assertEquals('ABC', $policy->getSpecialCharsList());
        $this->assertEquals('yes', $policy->getMixedCase());
        $this->assertEquals('no', $policy->getNumbers());
    }

    public function testPassword()
    {
        $policy = new \OCA\PasswordPolicyEnforcement\Policy;
        $policy->setConfig($this->mockConfig);

        $this->assertTrue($policy->testPassword('AbCd'), 'Correct password');
        $this->assertFalse($policy->testPassword('abc'), 'Not enough characters');
        $this->assertFalse($policy->testPassword('abcd', 'Not mixed cased'));
        $this->assertFalse($policy->testPassword('abcD', 'At least one special char should be used'));
    }
}
