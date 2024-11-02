<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day1;

use Advent\Shared\Lexer\Lexer;
use Advent\Tests\Shared\Doubles\FileStub;
use Advent\Year2023\Day1\LinesCalibrationValues;
use Advent\Year2023\Day1\Parser\DigitLexerTokenType;
use Advent\Year2023\Day1\Parser\DigitLineParser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class LinesCalibrationValuesTest extends TestCase
{
    #[Test]
    public function it_sum_all_lines_calibration_values(): void
    {
        $compiler = new LinesCalibrationValues(
            new DigitLineParser(
                new Lexer(DigitLexerTokenType::class)
            )
        );
        $file = new FileStub('zoneight234', 'a1b2c3d4e5f');

        $this->assertSame(24 + 15, $compiler->sumAllFrom($file));
    }
}
