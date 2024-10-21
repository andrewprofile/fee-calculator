<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Unit\Service;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Exception\InvalidArgumentException;
use PragmaGoTech\Interview\Model\Amount;
use PragmaGoTech\Interview\Model\Loan;
use PragmaGoTech\Interview\Model\Term;
use PragmaGoTech\Interview\Service\FeeCalculatorService;
use PragmaGoTech\Interview\Service\TotalFeeCalculatorService;

#[CoversClass(TotalFeeCalculatorService::class)]
#[CoversClass(InvalidArgumentException::class)]
final class TotalFeeCalculatorServiceTest extends TestCase
{
    private FeeCalculatorService $feeCalculatorService;

    public function setUp(): void
    {
        $this->feeCalculatorService = new TotalFeeCalculatorService();
    }

    public function testCalculateReturnsCorrectTotalFee(): void
    {
        $term = new Term(12);
        $amount = new Amount(10000.00);
        $loan = new Loan($term, $amount);

        $result = $this->feeCalculatorService->calculate($loan);

        $this->assertEquals(200.0, $result);
    }

    public function testCalculateThrowsExceptionForInvalidLoan(): void
    {
        $term = new Term(12);
        $amount = new Amount(1000.00);
        $loan = new Loan($term, $amount);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The loan is invalid.');

        $this->feeCalculatorService->calculate($loan);
    }
}
