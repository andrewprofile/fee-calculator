<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service;

use PragmaGoTech\Interview\Exception\InvalidArgumentException;
use PragmaGoTech\Interview\Model\Loan;

final readonly class TotalFeeCalculatorService implements FeeCalculatorService
{
    public function __construct(private CalculateFeeService $calculateFeeService) {}
    /**
     * @return float The calculated total fee.
     */
    public function calculate(Loan $loan): float
    {
        return $this->calculateFeeService->calculateTotalFee($loan->term(), $loan->amount());
    }
}
