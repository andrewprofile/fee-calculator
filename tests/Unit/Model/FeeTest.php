<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Unit\Model;

use PHPUnit\Framework\Attributes\CoversClass;
use PragmaGoTech\Interview\Exception\InvalidArgumentException;
use PragmaGoTech\Interview\Model\Fee;
use PHPUnit\Framework\TestCase;

#[CoversClass(Fee::class)]
#[CoversClass(InvalidArgumentException::class)]
final class FeeTest extends TestCase
{
    public function testValidFee(): void
    {
        $fee = new Fee(10.0);
        $this->assertEquals(10.0, $fee->fee());
    }

    public function testNegativeFeeThrowsException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The fee must be a positive float.');

        new Fee(-5.0);
    }
}
