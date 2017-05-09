<?php
/**
 *  Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\Authentication\Account\Command;

use InvalidArgumentException;
use PolderKnowledge\Authentication\Account\ActivationSender;
use PolderKnowledge\Authentication\Account\ActivationToken;
use PolderKnowledge\Authentication\Account\ActivationTokenRepository;
use PolderKnowledge\Authentication\Account\Status;
use PolderKnowledge\Authentication\Token\Generator;

final class RequestActivationHandler
{
    /**
     * @var ActivationTokenRepository
     */
    private $repository;

    public function __construct(ActivationTokenRepository $repository)
    {
        $this->repository = $repository;
    }

    public function handle(RequestActivation $command)
    {
        $account = $command->getAccount();

        if ((string)$account->getStatus() === Status::ACTIVE) {
            throw new InvalidArgumentException('Account is already active');
        }

        $token = new ActivationToken($command->getRawToken(), $account, new \DateTimeImmutable('+24 hours'));
        $this->repository->add($token);
    }
}
