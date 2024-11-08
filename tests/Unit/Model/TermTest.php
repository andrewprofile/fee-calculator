<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Unit\Model;

use PHPUnit\Framework\Attributes\CoversClass;
use PragmaGoTech\Interview\Exception\InvalidArgumentException;
use PragmaGoTech\Interview\Model\Term;
use PHPUnit\Framework\TestCase;

#[CoversClass(Term::class)]
#[CoversClass(InvalidArgumentException::class)]
final class TermTest extends TestCase
{
    public function testValidTerm(): void
    {
        $term = new Term(12);

        $this->assertEquals(12, $term->term());

        $term = new Term(24);

        $this->assertEquals(24, $term->term());
    }

    public function testTermTooLow(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Loan terms should be between 12 and 24.');

        new Term(11);
    }

    public function testTermTooHigh(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Loan terms should be between 12 and 24.');

        new Term(25);
    }
}
