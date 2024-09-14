<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Unit\Day1\CalibrationDocument;

use Advent\Year2023\Day1\CalibrationDocument\Digit;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class DigitTest extends TestCase
{
    #[Test]
    public function it_allows_only_single_digit_integers(): void
    {
        $this->expectExceptionMessage('Digit must be between 0 and 9. Given: 15');

        new Digit(15);
    }

    #[Test]
    public function it_allows_only_single_spelled_out_digits(): void
    {
        $this->expectExceptionMessage('Digit spelled out with letters must be between 0 and 9. Given: fifteen');

        Digit::fromString('fifteen');
    }

    #[Test] #[DataProvider('digits')]
    public function it_creates_a_digit(string|int $input, Digit $expectedDigit): void
    {
        $this->assertEquals($expectedDigit, Digit::fromString($input));
    }

    public static function digits(): iterable
    {
        // integers
        yield [0, new Digit(0)];
        yield [1, new Digit(1)];
        yield [2, new Digit(2)];
        yield [3, new Digit(3)];
        yield [4, new Digit(4)];
        yield [5, new Digit(5)];
        yield [6, new Digit(6)];
        yield [7, new Digit(7)];
        yield [8, new Digit(8)];
        yield [9, new Digit(9)];

        // integers as strings
        yield ['0', new Digit(0)];
        yield ['1', new Digit(1)];
        yield ['2', new Digit(2)];
        yield ['3', new Digit(3)];
        yield ['4', new Digit(4)];
        yield ['5', new Digit(5)];
        yield ['6', new Digit(6)];
        yield ['7', new Digit(7)];
        yield ['8', new Digit(8)];
        yield ['9', new Digit(9)];

        // spelled out digits
        yield ['zero', new Digit(0)];
        yield ['one', new Digit(1)];
        yield ['two', new Digit(2)];
        yield ['three', new Digit(3)];
        yield ['four', new Digit(4)];
        yield ['five', new Digit(5)];
        yield ['six', new Digit(6)];
        yield ['seven', new Digit(7)];
        yield ['eight', new Digit(8)];
        yield ['nine', new Digit(9)];
    }
}
