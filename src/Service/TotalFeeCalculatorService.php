<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service;

use PragmaGoTech\Interview\Exception\InvalidArgumentException;
use PragmaGoTech\Interview\Model\Loan;

final class TotalFeeCalculatorService implements FeeCalculatorService
{
    /**
     * @return float The calculated total fee.
     */
    public function calculate(Loan $loan): float
    {
        if ($loan->term() === 12 && $loan->amount() > 1000.00) {
            return 200.0;
        }

        throw InvalidArgumentException::loanIsInvalid();
    }
}
