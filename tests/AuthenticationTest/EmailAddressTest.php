<?php
/**
 *  Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\AuthenticationTest;

use PolderKnowledge\Authentication\EmailAddress;

/**
 * @coversDefaultClass \PolderKnowledge\Authentication\EmailAddress
 */
class EmailAddressTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     *
     * @expectedException \InvalidArgumentException
     */
    public function testWithEmptyMail()
    {
        new EmailAddress('');
    }
}
