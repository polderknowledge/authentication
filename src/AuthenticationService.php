<?php
/**
 *  Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\Authentication;

use PolderKnowledge\Authentication\Account\Identity\Repository;
use PolderKnowledge\Authentication\Identity\AuthenticatedIdentity;
use PolderKnowledge\Authentication\Identity\GuestIdentity;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Authentication\Result;

final class AuthenticationService implements AuthenticationServiceInterface
{
    /**
     * @var AuthenticationServiceInterface
     */
    private $authenticationService;

    /**
     * @var Repository
     */
    private $identityProvider;

    /**
     * AuthenticationService constructor.
     * @param AuthenticationServiceInterface $authenticationService
     * @param Repository $identityRepository
     */
    public function __construct(AuthenticationServiceInterface $authenticationService, Repository $identityRepository)
    {
        $this->authenticationService = $authenticationService;
        $this->identityProvider = $identityRepository;
    }

    public function getIdentity()
    {
        if (!$this->hasIdentity()) {
            return new GuestIdentity();
        }

        $identity = $this->authenticationService->getIdentity();
        $identity = $this->identityProvider->find($identity);

        return new AuthenticatedIdentity($identity, 'account');
    }

    /**
     * Authenticates and provides an authentication result
     *
     * @return Result
     */
    public function authenticate(): Result
    {
        return $this->authenticationService->authenticate();
    }

    /**
     * Returns true if and only if an identity is available
     *
     * @return bool
     */
    public function hasIdentity(): bool
    {
        return $this->authenticationService->hasIdentity();
    }

    /**
     * Clears the identity
     *
     * @return void
     */
    public function clearIdentity()
    {
        $this->authenticationService->clearIdentity();
    }
}
