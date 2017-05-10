<?php
/**
 *  Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

declare(strict_types=1);
/**
 * Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\Authentication\Account\Identity;

use DateTimeImmutable;
use PolderKnowledge\Authentication\AccountInterface;
use Ramsey\Uuid\UuidInterface;

/**
 * An identity represents a value that can be used to authenticate an account with. This can basically be any
 * value such as a username, an e-mail address or a Facebook id. The directory value dictates the way the identity
 * value should be used during authentication.
 */
interface IdentityInterface
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
     * Gets the account to which this identity belongs.
     *
     * @return AccountInterface Returns an AccountInterface instance which is the owner of this identity.
     */
    public function getAccount(): AccountInterface;

    /**
     * Gets the directory that dictates how to process the identity.
     *
     * @return string Returns the name of the directory as a string.
     */
    public function getDirectory(): string;

    /**
     * Gets the actual identity value that this object holds.
     *
     * @return string Returns the identity as a string.
     */
    public function getIdentity(): string;

    /**
     * Creates a clone of the current identity and adds it to
     * the account.
     *
     * @param AccountInterface $account
     * @return IdentityInterface
     */
    public function withAccount(AccountInterface $account): IdentityInterface;
}
