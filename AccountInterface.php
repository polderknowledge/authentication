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
 * An account represents an entity in the system. An account does not necessarily represents a single user, it's up
 * to the application on how to handle the representation of an account.
 */
interface AccountInterface
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
     * Gets a list with identities that have access to this account.
     *
     * @return IdentityInterface[] Returns a flat array with instances of type IdentityInterface.
     */
    public function getIdentities(): array;

    /**
     * Gets a list with all credentials that have been used in the past for this account.
     * This includes the current credential.
     *
     * @return CredentialInterface[] Returns a flat array with instances of CredentialInterface.
     */
    public function getCredentials(): array;

    /**
     * Gets the credential that is currently active and being used to authenticate.
     * This value can be null for cases where an authentication process is used that doesn't require a credential.
     *
     * @return CredentialInterface|null Returns null when no credential is set; CredentialInterface otherwise.
     */
    public function getCurrentCredential(): ?CredentialInterface;

    /**
     * Gets a list with all e-mail addresses that are assigned to this account.
     *
     * @return EmailAddressInterface[] Returns a flat array with instances of EmailAddressInterface.
     */
    public function getEmailAddresses(): array;

    /**
     * Gets the primary e-mail address for this account.
     * When no primary address has been set, this method will return null.
     *
     * @return null|EmailAddressInterface Returns null when no primary e-mail address is set.
     */
    public function getPrimaryEmailAddress(): ?EmailAddressInterface;
}
