<?php
/**
 *  Polder Knowledge / Authentication (https://polderknowledge.com)
 *
 * @link https://github.com/polderknowledge/authentication for the canonical source repository
 * @copyright Copyright (c) 2017 Polder Knowledge (https://polderknowledge.com)
 * @license https://github.com/polderknowledge/authentication/blob/master/LICENSE.md MIT
 */

namespace PolderKnowledge\Authentication\Account;

use ReflectionClass;
use Webmozart\Assert\Assert;

final class Status
{
    const ACTIVE = 'active';
    const INACTIVE = 'inactive';
    const INVITED = 'invited';

    private $value;

    private static $options = null;
    /**
     * @throws \InvalidArgumentException when $status is not one of the allowed values
     */
    public function __construct(string $status)
    {
        Assert::oneOf($status, static::getOptions());
        $this->value = $status;
    }

    private static function getOptions() : array
    {
        if (static::$options === null) {
            //I'm not sure about this construction. Have to check this.
            $class = new ReflectionClass(static::class);
            static::$options = $class->getConstants();
        }

        return static::$options;
    }

    public function __toString()
    {
        return $this->value;
    }
}
