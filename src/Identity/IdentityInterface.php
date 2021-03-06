<?php
/**
 *  Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\Authentication\Identity;

use PolderKnowledge\Authentication\Account\Identity\IdentityInterface as AccountIdentity;

interface IdentityInterface
{
    /**
     * @return AccountIdentity|Null
     */
    public function getAuthenticationIdentity();
}
