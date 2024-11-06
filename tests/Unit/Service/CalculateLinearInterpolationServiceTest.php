<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Unit\Service;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\Exception;
use PragmaGoTech\Interview\Model\Amount;
use PragmaGoTech\Interview\Model\BreakpointsCollection;
use PragmaGoTech\Interview\Model\Term;
use PragmaGoTech\Interview\Service\CalculateLinearInterpolationTotalFeeService;
use PHPUnit\Framework\TestCase;

#[CoversClass(CalculateLinearInterpolationTotalFeeService::class)]
final class CalculateLinearInterpolationServiceTest extends TestCase
{
    private CalculateLinearInterpolationTotalFeeService $calculateTotalFeeService;

    protected function setUp(): void
    {
        $breakpointsPool = new BreakpointsCollection();
        $breakpointsPool->loadFromCSVByTerm(
            new Term(24),
            __DIR__. DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . '24.csv'
        );

        $this->calculateTotalFeeService = new CalculateLinearInterpolationTotalFeeService($breakpointsPool);
    }

    public function testCalculateTotalFeeWithExactValues(): void
    {
        $term = new Term(24);
        $amount = new Amount(1000.00);

        $result = $this->calculateTotalFeeService->calculateTotalFee($term, $amount);

        $this->assertEquals(70.00, $result);
    }

    public function testCalculateTotalFeeWithInterpolatedValues(): void
    {
        $term = new Term(24);
        $amount = new Amount(11500.00);

        $result = $this->calculateTotalFeeService->calculateTotalFee($term, $amount);

        $this->assertEquals(460.00, $result);

        $amount = new Amount(2750.00);

        $result = $this->calculateTotalFeeService->calculateTotalFee($term, $amount);

        $this->assertEquals(115.00, $result);
    }

    public function testCalculateTotalFeeAdjustsToNearestFive(): void
    {
        $term = new Term(24);
        $amount = new Amount(2755.00);

        $result = $this->calculateTotalFeeService->calculateTotalFee($term, $amount);

        $this->assertEquals(120.00, $result);
    }
}
