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

/**
 * The AccountDetailsInterface should be implemented by the application itself to define application specific fields.
 */
interface AccountDetailsInterface
{
    /**
     * Gets the date and time of when the account details were created.
     *
     * @return DateTimeImmutable Returns an instance of type DateTimeImmutable
     */
    public function getCreationDate(): DateTimeImmutable;

    /**
     * Gets the account to which this account details belong.
     *
     * @return AccountInterface Returns an AccountInterface instance which is the owner of this account details.
     */
    public function getAccount(): AccountInterface;
}
