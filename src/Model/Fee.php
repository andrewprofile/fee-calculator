<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

use PragmaGoTech\Interview\Exception\InvalidArgumentException;

final readonly class Fee
{
    /**
     * @throws InvalidArgumentException
     */
    public function __construct(private float $fee)
    {
        (!is_float($this->fee) || $this->fee < 0.0) && throw InvalidArgumentException::feeIsInvalid();
    }

    public function fee(): float
    {
        return $this->fee;
    }
}
