<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

use PragmaGoTech\Interview\Exception\InvalidArgumentException;

/**
 * @extends \ArrayObject<int, Breakpoint>
 */
final class Breakpoints extends \ArrayObject
{
    /**
     * @param Breakpoint[] $breakpoints
     */
    public function __construct(private array $breakpoints = [])
    {
        parent::__construct($breakpoints);
    }

    public function lowerBoundAmount(Amount $amount): Amount
    {
        $currentAmount = $amount->amount();
        $amounts = [];

        array_walk($this->breakpoints, static function (Breakpoint $breakpoint) use ($currentAmount, &$amounts) {
            if ($breakpoint->amount() < $currentAmount) {
                $amounts[] = $breakpoint->amount();
            }
        });

        return !empty($amounts) ? new Amount(max($amounts)) : throw InvalidArgumentException::amountOutOfRange();
    }

    public function upperBoundAmount(Amount $amount): Amount
    {
        $currentAmount = $amount->amount();
        $amounts = [];

        array_walk($this->breakpoints, static function (Breakpoint $breakpoint) use ($currentAmount, &$amounts) {
            if ($breakpoint->amount() > $currentAmount) {
                $amounts[] = $breakpoint->amount();
            }
        });

        return !empty($amounts) ? new Amount(min($amounts)) : throw InvalidArgumentException::amountOutOfRange();
    }

    public function lowerFee(Amount $amount): float
    {
        return $this->fee($amount) ?? throw InvalidArgumentException::feeIsInvalid();
    }

    public function upperFee(Amount $amount): float
    {
        return $this->fee($amount) ?? throw InvalidArgumentException::feeIsInvalid();
    }

    public function fee(Amount $amount): ?float
    {
        $currentAmount = $amount->amount();
        $fee = null;
        array_walk($this->breakpoints, static function (Breakpoint $breakpoint) use ($currentAmount, &$fee) {
            if ($breakpoint->amount() === $currentAmount) {
                $fee = $breakpoint->fee();
            }
        });

        return $fee;
    }
}
