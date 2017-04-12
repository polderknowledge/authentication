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
 * A credential is a password that can be used
 */
interface CredentialInterface
{
    /**
     * Gets the id of this credential.
     *
     * @return UuidInterface Returns an object of type UuidInterface.
     */
    public function getId(): UuidInterface;

    /**
     * Gets the date and time of when this credential was created.
     *
     * @return DateTimeInterface Returns an instance of type DateTimeInterface
     */
    public function getCreationDate(): DateTimeInterface;

    /**
     * Gets the account to which this credential belongs.
     *
     * @return AccountInterface Returns an AccountInterface instance which is the owner of this credential.
     */
    public function getAccount(): AccountInterface;

    /**
     * Gets the actual credential. This will be a hashed value.
     * The hash depends on the chosen implementation for the application.
     *
     * @return string Returns the credential hash as a string.
     */
    public function getCredential(): string;
}
