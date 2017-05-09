<?php
/**
 *  Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\AuthenticationTest;

use PHPUnit_Framework_TestCase;
use PolderKnowledge\Authentication\Account;
use PolderKnowledge\Authentication\EmailAddress;
use PolderKnowledge\Authentication\Group;
use PolderKnowledge\Authentication\Identity\CredentialIdentity;

/**
 * @coversDefaultClass PolderKnowledge\Authentication\Account
 * @covers ::<private>
 */
final class AccountTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     *
     * @uses \PolderKnowledge\Authentication\EmailAddress
     * @uses \PolderKnowledge\Authentication\Identity\CredentialIdentity
     * @uses \PolderKnowledge\Authentication\Account\Status
     * @expectedException \InvalidArgumentException
     */
    public function testCreateAccountWithInvalidIdentities()
    {
        new Account(
            ['string', new CredentialIdentity()], new EmailAddress('foo@example.com'), new Account\Status(Account\Status::ACTIVE)
        );
    }

    /**
     * @covers ::__construct
     *
     * @uses \PolderKnowledge\Authentication\EmailAddress
     * @uses \PolderKnowledge\Authentication\Identity\CredentialIdentity
     * @uses \PolderKnowledge\Authentication\Account\Status
     * @expectedException \InvalidArgumentException
     */
    public function testCreateAccountAtLeastOneIdentity()
    {
        new Account(
            [], new EmailAddress('foo@example.com'), new Account\Status(Account\Status::ACTIVE)
        );
    }

    /**
     * @covers ::__construct
     * @covers ::getEmailAddresses
     * @covers ::getPrimaryEmailAddress
     *
     * @uses \PolderKnowledge\Authentication\EmailAddress
     * @uses \PolderKnowledge\Authentication\Identity\CredentialIdentity
     * @uses \PolderKnowledge\Authentication\Account\Status
     */
    public function testPrimaryEmailIsSet()
    {
        $email = new EmailAddress('foo@example.com');
        $account = new Account(
            [new CredentialIdentity()], $email, new Account\Status(Account\Status::ACTIVE)
        );

        static::assertSame([$email], $account->getEmailAddresses());
        static::assertSame($email, $account->getPrimaryEmailAddress());
    }

    /**
     * @covers ::__construct
     * @covers ::getEmailAddresses
     * @covers ::setPrimaryEmailAddress
     * @covers ::getPrimaryEmailAddress
     *
     * @uses \PolderKnowledge\Authentication\EmailAddress
     * @uses \PolderKnowledge\Authentication\Identity\CredentialIdentity
     * @uses \PolderKnowledge\Authentication\Account\Status
     */
    public function testResetPrimary()
    {
        $email = new EmailAddress('foo@example.com');
        $newPrimary = new EmailAddress('foo@example.eu');
        $account = new Account(
            [new CredentialIdentity()], $email, new Account\Status(Account\Status::ACTIVE)
        );

        $previousPrimary = $account->setPrimaryEmailAddress($newPrimary);

        static::assertSame([$email, $newPrimary], $account->getEmailAddresses());
        static::assertSame($email, $previousPrimary);
        static::assertSame($newPrimary, $account->getPrimaryEmailAddress());
    }

    /**
     * @covers ::__construct
     * @covers ::getEmailAddresses
     * @covers ::removeEmailAddress
     * @covers ::addEmailAddress
     *
     * @uses \PolderKnowledge\Authentication\EmailAddress
     * @uses \PolderKnowledge\Authentication\Identity\CredentialIdentity
     * @uses \PolderKnowledge\Authentication\Account\Status
     */
    public function testAddRemoveEmailAddress()
    {
        $email = new EmailAddress('foo@example.com');
        $secondaryEmail = new EmailAddress('foo@example.eu');
        $account = new Account(
            [new CredentialIdentity()], $email, new Account\Status(Account\Status::ACTIVE)
        );

        $account->addEmailAddress($secondaryEmail);
        static::assertSame([$email, $secondaryEmail], $account->getEmailAddresses());

        $account->removeEmailAddress($secondaryEmail);
        static::assertSame([$email], $account->getEmailAddresses());
    }

    /**
     * @covers ::__construct
     * @covers ::removeEmailAddress
     *
     * @expectedException \PolderKnowledge\Authentication\ConstraintException
     */
    public function testRemovePrimaryEmailThrowsException()
    {
        $email = new EmailAddress('foo@example.com');
        $account = new Account(
            [new CredentialIdentity()], $email, new Account\Status(Account\Status::ACTIVE)
        );

        $account->removeEmailAddress($email);
    }

    /**
     * @covers ::__construct
     * @covers ::getEmailAddresses
     * @covers ::removeEmailAddress
     * @covers ::addEmailAddress
     *
     * @uses \PolderKnowledge\Authentication\EmailAddress
     * @uses \PolderKnowledge\Authentication\Identity\CredentialIdentity
     * @uses \PolderKnowledge\Authentication\Account\Status
     * @uses \PolderKnowledge\Authentication\Group
     */
    public function testAddGroup()
    {
        $email = new EmailAddress('foo@example.com');
        $account = new Account(
            [new CredentialIdentity()], $email, new Account\Status(Account\Status::ACTIVE)
        );

        $group = new Group();

        $account->addGroup($group);
        static::assertSame([$group], $account->getGroups());
        static::assertSame([$account], $group->getAccounts());

        $account->removeGroup($group);
        static::assertEmpty($account->getGroups());
        static::assertEmpty($group->getAccounts());
    }

    public function testCreateInactive()
    {
        $email = new EmailAddress('foo@example.com');
        $account = new Account(
            [new CredentialIdentity()], $email, new Account\Status(Account\Status::INACTIVE)
        );

        static::assertEquals(Account\Status::INACTIVE, (string)$account->getStatus());
    }
}
