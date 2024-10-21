<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Unit\Model;

use PHPUnit\Framework\Attributes\CoversClass;
use PragmaGoTech\Interview\Exception\InvalidArgumentException;
use PragmaGoTech\Interview\Model\Amount;
use PHPUnit\Framework\TestCase;

#[CoversClass(Amount::class)]
#[CoversClass(InvalidArgumentException::class)]
final class AmountTest extends TestCase
{
    public function testValidAmount(): void
    {
        $amount = new Amount(1500.0);

        $this->assertEquals(1500.0, $amount->amount());
    }

    public function testAmountTooLow(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The loan amount is out of the range.');

        new Amount(999.0);
    }

    public function testAmountTooHigh(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The loan amount is out of the range.');

        new Amount(20001.0);
    }
}
