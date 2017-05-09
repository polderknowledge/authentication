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
use PolderKnowledge\Authentication\Account\Command\Activate;
use PolderKnowledge\Authentication\Account\Command\ActivateHandler;
use PolderKnowledge\Authentication\EmailAddress;
use PolderKnowledge\Authentication\Identity\CredentialIdentity;

final class ActivateHandlerTest extends \PHPUnit_Framework_TestCase
{
    public function testActivateAccount()
    {
        $account = new Account(
            [new CredentialIdentity()], new EmailAddress('foo@bar.nl'), new Account\Status(Account\Status::INACTIVE)
        );
        $repository = $this->getMockBuilder(Account\Repository::class)->getMock();
        $repository->expects($this->once())
            ->method('update')
            ->with(static::equalTo($account));
        $command = new Activate($account);
        $handler = new ActivateHandler($repository);

        $handler->handle($command);

        static::assertSame(Account\Status::ACTIVE, (string)$account->getStatus());
    }
}
