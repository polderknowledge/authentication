<?php
/**
 *  Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\Authentication\Account\Command;


use PolderKnowledge\Authentication\Account\ActivationTokenRepository;
use PolderKnowledge\Authentication\Account\Repository as AccountRepository;
use PolderKnowledge\Authentication\Account\Status;

final class ActivateHandler
{
    /**
     * @var AccountRepository
     */
    private $repository;

    /**
     * @var ActivationTokenRepository
     */
    private $tokenRepository;

    public function __construct(AccountRepository $repository, ActivationTokenRepository $tokenRepository)
    {
        $this->repository = $repository;
        $this->tokenRepository = $tokenRepository;
    }

    public function handle(Activate $command)
    {
        $token = $command->getToken();
        $activationToken = $this->tokenRepository->get($token);

        if (!$activationToken->isValid()) {
            throw new InvalidTokenException();
        }

        $account = $activationToken->getAccount();
        $account->setStatus(new Status(Status::ACTIVE));

        $this->repository->update($account);
    }
}
