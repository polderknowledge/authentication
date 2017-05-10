<?php declare(strict_types=1);
/**
 *  Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\Authentication\Account;

use DateTime;
use PolderKnowledge\Authentication\AccountInterface;
use Webmozart\Assert\Assert;

class ActivationToken
{
    /**
     * @var string
     */
    private $tokenHash;
    /**
     * @var AccountInterface
     */
    private $account;

    /**
     * @var \DateTimeImmutable
     */
    private $expireDate;

    public function __construct(string $tokenHash, AccountInterface $account, \DateTimeImmutable $expireDate)
    {
        Assert::notEmpty($tokenHash);

        $this->tokenHash = $tokenHash;
        $this->account = $account;
        $this->expireDate = $expireDate;
    }

    public function getAccount(): AccountInterface
    {
        return $this->account;
    }

    public function getToken(): string
    {
        return $this->tokenHash;
    }

    public function isValid(): bool
    {
        return $this->expireDate > new DateTime();
    }
}
