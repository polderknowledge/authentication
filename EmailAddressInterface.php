<?php declare(strict_types=1);
/**
 * Polder Knowledge (http://polderknowledge.nl)
 *
 * @link https://github.com/polderknowledge/user-models for the canonical source repository
 * @copyright Copyright (c) 2002-2017 Polder Knowledge (http://www.polderknowledge.nl)
 * @license https://github.com/polderknowledge/user-models/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\UserModels;

use DateTimeImmutable;
use Ramsey\Uuid\UuidInterface;

/**
 * An e-mail address coupled to an account. An account can have multiple e-mail addresses assigned to itself of which
 * one can be set as a primary address.
 */
interface EmailAddressInterface
{
    /**
     * Gets the id of this e-mail address.
     *
     * @return UuidInterface Returns an object of type UuidInterface.
     */
    public function getId(): UuidInterface;

    /**
     * Gets the date and time of when this e-mail address was created.
     *
     * @return DateTimeImmutable Returns an instance of type DateTimeImmutable
     */
    public function getCreationDate(): DateTimeImmutable;

    /**
     * Gets the account to which this e-mail address belongs.
     *
     * @return AccountInterface Returns an AccountInterface instance which is the owner of this e-mail address.
     */
    public function getAccount(): AccountInterface;

    /**
     * Gets the e-mail address value that this object represents.
     *
     * @return string Returns the e-mail address value as a string.
     */
    public function getAddress(): string;

    /**
     * Gets the verification code that should be used to verify this e-mail address.
     * When this method returns null, we consider the e-mail address as verified.
     *
     * @return null|string Returns null when the e-mail address is verified; a string otherwise.
     */
    public function getVerificationCode(): ?string;
}
