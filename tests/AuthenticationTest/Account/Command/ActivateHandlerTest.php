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
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject
     */
    private $accountRepository;

    /** @var ActivateHandler */
    private $handler;

    /** @var  \PHPUnit_Framework_MockObject_MockObject */
    private $tokenRepository;

    protected function setUp()
    {
        $this->accountRepository = $this->getMockBuilder(Account\Repository::class)->getMock();
        $this->tokenRepository = $this->getMockBuilder(Account\ActivationTokenRepository::class)->getMock();
        $this->handler = new ActivateHandler($this->accountRepository, $this->tokenRepository);
    }

    public function testActivateAccount()
    {
        $account = new Account(
            [new CredentialIdentity()], new EmailAddress('foo@bar.nl'), new Account\Status(Account\Status::INACTIVE)
        );

        $activationToken = new Account\ActivationToken(
            'someToken',
            $account,
            new \DateTimeImmutable('+24 hours')
        );

        $this->tokenRepository->expects($this->once())
            ->method('get')
            ->willReturn($activationToken);

        $this->accountRepository->expects($this->once())
            ->method('update')
            ->with(static::equalTo($account));

        $command = new Activate('someToken');

        $this->handler->handle($command);

        static::assertSame(Account\Status::ACTIVE, (string)$account->getStatus());
    }

    /**
     * @expectedException \PolderKnowledge\Authentication\Account\Command\InvalidTokenException
     */
    public function testTokenNotFound()
    {
        $this->tokenRepository->expects($this->once())
            ->method('get')
            ->willThrowException(new Account\Command\InvalidTokenException());

        $command = new Activate('someToken');

        $this->handler->handle($command);
    }

    /**
     * @expectedException \PolderKnowledge\Authentication\Account\Command\InvalidTokenException
     */
    public function testInvalidToken()
    {
        $account = new Account(
            [new CredentialIdentity()], new EmailAddress('foo@bar.nl'), new Account\Status(Account\Status::INACTIVE)
        );

        $activationToken = new Account\ActivationToken(
            'someToken',
            $account,
            new \DateTimeImmutable('-24 hours')
        );

        $this->tokenRepository->expects($this->once())
            ->method('get')
            ->willReturn($activationToken);

        $this->accountRepository->expects($this->never())
            ->method('update')
            ->with(static::equalTo($account));

        $command = new Activate('someToken');

        $this->handler->handle($command);

        static::assertSame(Account\Status::INACTIVE, (string)$account->getStatus());
    }
}
