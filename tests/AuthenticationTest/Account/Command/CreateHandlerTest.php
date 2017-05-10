<?php
/**
 *  Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\AuthenticationTest\Account\Command;

use PolderKnowledge\Authentication\Account\Command\Create;
use PolderKnowledge\Authentication\Account\Command\CreateHandler;
use PolderKnowledge\Authentication\Account\Identity\CredentialIdentity;
use PolderKnowledge\Authentication\Account\Repository;
use PolderKnowledge\Authentication\EmailAddress;

/**
 * @coversDefaultClass PolderKnowledge\Authentication\Account\Command\CreateHandler
 */
class CreateHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::handle
     */
    public function testCreatesAccountAsExpected()
    {
        $repository = $this->getMockBuilder(Repository::class)->getMock();
        $repository->expects($this->once())
            ->method('add');

        $command = new Create([new CredentialIdentity('my-identity')], new EmailAddress('foo@example.com'));
        $handler = new CreateHandler($repository);

        $handler->handle($command);
    }
}
