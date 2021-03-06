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
 * An authentication session should be created once an account has been authenticated. By creating this object it
 * becomes possible to create an history of where- and when accounts are authenticated.
 */
interface AuthSessionInterface
{
    /**
     * Gets the id of this session.
     *
     * @return UuidInterface Returns an object of type UuidInterface.
     */
    public function getId(): UuidInterface;

    /**
     * Gets the date and time of when this session was created.
     *
     * @return DateTimeImmutable Returns an instance of type DateTimeImmutable
     */
    public function getCreationDate(): DateTimeImmutable;

    /**
     * Gets the account to which this session belongs.
     *
     * @return AccountInterface Returns an AccountInterface instance which is the owner of this authentication session.
     */
    public function getAccount(): AccountInterface;

    /**
     * Gets the session id that was assigned to this visitor.
     *
     * @return string Returns the session id as a string.
     */
    public function getSessionId(): string;

    /**
     * Gets the remote IP address of the visitor as an integer.
     * This method can return null when the IP address is unknown.
     * Use "long2ip" to convert this value to a string.
     *
     * @return int|null Returns null when no address is available; an integer otherwise.
     */
    public function getRemoteAddress(): ?int;

    /**
     * Gets the user agent of the device which was used to visit the application.
     * This method can return null when no user agent was set.
     *
     * @return null|string Returns null when no user agent is available; a string otherwise.
     */
    public function getUserAgent(): string;
}
