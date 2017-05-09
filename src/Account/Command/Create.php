<?php declare(strict_types=1);
/**
 *  Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\Authentication\Account\Command;


use PolderKnowledge\Authentication\Account\Status;
use PolderKnowledge\Authentication\EmailAddress;

final class Create
{
    /**
     * @var array
     */
    private $identities;
    /**
     * @var EmailAddress
     */
    private $emailAddress;
    /**
     * @var Status
     */
    private $status;

    public function __construct(array $identities, EmailAddress $emailAddress, Status $status = null)
    {
        if ($status === null) {
            $status = new Status(Status::ACTIVE);
        }

        $this->identities = $identities;
        $this->emailAddress = $emailAddress;
        $this->status = $status;
    }

    public function getIdentities() : array
    {
        return $this->identities;
    }

    public function getStatus() : Status
    {
        return $this->status;
    }

    public function getPrimaryEmail() : EmailAddress
    {
        return $this->emailAddress;
    }
}
