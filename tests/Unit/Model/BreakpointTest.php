<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Unit\Model;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\Exception;
use PragmaGoTech\Interview\Model\Amount;
use PragmaGoTech\Interview\Model\Breakpoint;
use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Model\Fee;

#[CoversClass(Breakpoint::class)]
final class BreakpointTest extends TestCase
{
    /**
     * @throws Exception
     */
    public function testAmountReturnsCorrectValue(): void
    {
        $amount = new Amount(1000.0);
        $fee = new Fee(50.0);

        $breakpoint = new Breakpoint($amount, $fee);

        $this->assertEquals(1000.0, $breakpoint->amount());
    }

    /**
     * @throws Exception
     */
    public function testFeeReturnsCorrectValue(): void
    {
        $amount = new Amount(1000.0);
        $fee = new Fee(50.0);

        $breakpoint = new Breakpoint($amount, $fee);

        $this->assertEquals(50.0, $breakpoint->fee());
    }
}
