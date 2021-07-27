<?php 

namespace Shared\Domain\ValueObject;
use InvalidArgumentException;

abstract class IntValueObject
{
	private $value;

    public function __construct(int $int)
    {
        $this->validate($int);
        $this->value = $int;
    }

    private function validate(int $int): void
    {
        $options = array(
            'options' => array(
                'min_range' => 1,
            )
        );

        if (!filter_var($int, FILTER_VALIDATE_INT, $options)) {
            throw new InvalidArgumentException(
                sprintf('<%s> Does not allow the value <%s>.', static::class, $int)
            );
        }
    }

    public function value(): int
    {
        return $this->value;
    }
}

?>