<?php
/**
 * Polder Knowledge / UserModule (http://polderknowledge.nl)
 *
 * @link http://developers.polderknowledge.nl/gitlab/polderknowledge/user-module for the canonical source repository
 * @copyright Copyright (c) 2002-2015 Polder Knowledge (http://www.polderknowledge.nl)
 * @license http://polderknowledge.nl/license/proprietary proprietary
 */

namespace PolderKnowledge\Authentication\Identity;

class GuestIdentity implements IdentityInterface
{
    public function getAuthenticationIdentity()
    {
        return null;
    }

    public function __toString()
    {
        return 'guest';
    }
}
