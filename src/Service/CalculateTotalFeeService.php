<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service;

use PragmaGoTech\Interview\Model\Amount;
use PragmaGoTech\Interview\Model\Term;

interface CalculateTotalFeeService
{
    public function calculateTotalFee(Term $term, Amount $amount): float;
}
