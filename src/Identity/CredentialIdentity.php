<?php
/**
 *  Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\Authentication\Identity;

use DateTimeImmutable;
use PolderKnowledge\Authentication\AccountInterface;
use Ramsey\Uuid\UuidInterface;

class CredentialIdentity implements IdentityInterface
{

    /**
     * Gets the id of this identity.
     *
     * @return UuidInterface Returns an object of type UuidInterface.
     */
    public function getId(): UuidInterface
    {
        // TODO: Implement getId() method.
    }

    /**
     * Gets the date and time of when this identity was created.
     *
     * @return DateTimeImmutable Returns an instance of type DateTimeImmutable
     */
    public function getCreationDate(): DateTimeImmutable
    {
        // TODO: Implement getCreationDate() method.
    }

    /**
     * Gets the account to which this identity belongs.
     *
     * @return AccountInterface Returns an AccountInterface instance which is the owner of this identity.
     */
    public function getAccount(): AccountInterface
    {
        // TODO: Implement getAccount() method.
    }

    /**
     * Gets the directory that dictates how to process the identity.
     *
     * @return string Returns the name of the directory as a string.
     */
    public function getDirectory(): string
    {
        // TODO: Implement getDirectory() method.
    }

    /**
     * Gets the actual identity value that this object holds.
     *
     * @return string Returns the identity as a string.
     */
    public function getIdentity(): string
    {
        // TODO: Implement getIdentity() method.
    }
}
