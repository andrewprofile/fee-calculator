<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Unit\Service;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Exception\InvalidArgumentException;
use PragmaGoTech\Interview\Model\Amount;
use PragmaGoTech\Interview\Model\Loan;
use PragmaGoTech\Interview\Model\Term;
use PragmaGoTech\Interview\Service\CalculateTotalFeeService;
use PragmaGoTech\Interview\Service\FeeCalculatorService;
use PragmaGoTech\Interview\Service\TotalFeeCalculatorService;

#[CoversClass(TotalFeeCalculatorService::class)]
#[CoversClass(InvalidArgumentException::class)]
final class TotalFeeCalculatorServiceTest extends TestCase
{
    private FeeCalculatorService $feeCalculatorService;
    private MockObject $calculateTotalFeeServiceMock;

    /**
     * @throws Exception
     */
    public function setUp(): void
    {
        $this->calculateTotalFeeServiceMock = $this->createMock(CalculateTotalFeeService::class);
        $this->feeCalculatorService = new TotalFeeCalculatorService($this->calculateTotalFeeServiceMock);
    }

    public function testCalculateReturnsCorrectTotalFee(): void
    {
        $term = new Term(24);
        $amount = new Amount(1000.00);
        $loan = new Loan($term, $amount);

        $this->calculateTotalFeeServiceMock
            ->expects($this->once())
            ->method('calculateTotalFee')
            ->with($loan->term(), $loan->amount())
            ->willReturn(70.00);

        $result = $this->feeCalculatorService->calculate($loan);

        $this->assertEquals(70.0, $result);
    }
}
