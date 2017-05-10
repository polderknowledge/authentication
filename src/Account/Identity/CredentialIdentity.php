<?php
/**
 *  Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\Authentication\Account\Identity;

use DateTimeImmutable;
use PolderKnowledge\Authentication\Account;
use PolderKnowledge\Authentication\AccountInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class CredentialIdentity implements IdentityInterface
{
    /**
     * @var string
     */
    private $identity;

    /**
     * @var UuidInterface
     */
    private $id;

    /**
     * @var DateTimeImmutable
     */
    private $creationDate;

    /**
     * @var Account
     */
    private $account;

    public function __construct(string $identity)
    {
        $this->id = Uuid::uuid4();
        $this->creationDate = new DateTimeImmutable();
        $this->identity = $identity;
    }

    /**
     * Gets the id of this identity.
     *
     * @return UuidInterface Returns an object of type UuidInterface.
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * Gets the date and time of when this identity was created.
     *
     * @return DateTimeImmutable Returns an instance of type DateTimeImmutable
     */
    public function getCreationDate(): DateTimeImmutable
    {
        return $this->creationDate;
    }

    /**
     * Gets the account to which this identity belongs.
     *
     * @return AccountInterface Returns an AccountInterface instance which is the owner of this identity.
     */
    public function getAccount(): AccountInterface
    {
        return $this->account;
    }

    /**
     * Gets the directory that dictates how to process the identity.
     *
     * @return string Returns the name of the directory as a string.
     */
    public function getDirectory(): string
    {
        return 'local';
    }

    /**
     * Gets the actual identity value that this object holds.
     *
     * @return string Returns the identity as a string.
     */
    public function getIdentity(): string
    {
        return $this->identity;
    }

    /**
     * Creates a clone of the current identity and adds it to
     * the account.
     *
     * @param AccountInterface $account
     * @return IdentityInterface
     */
    public function withAccount(AccountInterface $account): IdentityInterface
    {
        $identity = clone $this;
        $identity->account = $account;

        return $identity;
    }
}
