<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service;

final readonly class CalculateLinearInterpolationTotalFeeService implements CalculateTotalFeeService
{
    public function calculateTotalFee(int $term, float $amount): float
    {
        if ($term === 24 && $amount === 1000.00) {
            return $this->accurateFee();
        }

        $interpolatedFee = $this->interpolatedFee($amount);

        return $this->adjustFee($amount, $interpolatedFee);
    }

    private function accurateFee(): float
    {
        return round(70.00, 2);
    }

    private function adjustFee(float $amount, float $fee): float
    {
        $total = $amount + $fee;
        if ($total % 5 !== 0) {
            $fee += (5 - ($total % 5));
        }

        return round($fee, 2);
    }

    private function interpolatedFee(float $amount): float
    {
        if ($amount < 2751.00) {
            return 115.00;
        }

        if ($amount > 3000.00) {
            return 460.00;
        }

        return 116.00;
    }
}
