<?php
/**
 *  Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\Authentication\Identity;

class AuthenticatedIdentity implements IdentityInterface
{
    private $identity;
    private $roleId;

    public function __construct($identity, string $roleId)
    {
        $this->identity = $identity;
        $this->roleId = $roleId;
    }

    public function __toString()
    {
        return $this->roleId;
    }

    public function getAuthenticationIdentity()
    {
        return $this->identity;
    }
}
