<?php
/**
 *  Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\AuthenticationTest\Account\Command;

use PolderKnowledge\Authentication\Account\ActivationToken;
use PolderKnowledge\Authentication\Account\ActivationTokenRepository;
use PolderKnowledge\Authentication\Account\Command\RequestActivation;
use PolderKnowledge\Authentication\Account\Command\RequestActivationHandler;
use PolderKnowledge\Authentication\Account\Status;
use PolderKnowledge\Authentication\Token\Generator;
use PolderKnowledge\AuthenticationTest\AccountTest;

/**
 * @coversDefaultClass PolderKnowledge\Authentication\Account\Command\RequestActivationHandler
 */
class RequestActivationHandlerTest extends \PHPUnit_Framework_TestCase
{
    /** @var  \PHPUnit_Framework_MockObject_MockObject */
    private $repository;

    /** @var  RequestActivationHandler */
    private $handler;
    private $tokenGenerator;

    protected function setUp()
    {
        $this->repository = $this->getMockBuilder(ActivationTokenRepository::class)->getMock();
        $this->tokenGenerator = $this->getMockBuilder(Generator::class)->getMock();
        $this->tokenGenerator->method('__invoke')->willReturn('someRandomToken');
        $this->handler = new RequestActivationHandler($this->repository, $this->tokenGenerator);
    }


    /**
     * @covers ::handle
     * @expectedException \InvalidArgumentException
     */
    public function testCannotActivateActiveAccount()
    {
        $this->repository->expects($this->never())
            ->method('add');
        $account = AccountTest::createActiveAccount();
        $command = new RequestActivation($account, 'someToken');

        $this->handler->handle($command);
    }

    public function testRequestActivation()
    {
        $account = AccountTest::createActiveAccount();
        $account->setStatus(new Status(Status::INACTIVE));

        $this->repository->expects($this->once())
            ->method('add')
            ->with(static::isInstanceOf(ActivationToken::class));

        $command = new RequestActivation($account, 'someToken');

        $this->handler->handle($command);
    }
}
