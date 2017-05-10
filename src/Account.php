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
use Doctrine\Common\Collections\Collection;
use PolderKnowledge\Authentication\Account\Status;
use PolderKnowledge\Authentication\Account\Identity\IdentityInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;
use Webmozart\Assert\Assert;

class Account implements AccountInterface
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var DateTimeImmutable
     */
    private $creationDate;

    /**
     * @var int
     */
    private $status;

    /**
     * @var EmailAddress[]|Collection
     */
    private $emailAddresses;

    /** @var EmailAddress */
    private $primaryEmailAddress;

    /**
     * @var GroupInterface[]|Collection
     */
    private $groups;

    /**
     * @var IdentityInterface[]|Collection
     */
    private $identities;

    public function __construct(array $identities, EmailAddress $primaryEmailAddress, Status $status = null)
    {
        Assert::greaterThanEq(count($identities), 1, 'Please provide at least one Identity');
        Assert::allIsInstanceOf($identities, IdentityInterface::class);

        if ($status === null) {
            $status = new Status(Status::ACTIVE);
        }

        $this->id = Uuid::uuid4();
        $this->identities = new ArrayCollection($identities);
        $this->creationDate = new DateTimeImmutable();
        $this->groups = new ArrayCollection();
        $this->emailAddresses = new ArrayCollection([$primaryEmailAddress]);
        $this->primaryEmailAddress = $primaryEmailAddress;
        $this->status = $status;

    }

    /**
     * @return array
     */
    public function getGroups() : array
    {
        return $this->groups->toArray();
    }

    /**
     * @param GroupInterface $group
     */
    public function addGroup(GroupInterface $group)
    {
        if ($this->groups->contains($group)) {
            return;
        }

        $this->groups->add($group);

        $group->addAccount($this);
    }

    /**
     * @param GroupInterface $group
     */
    public function removeGroup(GroupInterface $group)
    {
        if ($this->groups->contains($group)) {
            $this->groups->removeElement($group);

            $group->removeAccount($this);
        }
    }

    /**
     * @return Status
     */
    public function getStatus() : Status
    {
        return $this->status;
    }

    /**
     * @param Status $status
     * @internal shall only be used by classes of this package.
     */
    public function setStatus(Status $status)
    {
        $this->status = $status;
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
     * Gets a list with identities that have access to this account.
     *
     * @return IdentityInterface[] Returns a flat array with instances of type IdentityInterface.
     */
    public function getIdentities(): array
    {
        return $this->identities->toArray();
    }

    public function addIdentity(IdentityInterface $identity)
    {
        $this->identities->add($identity);
    }

    /**
     * Gets a list with all e-mail addresses that are assigned to this account.
     *
     * @return EmailAddressInterface[] Returns a flat array with instances of EmailAddressInterface.
     */
    public function getEmailAddresses(): array
    {
        return $this->emailAddresses->toArray();
    }

    /**
     * Gets the primary e-mail address for this account.
     *
     * @return EmailAddress
     */
    public function getPrimaryEmailAddress(): EmailAddress
    {
        return $this->primaryEmailAddress;
    }


    /**
     * @param EmailAddress $email
     */
    public function addEmailAddress(EmailAddress $email)
    {
        $this->emailAddresses->add($email);
    }

    /**
     * Removes the emailaddress from account.
     *
     * @param EmailAddress $emailAddress
     * @throws \PolderKnowledge\Authentication\ConstraintException
     */
    public function removeEmailAddress(EmailAddress $emailAddress)
    {
        if ($emailAddress === $this->primaryEmailAddress) {
            throw new ConstraintException('Cannot remove the emailaddress that was set as primary');
        }
        $this->emailAddresses->removeElement($emailAddress);
    }


    /**
     * Sets the new primary e-mailaddress and adds it to the list of existing e-mailaddresses.
     *
     * @param EmailAddress $emailAddress
     * @return EmailAddress current primary e-mail address.
     */
    public function setPrimaryEmailAddress(EmailAddress $emailAddress) : EmailAddress
    {
        $current = $this->primaryEmailAddress;
        $this->addEmailAddress($emailAddress);
        $this->primaryEmailAddress = $emailAddress;

        return $current;
    }
}
