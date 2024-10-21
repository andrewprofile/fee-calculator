<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Unit\Service;

use PHPUnit\Framework\Attributes\CoversClass;
use PragmaGoTech\Interview\Service\CalculateLinearInterpolationTotalFeeService;
use PHPUnit\Framework\TestCase;

#[CoversClass(CalculateLinearInterpolationTotalFeeService::class)]
final class CalculateLinearInterpolationServiceTest extends TestCase
{
    private CalculateLinearInterpolationTotalFeeService $calculateTotalFeeService;

    protected function setUp(): void
    {
        $this->calculateTotalFeeService = new CalculateLinearInterpolationTotalFeeService();
    }

    public function testCalculateTotalFeeWithExactValues(): void
    {
        $term = 24;
        $amount = 1000.00;

        $result = $this->calculateTotalFeeService->calculateTotalFee($term, $amount);

        $this->assertEquals(70.00, $result);
    }

    public function testCalculateTotalFeeWithInterpolatedValues(): void
    {
        $term = 24;
        $amount = 11500.00;

        $result = $this->calculateTotalFeeService->calculateTotalFee($term, $amount);

        $this->assertEquals(460.00, $result);

        $amount = 2750.00;

        $result = $this->calculateTotalFeeService->calculateTotalFee($term, $amount);

        $this->assertEquals(115.00, $result);
    }

    public function testCalculateTotalFeeAdjustsToNearestFive(): void
    {
        $term = 24;
        $amount = 2755.00;

        $result = $this->calculateTotalFeeService->calculateTotalFee($term, $amount);

        $this->assertEquals(120.00, $result);
    }
}
