<?php declare(strict_types=1);
/**
 *  Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\Authentication;

use DateTimeImmutable;
use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

/**
 */
class EmailAddress
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
     * @var string
     */
    private $address;

    public function __construct(string $address)
    {
        Assert::stringNotEmpty($address);
        $this->id = Uuid::uuid4();
        $this->creationDate = new DateTimeImmutable();
        $this->address = $address;
    }

    public function getCreationDate(): DateTimeImmutable
    {
        return $this->creationDate;
    }

    public function getAddress() : string
    {
        return $this->address;
    }
}
