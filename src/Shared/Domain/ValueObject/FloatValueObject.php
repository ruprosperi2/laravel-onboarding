<?php

namespace Shared\Domain\ValueObject;
use InvalidArgumentException;

abstract class FloatValueObject
{
    private $value;

    public function __construct(float $float)
    {
        $this->validate($float);
        $this->value = $float;
    }

    private function validate(float $float): void
    {
        if (!filter_var($float, FILTER_VALIDATE_FLOAT)) {
            throw new InvalidArgumentException(
                sprintf('<%s> Does not allow the value <%s>.', static::class, $float)
            );
        }
    }

    public function value(): float
    {
        return $this->value;
    }
}

