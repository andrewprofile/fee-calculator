<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

/**
 * A cut down version of a loan application containing
 * only the required properties for this test.
 */
final readonly class Loan
{
    public function __construct(private Term $term, private Amount $amount) {}

    /**
     * Term (loan duration) for this loan application
     * in number of months.
     */
    public function term(): int
    {
        return $this->term->term();
    }

    /**
     * Amount requested for this loan application.
     */
    public function amount(): float
    {
        return $this->amount->amount();
    }
}
