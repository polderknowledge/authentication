<?php
/**
 *  Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\AuthenticationTest;

use PHPUnit_Framework_TestCase;
use PolderKnowledge\Authentication\Account\Identity\CredentialIdentity;
use PolderKnowledge\Authentication\Account\Identity\Repository;
use PolderKnowledge\Authentication\AuthenticationService;
use PolderKnowledge\Authentication\Identity\AuthenticatedIdentity;
use PolderKnowledge\Authentication\Identity\GuestIdentity;
use Zend\Authentication\AuthenticationServiceInterface;

/**
 * @coversDefaultClass PolderKnowledge\Authentication\AuthenticationService
 */
final class AuthenticationServiceTest extends PHPUnit_Framework_TestCase
{
    /** @var  \PHPUnit_Framework_MockObject_MockObject */
    private $identityRepository;

    /**
     * @var AuthenticationService
     */
    private $fixture;

    /** @var \PHPUnit_Framework_MockObject_MockObject */
    private $authenticationService;

    protected function setUp()
    {
        $this->identityRepository = $this->getMockBuilder(Repository::class)->getMock();
        $this->authenticationService = $this->getMockBuilder(AuthenticationServiceInterface::class)->getMock();

        $this->fixture = new AuthenticationService($this->authenticationService, $this->identityRepository);
    }

    /**
     * @covers ::getIdentity
     * @covers ::hasIdentity
     */
    public function testGetIdentityReturnsGuestIdentityWithoutIdentity()
    {
        $this->authenticationService->expects($this->once())
            ->method('hasIdentity')
            ->willReturn(false);

        static::assertInstanceOf(GuestIdentity::class, $this->fixture->getIdentity());
    }

    /**
     * @covers ::getIdentity
     * @covers ::hasIdentity
     *
     * @uses \PolderKnowledge\Authentication\Account\Identity\CredentialIdentity
     */
    public function testGetIdentityReturnsAuthenticatedIdentity()
    {
        $account = AccountTest::createActiveAccount();
        $authenticatedIdentity = new CredentialIdentity('my-identity');
        $authenticatedIdentity = $authenticatedIdentity->withAccount($account);

        $this->authenticationService->expects($this->once())
            ->method('hasIdentity')
            ->willReturn(true);

        $this->authenticationService->expects($this->once())
            ->method('getIdentity')
            ->willReturn('my-identity');

        $this->identityRepository->expects($this->once())
            ->method('find')
            ->with(static::equalTo('my-identity'))
            ->willReturn($authenticatedIdentity);

        $identity = $this->fixture->getIdentity();

        static::assertInstanceOf(AuthenticatedIdentity::class, $identity);
        static::assertSame($authenticatedIdentity, $identity->getAuthenticationIdentity());
        static::assertSame($account, $identity->getAuthenticationIdentity()->getAccount());
    }
}
