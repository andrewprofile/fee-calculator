<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Unit\Model;

use PragmaGoTech\Interview\Exception\InvalidArgumentException;
use PragmaGoTech\Interview\Model\Amount;
use PragmaGoTech\Interview\Model\Breakpoint;
use PragmaGoTech\Interview\Model\Breakpoints;
use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Model\Fee;

final class BreakpointsTest extends TestCase
{
    private Breakpoints $breakpoints;

    protected function setUp(): void
    {
        $this->breakpoints = new Breakpoints([
            new Breakpoint(new Amount(1000), new Fee(50)),
            new Breakpoint(new Amount(2000), new Fee(90)),
            new Breakpoint(new Amount(3000), new Fee(90)),
        ]);
    }

    public function testLowerBoundAmount(): void
    {
        $amount = new Amount(3000);
        $this->assertEquals(2000, $this->breakpoints->lowerBoundAmount($amount)->amount());
    }

    public function testUpperBoundAmount(): void
    {
        $amount = new Amount(1500);
        $this->assertEquals(2000, $this->breakpoints->upperBoundAmount($amount)->amount());
    }
    public function testLowerFee(): void
    {
        $amount = new Amount(1000);
        $this->assertEquals(50.00, $this->breakpoints->lowerFee($amount));
    }

    public function testLowerFeeNotFound(): void
    {
        $amount = new Amount(10000);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The fee must be a positive float.');

        $this->breakpoints->lowerFee($amount);
    }

    public function testUpperFee(): void
    {
        $amount = new Amount(3000);
        $this->assertEquals(90.00, $this->breakpoints->upperFee($amount));
    }

    public function testUpperFeeNotFound(): void
    {
        $amount = new Amount(20000);
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The fee must be a positive float.');

        $this->breakpoints->upperFee($amount);
    }

    public function testFeeNotFound(): void
    {
        $amount = new Amount(15000);
        $this->assertNull($this->breakpoints->fee($amount));
    }
}
