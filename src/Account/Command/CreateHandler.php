<?php
/**
 *  Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\Authentication\Account\Command;


use PolderKnowledge\Authentication\Account;

final class CreateHandler
{
    /**
     * @var Account\Repository
     */
    private $repository;

    public function __construct(Account\Repository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(Create $command)
    {
        $account = new Account(
            $command->getIdentities(), $command->getPrimaryEmail(), $command->getStatus()
        );

        $this->repository->add($account);
    }
}
