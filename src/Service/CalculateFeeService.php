<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service;

interface CalculateFeeService
{
    public function calculateTotalFee(int $term, float $amount): float;
}
