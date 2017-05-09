<?php
/**
 *  Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\Authentication\Account\Command;

use PolderKnowledge\Authentication\AccountInterface;

final class RequestActivation
{
    /**
     * @var AccountInterface
     */
    private $account;
    /**
     * @var string
     */
    private $rawToken;

    public function __construct(AccountInterface $account, string $rawToken)
    {
        $this->account = $account;
        $this->rawToken = $rawToken;
    }

    public function getAccount(): AccountInterface
    {
        return $this->account;
    }

    public function getRawToken(): string
    {
        return $this->rawToken;
    }
}
