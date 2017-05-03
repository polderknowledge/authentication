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
 * A group which can be used to categorize accounts in. Typically used for ACL environments.
 */
interface GroupInterface
{
    /**
     * Gets the id of this group.
     *
     * @return UuidInterface Returns an object of type UuidInterface.
     */
    public function getId(): UuidInterface;

    /**
     * Gets the date and time of when this group was created.
     *
     * @return DateTimeImmutable Returns an instance of type DateTimeImmutable
     */
    public function getCreationDate(): DateTimeImmutable;

    /**
     * Gets the name of the group.
     *
     * @return string Always returns a string, can be empty when no name is set.
     */
    public function getName(): string;

    /**
     * Gets a list with all accounts that are part of this group.
     *
     * @return AccountInterface[] Returns a flat array with instances of type AccountInterface.
     */
    public function getAccounts(): array;

    /**
     * Adds account to the group
     *
     * @param AccountInterface $account
     */
    public function addAccount(AccountInterface $account);

    /**
     * Removes account from group
     *
     * @param AccountInterface $account
     */
    public function removeAccount(AccountInterface $account);

    /**
     * Checks whether or not the group is active.
     *
     * @return bool Returns true when the group is active; false otherwise.
     */
    public function isActive(): bool;
}
