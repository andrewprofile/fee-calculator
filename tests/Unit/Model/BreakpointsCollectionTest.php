<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Unit\Model;

use PHPUnit\Framework\Attributes\CoversClass;
use PragmaGoTech\Interview\Exception\InvalidArgumentException;
use PragmaGoTech\Interview\Model\Breakpoint;
use PragmaGoTech\Interview\Model\BreakpointsCollection;
use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Model\Term;

#[CoversClass(BreakpointsCollection::class)]
#[CoversClass(InvalidArgumentException::class)]
final class BreakpointsCollectionTest extends TestCase
{
    private BreakpointsCollection $breakpointsPool;

    protected function setUp(): void
    {
        $this->breakpointsPool = new BreakpointsCollection();
    }

    public function testLoadFromCSVByTermLoadsDataCorrectly(): void
    {
        $this->breakpointsPool->loadFromCSVByTerm(
            new Term(12),
            __DIR__. DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . '12.csv'
        );
        $breakpoints = $this->breakpointsPool->loadByTerm(new Term(12));
        /** @var Breakpoint $breakpoint */
        $breakpoint = $breakpoints->offsetGet(0);

        $this->assertCount(20, $breakpoints->getArrayCopy());
        $this->assertEquals(1000.0, $breakpoint->amount());
        $this->assertEquals(50.0, $breakpoint->fee());
    }

    public function testLoadFromCSVByTermFileNotFound(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('File not found.');

        $this->breakpointsPool->loadFromCSVByTerm(
            new Term(12),
            __DIR__. DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'notfound.csv'
        );
    }

    public function testLoadByTermThrowsExceptionForNotDefinedTerm(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The loan terms should be defined.');

        $this->breakpointsPool->loadByTerm(new Term(12));
    }

    public function testLoadByTermThrowsExceptionForOutOfRangeTerm(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Loan terms should be between 12 and 24.');

        $this->breakpointsPool->loadByTerm(new Term(99));
    }
}
