<?php

declare(strict_types=1);

namespace Advent\Tests\Year2023\Tests\Day9\Parser;

use Advent\Year2023\Day9\Model\Sequence;
use Advent\Year2023\Day9\Parser\ReportParser;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ReportParserTest extends TestCase
{
    #[Test]
    #[DataProvider('report_lines')]
    public function it_parses_report(string $report, Sequence $expectedSequence): void
    {
        $parser = new ReportParser();

        $this->assertEquals($expectedSequence, $parser->parse($report));
    }

    public static function report_lines(): iterable
    {
        yield [
            '0 3 6 9 12 15',
            new Sequence(0, 3, 6, 9, 12, 15),
        ];

        yield [
            '-8 -9 -9 2 51 199 566 1370 3008 6250 12703 25863 53356 111454 233791 487703 1004407 2034620 4051822 7946267 15393468',
            new Sequence(-8, -9, -9, 2, 51, 199, 566, 1370, 3008, 6250, 12703, 25863, 53356, 111454, 233791, 487703, 1004407, 2034620, 4051822, 7946267, 15393468),
        ];

        yield [
            '15 31 60 122 253 522 1077 2250 4761 10081 21062 43051 85935 168014 323419 616195 1166443 2197435 4117856 7660872 14112281',
            new Sequence(15, 31, 60, 122, 253, 522, 1077, 2250, 4761, 10081, 21062, 43051, 85935, 168014, 323419, 616195, 1166443, 2197435, 4117856, 7660872, 14112281),
        ];
    }
}
