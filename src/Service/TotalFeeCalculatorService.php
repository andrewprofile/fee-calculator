<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service;

use PragmaGoTech\Interview\Model\Loan;

final readonly class TotalFeeCalculatorService implements FeeCalculatorService
{
    public function __construct(private CalculateTotalFeeService $calculateTotalFeeService) {}
    /**
     * @return float The calculated total fee.
     */
    public function calculate(Loan $loan): float
    {
        return $this->calculateTotalFeeService->calculateTotalFee($loan->term(), $loan->amount());
    }
}
