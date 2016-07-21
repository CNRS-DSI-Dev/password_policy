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

use PHPUnit_Framework_TestCase;

use OCP\AppFramework\Http\TemplateResponse;


// class PolicyTest extends PHPUnit_Framework_TestCase
class PolicyTest extends \Test\TestCase
{
    const AppName = "password_policy";
    public $mockPolicy;

    public function setUp()
    {
        $this->mockPolicy = $this->getMockBuilder("\OCA\PasswordPolicyEnforcement\Policy")
            ->disableOriginalConstructor()
            ->setMethods(['getMinLength', 'getMixedCase', 'getSpecialChars', 'getSpecialCharsList'])
            ->getMock();
    }

    public function testPassword()
    {
        $this->mockPolicy->method('getMinLength')
            ->willReturn(4);
        $this->mockPolicy->method('getMixedCase')
            ->willReturn('yes');
        $this->mockPolicy->method('getSpecialChars')
            ->willReturn('yes');
        $this->mockPolicy->method('getSpecialCharsList')
            ->willReturn('ABC');

        $this->assertTrue($this->mockPolicy->testPassword('AbCd'), 'Correct password');

        $this->assertFalse($this->mockPolicy->testPassword('abc'), 'Not enough characters');
        $this->assertFalse($this->mockPolicy->testPassword('abcd', 'Not mixed cased'));
        $this->assertFalse($this->mockPolicy->testPassword('abcD', 'At least one special char should be used'));
    }
}
