<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day5;

use Advent\Tests\Shared\Doubles\FileStub;
use Advent\Year2023\Day5\AlmanacEvaluator;
use Advent\Year2023\Day5\Parser\AlmanacLexer;
use Advent\Year2023\Day5\Parser\AlmanacParser;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class AlmanacEvaluatorTest extends TestCase
{
    #[Test]
    public function it_gets_lowest_location_number_from_almanac(): void
    {
        $almanacEvaluator = new AlmanacEvaluator(new AlmanacParser(new AlmanacLexer()));
        $file = FileStub::withContent(file_get_contents(__DIR__ . '/../../Resources/test_day5.txt'));

        $this->assertEquals(35, $almanacEvaluator->lowestLocationNumber($file));
    }

    #[Test]
    public function it_gets_lowest_location_number_from_almanac_with_seed_ranges(): void
    {
        $almanacEvaluator = new AlmanacEvaluator(new AlmanacParser(new AlmanacLexer()));
        $file = FileStub::withContent(file_get_contents(__DIR__ . '/../../Resources/test_day5.txt'));

        $this->assertEquals(46, $almanacEvaluator->lowestLocationNumberWithSeedRanges($file));
    }
}
