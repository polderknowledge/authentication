<?php
/**
 *  Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\Authentication\Account\Command;

use PolderKnowledge\Authentication\Account\Repository;
use PolderKnowledge\Authentication\Account\Status;

final class DeactivateHandler
{
    /**
     * @var Repository
     */
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(Deactivate $command)
    {
        $account = $command->getAccount();
        $account->setStatus(new Status(Status::INACTIVE));

        $this->repository->update($account);
    }
}
