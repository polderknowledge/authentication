<?php declare(strict_types=1);
/**
 * Polder Knowledge (http://polderknowledge.nl)
 *
 * @link https://github.com/polderknowledge/user-models for the canonical source repository
 * @copyright Copyright (c) 2002-2017 Polder Knowledge (http://www.polderknowledge.nl)
 * @license https://github.com/polderknowledge/user-models/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\UserModels;

use DateTimeInterface;
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
     * @return DateTimeInterface Returns an instance of type DateTimeInterface
     */
    public function getCreationDate(): DateTimeInterface;

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
     * Checks whether or not the group is active.
     *
     * @return bool Returns true when the group is active; false otherwise.
     */
    public function isActive(): bool;
}
