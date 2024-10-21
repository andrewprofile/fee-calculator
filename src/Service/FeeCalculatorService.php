<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service;

use PragmaGoTech\Interview\Model\Loan;

interface FeeCalculatorService
{
    /**
     * @return float The calculated fee.
     */
    public function calculate(Loan $loan): float;
}
