<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service;

use PragmaGoTech\Interview\Model\Amount;
use PragmaGoTech\Interview\Model\Breakpoints;
use PragmaGoTech\Interview\Model\BreakpointsCollection;
use PragmaGoTech\Interview\Model\Term;

final readonly class CalculateLinearInterpolationTotalFeeService implements CalculateTotalFeeService
{
    public function __construct(private BreakpointsCollection $breakpointsPool) {}
    public function calculateTotalFee(Term $term, Amount $amount): float
    {
        $breakpoints = $this->breakpointsPool->loadByTerm($term);
        $fee = $this->accurateFee($breakpoints, $amount);

        if ($fee !== null) {
            return $fee;
        }

        $interpolatedFee = $this->interpolatedFee($breakpoints, $amount);

        return $this->adjustFee($amount, $interpolatedFee);
    }

    private function accurateFee(Breakpoints $breakpoints, Amount $amount): ?float
    {
        $fee = $breakpoints->fee($amount);
        return $fee !== null ? round($fee, 2) : null;
    }

    private function adjustFee(Amount $amount, float $fee): float
    {
        $total = $amount->amount() + $fee;
        if ($total % 5 !== 0) {
            $fee += (5 - ($total % 5));
        }

        return round($fee, 2);
    }

    private function interpolatedFee(Breakpoints $breakpoints, Amount $amount): float
    {
        $lowerBound = $breakpoints->lowerBoundAmount($amount);
        $upperBound = $breakpoints->upperBoundAmount($amount);
        $lowerFee = $breakpoints->lowerFee($lowerBound);
        $upperFee = $breakpoints->upperFee($upperBound);

        $interpolatedFee = $lowerFee + (($amount->amount() - $lowerBound->amount()) /
                ($upperBound->amount() - $lowerBound->amount())) * ($upperFee - $lowerFee);

        return ceil($interpolatedFee);
    }
}
