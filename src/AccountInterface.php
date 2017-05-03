<?php declare(strict_types=1);
/**
 * Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\Authentication;

use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

/**
 * An account represents an entity in the system. An account does not necessarily represents a single user, it's up
 * to the application on how to handle the representation of an account.
 */
interface AccountInterface
{
    /**
     * Gets the id of this identity.
     *
     * @return UuidInterface Returns an object of type UuidInterface.
     */
    public function getId(): UuidInterface;

    /**
     * Gets the date and time of when this identity was created.
     *
     * @return DateTimeImmutable Returns an instance of type DateTimeImmutable
     */
    public function getCreationDate(): DateTimeImmutable;

    /**
     * Gets a list with identities that have access to this account.
     *
     * @return EmailAddress[] Returns a flat array with instances of type IdentityInterface.
     */
    public function getIdentities(): array;

    /**
     * Gets a list with all e-mail addresses that are assigned to this account.
     *
     * @return EmailAddress[] Returns a flat array with instances of EmailAddressInterface.
     */
    public function getEmailAddresses(): array;

    /**
     * Gets the primary e-mail address for this account.
     *
     * @return EmailAddress
     */
    public function getPrimaryEmailAddress(): EmailAddress;

    /**
     * Adds a group to the account. And registers the account in the group.
     *
     * @param GroupInterface $group
     */
    public function addGroup(GroupInterface $group);

    /**
     * Removes the given group from the account and removes itself from the group object.
     *
     * @param GroupInterface $group
     */
    public function removeGroup(GroupInterface $group);
}
