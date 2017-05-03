<?php
/**
 *  Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\Authentication;

use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Ramsey\Uuid\UuidInterface;

class Group implements GroupInterface
{
    private $accounts;

    public function __construct()
    {
        $this->accounts = new ArrayCollection();
    }

    /**
     * Gets the id of this group.
     *
     * @return UuidInterface Returns an object of type UuidInterface.
     */
    public function getId(): UuidInterface
    {
        // TODO: Implement getId() method.
    }

    /**
     * Gets the date and time of when this group was created.
     *
     * @return DateTimeImmutable Returns an instance of type DateTimeImmutable
     */
    public function getCreationDate(): DateTimeImmutable
    {
        // TODO: Implement getCreationDate() method.
    }

    /**
     * Gets the name of the group.
     *
     * @return string Always returns a string, can be empty when no name is set.
     */
    public function getName(): string
    {
        // TODO: Implement getName() method.
    }

    /**
     * Gets a list with all accounts that are part of this group.
     *
     * @return AccountInterface[] Returns a flat array with instances of type AccountInterface.
     */
    public function getAccounts(): array
    {
        return $this->accounts->toArray();
    }

    /**
     * Checks whether or not the group is active.
     *
     * @return bool Returns true when the group is active; false otherwise.
     */
    public function isActive(): bool
    {
        // TODO: Implement isActive() method.
    }

    /**
     * Adds account to the group
     *
     * @param AccountInterface $account
     */
    public function addAccount(AccountInterface $account)
    {
        if (!$this->accounts->contains($account)) {
            $this->accounts->add($account);

            $account->addGroup($this);
        }
    }

    /**
     * Removes account from group
     *
     * @param AccountInterface $account
     */
    public function removeAccount(AccountInterface $account)
    {
        if ($this->accounts->contains($account)) {
            $this->accounts->removeElement($account);
            $account->removeGroup($this);
        }
    }
}
