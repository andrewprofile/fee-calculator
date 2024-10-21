<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Unit\Model;

use PHPUnit\Framework\Attributes\CoversClass;
use PragmaGoTech\Interview\Model\Amount;
use PragmaGoTech\Interview\Model\Loan;
use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Model\Term;

#[CoversClass(Loan::class)]
final class LoanTest extends TestCase
{
    public function testLoanTerm(): void
    {
        $term = new Term(12);
        $amount = new Amount(5000.00);
        $loan = new Loan($term, $amount);

        $this->assertEquals(12, $loan->term());
    }

    public function testLoanAmount(): void
    {
        $term = new Term(12);
        $amount = new Amount(5000.00);
        $loan = new Loan($term, $amount);

        $this->assertEquals(5000.00, $loan->amount());
    }
}
