<?php
/**
 *  Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\AuthenticationTest\Account\Command;

use PolderKnowledge\Authentication\Account;
use PolderKnowledge\Authentication\Account\Command\Deactivate;
use PolderKnowledge\Authentication\Account\Command\DeactivateHandler;
use PolderKnowledge\Authentication\EmailAddress;
use PolderKnowledge\Authentication\Identity\CredentialIdentity;

/**
 * @coversDefaultClass PolderKnowledge\Authentication\Account\Command\DeactivateHandler
 */
final class DeactivateHandlerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     * @covers ::handle
     */
    public function testDeactivate()
    {
        $account = new Account(
            [new CredentialIdentity()],
            new EmailAddress('foo@bar.nl'),
            new Account\Status(Account\Status::ACTIVE)
        );

        $repository = $this->getMockBuilder(Account\Repository::class)->getMock();
        $repository->expects($this->once())
            ->method('update')
            ->with(static::equalTo($account));
        $command = new Deactivate($account);
        $handler = new DeactivateHandler($repository);

        $handler->handle($command);

        static::assertEquals(Account\Status::INACTIVE, (string)$account->getStatus());
    }
}
