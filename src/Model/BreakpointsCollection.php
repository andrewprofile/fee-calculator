<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Model;

use PragmaGoTech\Interview\Exception\InvalidArgumentException;

final class BreakpointsCollection
{
    private const int AMOUNT_COLUMN = 0;
    private const int FEE_COLUMN = 1;

    /**
     * @var array<int, Breakpoints>
     */
    private array $breakpoints = [];

    /**
     * @throws InvalidArgumentException
     */
    public function loadFromCSVByTerm(Term $term, string $fileName): void
    {
        $file = @file($fileName);
        if ($file === false) {
            throw InvalidArgumentException::fileNotFound();
        }

        $breakpointsFromFile = array_map('str_getcsv', $file);

        array_shift($breakpointsFromFile);

        $breakpoints = array_map(static function ($breakpoint) {
            return new Breakpoint(
                new Amount((float)$breakpoint[self::AMOUNT_COLUMN]),
                new Fee((float)$breakpoint[self::FEE_COLUMN])
            );
        }, $breakpointsFromFile);

        $this->breakpoints[$term->term()] = new Breakpoints($breakpoints);
    }

    /**
     * @throws InvalidArgumentException
     */
    public function loadByTerm(Term $term): Breakpoints
    {
        return $this->breakpoints[$term->term()] ?? throw InvalidArgumentException::termIsInvalid();
    }
}
