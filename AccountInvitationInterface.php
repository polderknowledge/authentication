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
use DateTimeInterface;
use Ramsey\Uuid\UuidInterface;

/**
 * An account invitation can be used to invite people to create an account in the application.
 */
interface AccountInvitationInterface
{
    /**
     * Gets the id of this invitation.
     *
     * @return UuidInterface Returns an object of type UuidInterface.
     */
    public function getId(): UuidInterface;

    /**
     * Gets the date and time of when this invitation was created.
     *
     * @return DateTimeImmutable Returns an instance of type DateTimeImmutable
     */
    public function getCreationDate(): DateTimeImmutable;

    /**
     * Gets the date and time of when this invitation will expire.
     *
     * @return DateTimeInterface Returns an instance of type DateTimeInterface
     */
    public function getExpirationDate(): DateTimeInterface;

    /**
     * Gets the name of the person who received the invitation.
     *
     * @return string Returns the name of the person as a string.
     */
    public function getName(): string;

    /**
     * Gets the e-mail address to whom the invitation was sent.
     *
     * @return string Returns the e-mail address as a string.
     */
    public function getEmailAddress(): string;
}
