<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day6;

use Advent\Shared\Lexer\Lexer;
use Advent\Year2023\Day6\Parser\RaceLogType;
use Advent\Year2023\Day6\RaceEvaluator;
use Advent\Year2023\Day6\Parser\RaceLogParser;
use Advent\Tests\Shared\Doubles\FileStub;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class RaceEvaluatorTest extends TestCase
{
    #[Test]
    public function it_returns_product_of_all_number_of_ways_of_winning(): void
    {
        $blaEvaluator = new RaceEvaluator(
            new RaceLogParser(new Lexer(RaceLogType::class)),
        );

        $file = new FileStub(
            'Time:      7  15   30',
            'Distance:  9  40  200',
        );

        $this->assertEquals(288, $blaEvaluator->productOfAllNumberOfWaysOfWinning($file));
    }
}
